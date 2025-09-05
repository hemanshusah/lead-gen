import React from 'react';
import { Text } from '../../atoms/Typography/Text';

interface FooterProps {
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
  className?: string;
}

export const Footer: React.FC<FooterProps> = ({
  companyName = 'Admin Panel',
  year = new Date().getFullYear(),
  links = [],
  socialLinks = [],
  className = '',
}) => {
  return (
    <footer className={`bg-gray-900 text-white ${className}`}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
          {/* Company Info */}
          <div className="col-span-1 md:col-span-2">
            <Text variant="h3" className="text-white mb-4">
              {companyName}
            </Text>
            <Text variant="body" color="muted" className="text-gray-400 mb-4">
              A comprehensive admin panel for managing your application with ease and efficiency.
            </Text>
            {socialLinks.length > 0 && (
              <div className="flex space-x-4">
                {socialLinks.map((social, index) => (
                  <a
                    key={index}
                    href={social.href}
                    className="text-gray-400 hover:text-white transition-colors duration-200"
                    aria-label={social.name}
                  >
                    {social.icon}
                  </a>
                ))}
              </div>
            )}
          </div>

          {/* Quick Links */}
          {links.length > 0 && (
            <div>
              <Text variant="h6" className="text-white mb-4">
                Quick Links
              </Text>
              <ul className="space-y-2">
                {links.map((link, index) => (
                  <li key={index}>
                    <a
                      href={link.href}
                      className="text-gray-400 hover:text-white transition-colors duration-200"
                    >
                      {link.label}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          )}

          {/* Contact Info */}
          <div>
            <Text variant="h6" className="text-white mb-4">
              Contact
            </Text>
            <div className="space-y-2">
              <Text variant="body" color="muted" className="text-gray-400">
                Email: admin@example.com
              </Text>
              <Text variant="body" color="muted" className="text-gray-400">
                Phone: +1 (555) 123-4567
              </Text>
            </div>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="border-t border-gray-800 mt-8 pt-8">
          <div className="flex flex-col md:flex-row justify-between items-center">
            <Text variant="small" color="muted" className="text-gray-400">
              © {year} {companyName}. All rights reserved.
            </Text>
            <div className="flex space-x-6 mt-4 md:mt-0">
              <a href="#" className="text-gray-400 hover:text-white text-sm">
                Privacy Policy
              </a>
              <a href="#" className="text-gray-400 hover:text-white text-sm">
                Terms of Service
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};
