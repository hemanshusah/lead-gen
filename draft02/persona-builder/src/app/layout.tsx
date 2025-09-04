import type { Metadata } from "next";
import "./globals.css";

export const metadata: Metadata = {
  title: "Lead Gen - User Persona Builder",
  description: "Create and manage your target customer personas for lead generation",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body className="bg-gray-50 antialiased">
        {children}
      </body>
    </html>
  );
}