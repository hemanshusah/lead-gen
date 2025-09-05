import React from 'react';

interface NavItemProps {
  children: React.ReactNode;
  href?: string;
  active?: boolean;
  onClick?: () => void;
  icon?: React.ReactNode;
  className?: string;
  disabled?: boolean;
}

export const NavItem: React.FC<NavItemProps> = ({
  children,
  href,
  active = false,
  onClick,
  icon,
  className = '',
  disabled = false,
}) => {
  const baseClasses = 'flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200';
  
  const activeClasses = active 
    ? 'bg-blue-100 text-blue-700' 
    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900';
  
  const disabledClasses = disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer';
  
  const classes = `${baseClasses} ${activeClasses} ${disabledClasses} ${className}`.trim();
  
  const content = (
    <>
      {icon && <span className="mr-2">{icon}</span>}
      {children}
    </>
  );
  
  if (href && !disabled) {
    return (
      <a href={href} className={classes}>
        {content}
      </a>
    );
  }
  
  return (
    <button
      className={classes}
      onClick={disabled ? undefined : onClick}
      disabled={disabled}
    >
      {content}
    </button>
  );
};
