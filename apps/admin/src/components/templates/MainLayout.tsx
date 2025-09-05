import React from 'react';
import { Navbar } from '../organisms/Navbar/Navbar';
import { Footer } from '../organisms/Footer/Footer';

interface MainLayoutProps {
  children: React.ReactNode;
  navbarProps?: {
    logo?: React.ReactNode;
    searchPlaceholder?: string;
    onSearch?: (query: string) => void;
    navItems?: Array<{
      label: string;
      href?: string;
      onClick?: () => void;
      active?: boolean;
      icon?: React.ReactNode;
    }>;
    userMenu?: React.ReactNode;
  };
  footerProps?: {
    companyName?: string;
    year?: number;
    links?: Array<{
      label: string;
      href: string;
    }>;
    socialLinks?: Array<{
      name: string;
      href: string;
      icon: React.ReactNode;
    }>;
  };
  className?: string;
}

export const MainLayout: React.FC<MainLayoutProps> = ({
  children,
  navbarProps,
  footerProps,
  className = '',
}) => {
  return (
    <div className={`min-h-screen flex flex-col ${className}`}>
      <Navbar {...navbarProps} />
      
      <main className="flex-1">
        {children}
      </main>
      
      <Footer {...footerProps} />
    </div>
  );
};
