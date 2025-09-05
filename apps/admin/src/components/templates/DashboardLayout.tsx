import React from 'react';
import { Navbar } from '../organisms/Navbar/Navbar';

interface SidebarItem {
  label: string;
  href?: string;
  onClick?: () => void;
  active?: boolean;
  icon?: React.ReactNode;
  children?: SidebarItem[];
}

interface DashboardLayoutProps {
  children: React.ReactNode;
  sidebarItems?: SidebarItem[];
  navbarProps?: {
    logo?: React.ReactNode;
    searchPlaceholder?: string;
    onSearch?: (query: string) => void;
    userMenu?: React.ReactNode;
  };
  className?: string;
}

export const DashboardLayout: React.FC<DashboardLayoutProps> = ({
  children,
  sidebarItems = [],
  navbarProps,
  className = '',
}) => {
  return (
    <div className={`min-h-screen bg-gray-50 ${className}`}>
      <Navbar {...navbarProps} />
      
      <div className="flex">
        {/* Sidebar */}
        <aside className="w-64 bg-white shadow-sm min-h-screen">
          <div className="p-4">
            <nav className="space-y-2">
              {sidebarItems.map((item, index) => (
                <div key={index}>
                  <a
                    href={item.href}
                    onClick={item.onClick}
                    className={`flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200 ${
                      item.active
                        ? 'bg-blue-100 text-blue-700'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                    }`}
                  >
                    {item.icon && <span className="mr-2">{item.icon}</span>}
                    {item.label}
                  </a>
                  
                  {/* Sub-items */}
                  {item.children && item.children.length > 0 && (
                    <div className="ml-4 mt-1 space-y-1">
                      {item.children.map((subItem, subIndex) => (
                        <a
                          key={subIndex}
                          href={subItem.href}
                          onClick={subItem.onClick}
                          className={`flex items-center px-3 py-1.5 text-sm rounded-md transition-colors duration-200 ${
                            subItem.active
                              ? 'bg-blue-50 text-blue-600'
                              : 'text-gray-500 hover:bg-gray-50 hover:text-gray-700'
                          }`}
                        >
                          {subItem.icon && <span className="mr-2">{subItem.icon}</span>}
                          {subItem.label}
                        </a>
                      ))}
                    </div>
                  )}
                </div>
              ))}
            </nav>
          </div>
        </aside>

        {/* Main Content */}
        <main className="flex-1 p-6">
          {children}
        </main>
      </div>
    </div>
  );
};
