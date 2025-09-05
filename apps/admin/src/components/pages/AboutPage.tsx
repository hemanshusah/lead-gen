import React from 'react';
import { MainLayout } from '../templates/MainLayout';
import { Card } from '../molecules/Card/Card';
import { Text } from '../atoms/Typography/Text';
import { Button } from '../atoms/Button/Button';

export const AboutPage: React.FC = () => {
  const handleContactUs = () => {
    console.log('Contact Us clicked');
  };

  const navItems = [
    { label: 'Home', href: '/' },
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

  return (
    <MainLayout
      navbarProps={{ navItems }}
      footerProps={{ links: footerLinks }}
    >
      <div className="py-20 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          {/* Header */}
          <div className="text-center mb-16">
            <Text variant="h1" className="text-4xl font-bold text-gray-900 mb-6">
              About Our Admin Panel
            </Text>
            <Text variant="body" color="secondary" className="text-xl text-gray-600 max-w-3xl mx-auto">
              We're passionate about creating tools that make complex tasks simple and efficient.
            </Text>
          </div>

          {/* Mission & Vision */}
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">
            <Card title="Our Mission" padding="lg">
              <Text variant="body" color="secondary" className="mb-4">
                To empower businesses and developers with intuitive, powerful, and reliable 
                administrative tools that streamline operations and enhance productivity.
              </Text>
              <Text variant="body" color="secondary">
                We believe that great software should be both powerful and easy to use, 
                enabling teams to focus on what matters most - building amazing products.
              </Text>
            </Card>

            <Card title="Our Vision" padding="lg">
              <Text variant="body" color="secondary" className="mb-4">
                To become the leading provider of administrative solutions that set the 
                standard for user experience, performance, and reliability in the industry.
              </Text>
              <Text variant="body" color="secondary">
                We envision a future where complex administrative tasks are simplified 
                through thoughtful design and cutting-edge technology.
              </Text>
            </Card>
          </div>

          {/* Team Section */}
          <div className="mb-20">
            <Text variant="h2" className="text-3xl font-bold text-gray-900 text-center mb-12">
              Meet Our Team
            </Text>
            
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              <Card className="text-center" hover>
                <div className="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4"></div>
                <Text variant="h6" className="mb-2">John Doe</Text>
                <Text variant="body" color="secondary" className="mb-4">Lead Developer</Text>
                <Text variant="body" color="muted">
                  Passionate about creating elegant solutions to complex problems.
                </Text>
              </Card>

              <Card className="text-center" hover>
                <div className="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4"></div>
                <Text variant="h6" className="mb-2">Jane Smith</Text>
                <Text variant="body" color="secondary" className="mb-4">UI/UX Designer</Text>
                <Text variant="body" color="muted">
                  Focused on creating intuitive and beautiful user experiences.
                </Text>
              </Card>

              <Card className="text-center" hover>
                <div className="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4"></div>
                <Text variant="h6" className="mb-2">Mike Johnson</Text>
                <Text variant="body" color="secondary" className="mb-4">Product Manager</Text>
                <Text variant="body" color="muted">
                  Dedicated to understanding user needs and delivering value.
                </Text>
              </Card>
            </div>
          </div>

          {/* Values */}
          <div className="bg-gray-50 rounded-lg p-8">
            <Text variant="h2" className="text-3xl font-bold text-gray-900 text-center mb-12">
              Our Values
            </Text>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
              <div className="text-center">
                <div className="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span className="text-2xl">🎯</span>
                </div>
                <Text variant="h6" className="mb-2">Excellence</Text>
                <Text variant="body" color="muted" className="text-sm">
                  We strive for excellence in everything we do.
                </Text>
              </div>

              <div className="text-center">
                <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span className="text-2xl">🤝</span>
                </div>
                <Text variant="h6" className="mb-2">Collaboration</Text>
                <Text variant="body" color="muted" className="text-sm">
                  We believe in the power of teamwork.
                </Text>
              </div>

              <div className="text-center">
                <div className="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span className="text-2xl">💡</span>
                </div>
                <Text variant="h6" className="mb-2">Innovation</Text>
                <Text variant="body" color="muted" className="text-sm">
                  We embrace new ideas and technologies.
                </Text>
              </div>

              <div className="text-center">
                <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span className="text-2xl">🔒</span>
                </div>
                <Text variant="h6" className="mb-2">Trust</Text>
                <Text variant="body" color="muted" className="text-sm">
                  We build trust through transparency and reliability.
                </Text>
              </div>
            </div>
          </div>

          {/* CTA Section */}
          <div className="text-center mt-16">
            <Text variant="h3" className="text-2xl font-bold text-gray-900 mb-4">
              Ready to Get Started?
            </Text>
            <Text variant="body" color="secondary" className="mb-8">
              Join thousands of satisfied customers who trust our admin panel.
            </Text>
            <Button size="lg" onClick={handleContactUs}>
              Contact Us Today
            </Button>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};
