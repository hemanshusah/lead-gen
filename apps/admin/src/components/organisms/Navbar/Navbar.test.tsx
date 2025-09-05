import React from 'react';
import { render, screen, fireEvent } from '@testing-library/react';
import { Navbar } from './Navbar';

describe('Navbar Component', () => {
  it('renders with default logo', () => {
    render(<Navbar />);
    expect(screen.getByText('Admin Panel')).toBeInTheDocument();
  });

  it('renders with custom logo', () => {
    render(<Navbar logo={<div>Custom Logo</div>} />);
    expect(screen.getByText('Custom Logo')).toBeInTheDocument();
  });

  it('renders navigation items', () => {
    const navItems = [
      { label: 'Dashboard', href: '/dashboard' },
      { label: 'Users', href: '/users' },
      { label: 'Settings', href: '/settings' },
    ];
    
    render(<Navbar navItems={navItems} />);
    
    expect(screen.getByText('Dashboard')).toBeInTheDocument();
    expect(screen.getByText('Users')).toBeInTheDocument();
    expect(screen.getByText('Settings')).toBeInTheDocument();
  });

  it('highlights active navigation item', () => {
    const navItems = [
      { label: 'Dashboard', href: '/dashboard', active: true },
      { label: 'Users', href: '/users' },
    ];
    
    render(<Navbar navItems={navItems} />);
    
    const dashboardItem = screen.getByText('Dashboard').closest('a');
    expect(dashboardItem).toHaveClass('bg-blue-100', 'text-blue-700');
  });

  it('renders search bar when onSearch is provided', () => {
    const mockOnSearch = jest.fn();
    render(<Navbar onSearch={mockOnSearch} />);
    
    expect(screen.getByPlaceholderText('Search...')).toBeInTheDocument();
  });

  it('renders user menu when provided', () => {
    render(<Navbar userMenu={<button>User Menu</button>} />);
    expect(screen.getByText('User Menu')).toBeInTheDocument();
  });

  it('calls onSearch when search is performed', () => {
    const mockOnSearch = jest.fn();
    render(<Navbar onSearch={mockOnSearch} />);
    
    const searchInput = screen.getByPlaceholderText('Search...');
    const searchButton = screen.getByText('Search');
    
    fireEvent.change(searchInput, { target: { value: 'test query' } });
    fireEvent.click(searchButton);
    
    expect(mockOnSearch).toHaveBeenCalledWith('test query');
  });
});
