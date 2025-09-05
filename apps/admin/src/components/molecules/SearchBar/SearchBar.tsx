import React, { useState } from 'react';
import { Input } from '../../atoms/Input/Input';
import { Button } from '../../atoms/Button/Button';

interface SearchBarProps {
  placeholder?: string;
  onSearch?: (query: string) => void;
  onClear?: () => void;
  className?: string;
  showClearButton?: boolean;
  autoFocus?: boolean;
}

export const SearchBar: React.FC<SearchBarProps> = ({
  placeholder = 'Search...',
  onSearch,
  onClear,
  className = '',
  showClearButton = true,
  autoFocus = false,
}) => {
  const [query, setQuery] = useState('');

  const handleSearch = () => {
    onSearch?.(query);
  };

  const handleClear = () => {
    setQuery('');
    onClear?.();
  };

  const handleKeyPress = (e: React.KeyboardEvent) => {
    if (e.key === 'Enter') {
      handleSearch();
    }
  };

  return (
    <div className={`flex gap-2 ${className}`}>
      <Input
        type="text"
        placeholder={placeholder}
        value={query}
        onChange={(e) => setQuery(e.target.value)}
        onKeyPress={handleKeyPress}
        autoFocus={autoFocus}
        className="flex-1"
      />
      <Button onClick={handleSearch} variant="primary">
        Search
      </Button>
      {showClearButton && query && (
        <Button onClick={handleClear} variant="outline">
          Clear
        </Button>
      )}
    </div>
  );
};
