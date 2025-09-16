"use client";

import { Card } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import * as z from "zod";
import { useState, useEffect } from "react";
import { supabase } from "@/lib/supabaseClient";
import { useRouter } from "next/navigation";
import Link from "next/link";

const schema = z.object({
  email: z.string().email({ message: "Invalid email address" }),
  password: z.string().min(6, { message: "Password must be at least 6 characters" }),
});

type FormData = z.infer<typeof schema>;

export default function LoginPage() {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const [showResendButton, setShowResendButton] = useState(false);
  const [emailForResend, setEmailForResend] = useState("");
  const router = useRouter();
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<FormData>({
    resolver: zodResolver(schema),
  });

  const handleResendConfirmation = async () => {
    if (!emailForResend) return;
    setLoading(true);
    const { error: resendError } = await supabase.auth.resend({
      type: 'signup',
      email: emailForResend,
    });
    setLoading(false);
    if (resendError) {
      setError("Failed to resend confirmation email: " + resendError.message);
    } else {
      setError("Confirmation email sent! Please check your inbox and click the verification link.");
      setShowResendButton(false);
    }
  };

  const onSubmit = async (data: FormData) => {
    setLoading(true);
    setError("");
    setShowResendButton(false);
    const { email, password } = data;
    setEmailForResend(email);
    const { data: signInData, error: signInError } = await supabase.auth.signInWithPassword({ email, password });
    setLoading(false);
    if (signInError) {
      if (signInError.message.toLowerCase().includes("email not confirmed") || signInError.message.toLowerCase().includes("confirm your email")) {
        setError("Your email is not confirmed. Please check your inbox and verify your email before logging in.");
        setShowResendButton(true);
      } else {
        setError(signInError.message);
      }
      return;
    }
    // If login is successful, check if profile exists
    const user = signInData.user;
    if (user) {
      try {
        const { data: profileRows, error: profileFetchError } = await supabase
          .from("profiles")
          .select("id")
          .eq("id", user.id)
          .single();
        
        if (!profileRows && !profileFetchError) {
          // Profile does not exist, insert it
          const { error: profileInsertError } = await supabase
            .from("profiles")
            .insert({ id: user.id, email: user.email });
          
          if (profileInsertError) {
            console.error("Failed to create profile:", profileInsertError);
            // Continue anyway - user is logged in
          }
        }
      } catch (err) {
        console.error("Profile check failed:", err);
        // Continue anyway - user is logged in
      }
    }
    router.push("/profile");
  };

  return (
    <div className="flex min-h-screen items-center justify-center bg-background">
      <Card className="w-full max-w-md p-8 space-y-6">
        <h1 className="text-2xl font-bold mb-4">Login</h1>
        <form className="space-y-4" onSubmit={handleSubmit(onSubmit)}>
          <div>
            <Label htmlFor="email">Email Address</Label>
            <Input id="email" type="email" {...register("email")}/>
            {errors.email && <p className="text-destructive text-xs mt-1">{errors.email.message}</p>}
          </div>
          <div>
            <Label htmlFor="password">Password</Label>
            <Input id="password" type="password" {...register("password")}/>
            {errors.password && <p className="text-destructive text-xs mt-1">{errors.password.message}</p>}
          </div>
          {error && <p className="text-destructive text-sm">{error}</p>}
          {showResendButton && (
            <div className="text-center space-y-3">
              <Button 
                type="button" 
                variant="outline" 
                onClick={handleResendConfirmation}
                disabled={loading}
                className="w-full"
              >
                {loading ? "Sending..." : "Resend Confirmation Email"}
              </Button>
              <div className="text-sm">
                <Link href="/verify-email" className="text-blue-600 hover:underline">
                  Need help verifying your email? Click here
                </Link>
              </div>
            </div>
          )}
          <Button type="submit" className="w-full" disabled={loading}>
            {loading ? "Logging in..." : "Login"}
          </Button>
        </form>
        <div className="text-center mt-2">
          <Link href="/forgot-password" className="text-sm text-primary underline hover:text-primary/80">Forgot Password?</Link>
        </div>
      </Card>
    </div>
  );
}
