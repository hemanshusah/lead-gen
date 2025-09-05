import React from 'react';
import { MainLayout } from '../templates/MainLayout';
import { Hero } from '../organisms/Hero/Hero';
import { Card } from '../molecules/Card/Card';
import { Text } from '../atoms/Typography/Text';
import { Button } from '../atoms/Button/Button';

export const HomePage: React.FC = () => {
  const handleGetStarted = () => {
    console.log('Get Started clicked');
  };

  const handleLearnMore = () => {
    console.log('Learn More clicked');
  };

  const handleSearch = (query: string) => {
    console.log('Search query:', query);
  };

  const navItems = [
    { label: 'Home', href: '/', active: true },
    { label: 'Features', href: '/features' },
    { label: 'Pricing', href: '/pricing' },
    { label: 'Contact', href: '/contact' },
  ];

  const footerLinks = [
    { label: 'About Us', href: '/about' },
    { label: 'Features', href: '/features' },
    { label: 'Pricing', href: '/pricing' },
    { label: 'Contact', href: '/contact' },
  ];

  const socialLinks = [
    {
      name: 'Twitter',
      href: 'https://twitter.com',
      icon: <span>🐦</span>,
    },
    {
      name: 'LinkedIn',
      href: 'https://linkedin.com',
      icon: <span>💼</span>,
    },
    {
      name: 'GitHub',
      href: 'https://github.com',
      icon: <span>🐙</span>,
    },
  ];

  return (
    <MainLayout
      navbarProps={{
        navItems,
        onSearch: handleSearch,
        searchPlaceholder: 'Search features...',
      }}
      footerProps={{
        links: footerLinks,
        socialLinks,
      }}
    >
      <Hero
        title="Welcome to Admin Panel"
        subtitle="Powerful & Intuitive"
        description="Manage your application with our comprehensive admin panel. Built with modern technologies and designed for efficiency."
        primaryAction={{
          label: 'Get Started',
          onClick: handleGetStarted,
        }}
        secondaryAction={{
          label: 'Learn More',
          onClick: handleLearnMore,
        }}
      />

      {/* Features Section */}
      <section className="py-20 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <Text variant="h2" className="text-3xl font-bold text-gray-900 mb-4">
              Why Choose Our Admin Panel?
            </Text>
            <Text variant="body" color="secondary" className="text-xl text-gray-600">
              Everything you need to manage your application effectively
            </Text>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <Card
              title="Easy to Use"
              subtitle="Intuitive interface"
              hover
            >
              <Text variant="body" color="secondary">
                Our admin panel is designed with user experience in mind. 
                Navigate and manage your data effortlessly.
              </Text>
            </Card>

            <Card
              title="Powerful Features"
              subtitle="Everything you need"
              hover
            >
              <Text variant="body" color="secondary">
                Comprehensive set of tools and features to handle all your 
                administrative tasks efficiently.
              </Text>
            </Card>

            <Card
              title="Secure & Reliable"
              subtitle="Enterprise-grade security"
              hover
            >
              <Text variant="body" color="secondary">
                Built with security best practices and designed to handle 
                enterprise-level workloads reliably.
              </Text>
            </Card>
          </div>
        </div>
      </section>
    </MainLayout>
  );
};
