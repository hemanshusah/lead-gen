import React, { useState } from 'react';
import { InputGroup, InputLeftElement, InputRightElement, IconButton } from '@chakra-ui/react';
import { FiSearch, FiX } from 'react-icons/fi';
import { Input } from '../../atoms/Input';

export interface SearchBarProps {
  placeholder?: string;
  onSearch?: (query: string) => void;
  onClear?: () => void;
  value?: string;
  onChange?: (value: string) => void;
  className?: string;
}

export const SearchBar: React.FC<SearchBarProps> = ({
  placeholder = 'Search...',
  onSearch,
  onClear,
  value,
  onChange,
  className,
}) => {
  const [searchValue, setSearchValue] = useState(value || '');

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const newValue = e.target.value;
    setSearchValue(newValue);
    onChange?.(newValue);
  };

  const handleSearch = () => {
    onSearch?.(searchValue);
  };

  const handleClear = () => {
    setSearchValue('');
    onChange?.('');
    onClear?.();
  };

  const handleKeyPress = (e: React.KeyboardEvent) => {
    if (e.key === 'Enter') {
      handleSearch();
    }
  };

  return (
    <InputGroup className={className}>
      <InputLeftElement pointerEvents="none">
        <FiSearch color="gray.300" />
      </InputLeftElement>
      <Input
        placeholder={placeholder}
        value={searchValue}
        onChange={handleChange}
        onKeyPress={handleKeyPress}
      />
      {searchValue && (
        <InputRightElement>
          <IconButton
            aria-label="Clear search"
            icon={<FiX />}
            size="sm"
            variant="ghost"
            onClick={handleClear}
          />
        </InputRightElement>
      )}
    </InputGroup>
  );
};
