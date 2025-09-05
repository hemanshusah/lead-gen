import React from 'react';
import { render, screen } from '@testing-library/react';
import { Card } from './Card';

describe('Card Component', () => {
  it('renders children content', () => {
    render(
      <Card>
        <p>Card content</p>
      </Card>
    );
    expect(screen.getByText('Card content')).toBeInTheDocument();
  });

  it('renders with title', () => {
    render(
      <Card title="Card Title">
        <p>Card content</p>
      </Card>
    );
    expect(screen.getByText('Card Title')).toBeInTheDocument();
  });

  it('renders with subtitle', () => {
    render(
      <Card title="Card Title" subtitle="Card subtitle">
        <p>Card content</p>
      </Card>
    );
    expect(screen.getByText('Card subtitle')).toBeInTheDocument();
  });

  it('renders with actions', () => {
    render(
      <Card 
        title="Card Title" 
        actions={<button>Action</button>}
      >
        <p>Card content</p>
      </Card>
    );
    expect(screen.getByText('Action')).toBeInTheDocument();
  });

  it('applies custom className', () => {
    render(
      <Card className="custom-class">
        <p>Card content</p>
      </Card>
    );
    const card = screen.getByText('Card content').closest('div');
    expect(card).toHaveClass('custom-class');
  });

  it('applies hover effect when hover prop is true', () => {
    render(
      <Card hover>
        <p>Card content</p>
      </Card>
    );
    const card = screen.getByText('Card content').closest('div');
    expect(card).toHaveClass('hover:shadow-lg');
  });
});
