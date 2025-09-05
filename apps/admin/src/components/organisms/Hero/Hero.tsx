import React from 'react';
import { Text } from '../../atoms/Typography/Text';
import { Button } from '../../atoms/Button/Button';

interface HeroProps {
  title: string;
  subtitle?: string;
  description?: string;
  primaryAction?: {
    label: string;
    onClick: () => void;
  };
  secondaryAction?: {
    label: string;
    onClick: () => void;
  };
  backgroundImage?: string;
  className?: string;
}

export const Hero: React.FC<HeroProps> = ({
  title,
  subtitle,
  description,
  primaryAction,
  secondaryAction,
  backgroundImage,
  className = '',
}) => {
  const backgroundStyle = backgroundImage 
    ? { backgroundImage: `url(${backgroundImage})` }
    : {};

  return (
    <section 
      className={`relative bg-gray-50 py-20 ${className}`}
      style={backgroundStyle}
    >
      {backgroundImage && (
        <div className="absolute inset-0 bg-black bg-opacity-50" />
      )}
      
      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center">
          {subtitle && (
            <Text 
              variant="body" 
              color="secondary" 
              className="text-sm font-semibold uppercase tracking-wide mb-4"
            >
              {subtitle}
            </Text>
          )}
          
          <Text 
            variant="h1" 
            className="text-4xl md:text-6xl font-bold text-gray-900 mb-6"
          >
            {title}
          </Text>
          
          {description && (
            <Text 
              variant="body" 
              color="secondary" 
              className="text-xl text-gray-600 max-w-3xl mx-auto mb-8"
            >
              {description}
            </Text>
          )}
          
          {(primaryAction || secondaryAction) && (
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              {primaryAction && (
                <Button
                  size="lg"
                  onClick={primaryAction.onClick}
                  className="px-8 py-3"
                >
                  {primaryAction.label}
                </Button>
              )}
              
              {secondaryAction && (
                <Button
                  variant="outline"
                  size="lg"
                  onClick={secondaryAction.onClick}
                  className="px-8 py-3"
                >
                  {secondaryAction.label}
                </Button>
              )}
            </div>
          )}
        </div>
      </div>
    </section>
  );
};
