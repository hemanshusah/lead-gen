import React from 'react';
import { NavItem } from '../../molecules/NavItem/NavItem';
import { SearchBar } from '../../molecules/SearchBar/SearchBar';

interface NavbarProps {
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
  className?: string;
}

export const Navbar: React.FC<NavbarProps> = ({
  logo,
  searchPlaceholder = 'Search...',
  onSearch,
  navItems = [],
  userMenu,
  className = '',
}) => {
  return (
    <nav className={`bg-white shadow-sm border-b border-gray-200 ${className}`}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          {/* Logo */}
          <div className="flex-shrink-0">
            {logo || (
              <div className="text-xl font-bold text-gray-900">
                Admin Panel
              </div>
            )}
          </div>

          {/* Navigation Items */}
          <div className="hidden md:block">
            <div className="ml-10 flex items-baseline space-x-4">
              {navItems.map((item, index) => (
                <NavItem
                  key={index}
                  href={item.href}
                  onClick={item.onClick}
                  active={item.active}
                  icon={item.icon}
                >
                  {item.label}
                </NavItem>
              ))}
            </div>
          </div>

          {/* Search and User Menu */}
          <div className="flex items-center space-x-4">
            {/* Search Bar */}
            {onSearch && (
              <div className="hidden lg:block">
                <SearchBar
                  placeholder={searchPlaceholder}
                  onSearch={onSearch}
                  className="w-64"
                />
              </div>
            )}

            {/* User Menu */}
            {userMenu && (
              <div className="ml-4">
                {userMenu}
              </div>
            )}
          </div>
        </div>
      </div>
    </nav>
  );
};
