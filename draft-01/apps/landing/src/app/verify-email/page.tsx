"use client";

import { Card } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { useState, useEffect } from "react";
import { supabase } from "@/lib/supabaseClient";
import { useRouter } from "next/navigation";
import Link from "next/link";

export default function VerifyEmailPage() {
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState("");
  const [error, setError] = useState("");
  const [email, setEmail] = useState("");
  const [step, setStep] = useState(1); // 1: enter email, 2: verification options
  const router = useRouter();

  const handleEmailSubmit = async () => {
    if (!email) {
      setError("Please enter your email address.");
      return;
    }
    setStep(2);
    setError("");
    setMessage("");
  };

  const handleResendConfirmation = async () => {
    setLoading(true);
    setError("");
    const { error: resendError } = await supabase.auth.resend({
      type: 'signup',
      email: email,
    });
    setLoading(false);
    if (resendError) {
      setError("Failed to resend confirmation email: " + resendError.message);
    } else {
      setMessage("✅ Confirmation email sent! Please check your inbox and click the verification link.");
      setTimeout(() => setMessage(""), 5000);
    }
  };

  const handleCheckStatus = async () => {
    setLoading(true);
    setError("");
    setMessage("");
    
    try {
      // Try to get user info to check confirmation status
      const { data: { user }, error } = await supabase.auth.getUser();
      
      if (error) {
        // Try to sign in to check if email is confirmed
        const { error: signInError } = await supabase.auth.signInWithPassword({
          email: email,
          password: "temp_check_password"
        });
        
        if (signInError) {
          if (signInError.message.toLowerCase().includes("email not confirmed")) {
            setError("❌ Your email is still not confirmed. Please check your inbox and click the verification link.");
          } else if (signInError.message.toLowerCase().includes("invalid login credentials")) {
            setMessage("✅ Your email appears to be confirmed! You can now log in with your password.");
            setTimeout(() => router.push("/login"), 3000);
          } else {
            setError("Error checking email status: " + signInError.message);
          }
        }
      } else if (user?.email_confirmed_at) {
        setMessage("✅ Your email is already verified! You can now log in.");
        setTimeout(() => router.push("/login"), 3000);
      }
    } catch (err) {
      setError("Error checking email status. Please try again.");
    }
    
    setLoading(false);
  };

  const handleGoToLogin = () => {
    router.push("/login");
  };

  return (
    <div className="flex min-h-screen items-center justify-center bg-background">
      <Card className="w-full max-w-md p-8 space-y-6">
        <h1 className="text-2xl font-bold mb-4">Verify Your Email</h1>
        
        {step === 1 ? (
          <div className="space-y-4">
            <div>
              <label className="block text-sm font-medium mb-2">Email Address</label>
              <input
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                placeholder="Enter your email address"
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            
            {error && (
              <div className="p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                {error}
              </div>
            )}

            <Button
              onClick={handleEmailSubmit}
              disabled={!email}
              className="w-full"
            >
              Continue
            </Button>
          </div>
        ) : (
          <div className="space-y-4">
            <div className="text-center">
              <p className="text-sm text-gray-600 mb-4">
                Email: <span className="font-medium">{email}</span>
              </p>
            </div>

            {message && (
              <div className="p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                {message}
              </div>
            )}

            {error && (
              <div className="p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                {error}
              </div>
            )}

            <div className="space-y-3">
              <Button
                onClick={handleResendConfirmation}
                disabled={loading}
                className="w-full"
              >
                {loading ? "Sending..." : "📧 Resend Confirmation Email"}
              </Button>

              <Button
                onClick={handleCheckStatus}
                disabled={loading}
                variant="outline"
                className="w-full"
              >
                {loading ? "Checking..." : "🔍 Check Email Status"}
              </Button>

              <Button
                onClick={handleGoToLogin}
                variant="outline"
                className="w-full"
              >
                🚪 Go to Login
              </Button>
            </div>

            <div className="text-center pt-4">
              <button
                onClick={() => setStep(1)}
                className="text-sm text-blue-600 hover:underline"
              >
                ← Change Email
              </button>
            </div>
          </div>
        )}

        <div className="text-center pt-4 border-t">
          <p className="text-xs text-gray-500 mb-2">Having trouble?</p>
          <div className="space-y-2 text-sm">
            <p>1. Check your spam/junk folder</p>
            <p>2. Make sure you clicked the verification link</p>
            <p>3. Wait a few minutes after clicking the link</p>
          </div>
        </div>
      </Card>
    </div>
  );
}
