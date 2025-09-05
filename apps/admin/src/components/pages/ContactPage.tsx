import React, { useState } from 'react';
import { MainLayout } from '../templates/MainLayout';
import { Card } from '../molecules/Card/Card';
import { Text } from '../atoms/Typography/Text';
import { Button } from '../atoms/Button/Button';
import { Input } from '../atoms/Input/Input';

export const ContactPage: React.FC = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    subject: '',
    message: '',
  });

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value,
    }));
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    console.log('Form submitted:', formData);
    // Handle form submission here
  };

  const navItems = [
    { label: 'Home', href: '/' },
    { label: 'Features', href: '/features' },
    { label: 'Pricing', href: '/pricing' },
    { label: 'Contact', href: '/contact', active: true },
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
      <div className="py-20 bg-gray-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          {/* Header */}
          <div className="text-center mb-16">
            <Text variant="h1" className="text-4xl font-bold text-gray-900 mb-6">
              Get in Touch
            </Text>
            <Text variant="body" color="secondary" className="text-xl text-gray-600 max-w-3xl mx-auto">
              Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
            </Text>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {/* Contact Form */}
            <Card title="Send us a message" padding="lg">
              <form onSubmit={handleSubmit} className="space-y-6">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <Input
                    label="Name"
                    name="name"
                    value={formData.name}
                    onChange={handleInputChange}
                    required
                  />
                  <Input
                    label="Email"
                    name="email"
                    type="email"
                    value={formData.email}
                    onChange={handleInputChange}
                    required
                  />
                </div>

                <Input
                  label="Subject"
                  name="subject"
                  value={formData.subject}
                  onChange={handleInputChange}
                  required
                />

                <div>
                  <label htmlFor="message" className="block text-sm font-medium text-gray-700 mb-1">
                    Message <span className="text-red-500">*</span>
                  </label>
                  <textarea
                    id="message"
                    name="message"
                    rows={6}
                    value={formData.message}
                    onChange={handleInputChange}
                    required
                    className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Your message here..."
                  />
                </div>

                <Button type="submit" size="lg" className="w-full">
                  Send Message
                </Button>
              </form>
            </Card>

            {/* Contact Information */}
            <div className="space-y-8">
              <Card title="Contact Information" padding="lg">
                <div className="space-y-6">
                  <div className="flex items-start">
                    <div className="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-1">
                      <span>📧</span>
                    </div>
                    <div>
                      <Text variant="h6" className="mb-1">Email</Text>
                      <Text variant="body" color="secondary">
                        admin@example.com
                      </Text>
                    </div>
                  </div>

                  <div className="flex items-start">
                    <div className="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                      <span>📞</span>
                    </div>
                    <div>
                      <Text variant="h6" className="mb-1">Phone</Text>
                      <Text variant="body" color="secondary">
                        +1 (555) 123-4567
                      </Text>
                    </div>
                  </div>

                  <div className="flex items-start">
                    <div className="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                      <span>📍</span>
                    </div>
                    <div>
                      <Text variant="h6" className="mb-1">Address</Text>
                      <Text variant="body" color="secondary">
                        123 Business Street<br />
                        Suite 100<br />
                        City, State 12345
                      </Text>
                    </div>
                  </div>
                </div>
              </Card>

              <Card title="Business Hours" padding="lg">
                <div className="space-y-3">
                  <div className="flex justify-between">
                    <Text variant="body" color="secondary">Monday - Friday</Text>
                    <Text variant="body">9:00 AM - 6:00 PM</Text>
                  </div>
                  <div className="flex justify-between">
                    <Text variant="body" color="secondary">Saturday</Text>
                    <Text variant="body">10:00 AM - 4:00 PM</Text>
                  </div>
                  <div className="flex justify-between">
                    <Text variant="body" color="secondary">Sunday</Text>
                    <Text variant="body">Closed</Text>
                  </div>
                </div>
              </Card>

              <Card title="Quick Response" padding="lg">
                <Text variant="body" color="secondary" className="mb-4">
                  We typically respond to all inquiries within 24 hours during business days.
                </Text>
                <Text variant="body" color="secondary">
                  For urgent matters, please call us directly at the number above.
                </Text>
              </Card>
            </div>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};
