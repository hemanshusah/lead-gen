import {injectable, BindingScope} from '@loopback/core';
import * as bcrypt from 'bcryptjs';
import {PasswordValidationResult} from '../types/auth.types';

/**
 * Password Service
 * Handles password hashing, verification, and validation
 */
@injectable({scope: BindingScope.SINGLETON})
export class PasswordService {
  private readonly saltRounds: number = 12;

  /**
   * Hash a password using bcrypt
   * @param password Plain text password
   * @returns Hashed password
   */
  async hashPassword(password: string): Promise<string> {
    try {
      return await bcrypt.hash(password, this.saltRounds);
    } catch (error) {
      throw new Error(`Password hashing failed: ${error}`);
    }
  }

  /**
   * Verify a password against its hash
   * @param password Plain text password
   * @param hash Hashed password from database
   * @returns True if password matches, false otherwise
   */
  async verifyPassword(password: string, hash: string): Promise<boolean> {
    try {
      return await bcrypt.compare(password, hash);
    } catch (error) {
      console.error('Password verification error:', error);
      return false;
    }
  }

  /**
   * Validate password strength
   * @param password Password to validate
   * @returns Validation result with errors if any
   */
  validatePasswordStrength(password: string): PasswordValidationResult {
    const errors: string[] = [];

    // Minimum length
    if (password.length < 8) {
      errors.push('Password must be at least 8 characters long');
    }

    // Maximum length
    if (password.length > 128) {
      errors.push('Password must be no more than 128 characters long');
    }

    // Check for at least one lowercase letter
    if (!/[a-z]/.test(password)) {
      errors.push('Password must contain at least one lowercase letter');
    }

    // Check for at least one uppercase letter
    if (!/[A-Z]/.test(password)) {
      errors.push('Password must contain at least one uppercase letter');
    }

    // Check for at least one number
    if (!/\d/.test(password)) {
      errors.push('Password must contain at least one number');
    }

    // Check for at least one special character
    if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
      errors.push('Password must contain at least one special character');
    }

    // Check for common weak patterns
    const commonPatterns = [
      /(.)\1{2,}/, // Repeated characters
      /123|234|345|456|567|678|789/, // Sequential numbers
      /abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz/, // Sequential letters
      /qwerty|asdfgh|zxcvbn/, // Keyboard patterns
    ];

    for (const pattern of commonPatterns) {
      if (pattern.test(password.toLowerCase())) {
        errors.push('Password contains common patterns that are easy to guess');
        break;
      }
    }

    return {
      isValid: errors.length === 0,
      errors,
    };
  }

  /**
   * Generate a secure random password
   * @param length Password length (default: 16)
   * @returns Generated password
   */
  generateSecurePassword(length: number = 16): string {
    const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
    let password = '';

    // Ensure at least one character from each required category
    const lowercase = 'abcdefghijklmnopqrstuvwxyz';
    const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const numbers = '0123456789';
    const special = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    password += lowercase[Math.floor(Math.random() * lowercase.length)];
    password += uppercase[Math.floor(Math.random() * uppercase.length)];
    password += numbers[Math.floor(Math.random() * numbers.length)];
    password += special[Math.floor(Math.random() * special.length)];

    // Fill the rest with random characters
    for (let i = 4; i < length; i++) {
      password += charset[Math.floor(Math.random() * charset.length)];
    }

    // Shuffle the password
    return password
      .split('')
      .sort(() => Math.random() - 0.5)
      .join('');
  }

  /**
   * Check if password is in common password list
   * @param password Password to check
   * @returns True if password is common/weak
   */
  isCommonPassword(password: string): boolean {
    const commonPasswords = [
      'password',
      '123456',
      '123456789',
      'qwerty',
      'abc123',
      'password123',
      'admin',
      'letmein',
      'welcome',
      'monkey',
      '1234567890',
      'password1',
      'qwerty123',
      'dragon',
      'master',
      'hello',
      'freedom',
      'whatever',
      'qazwsx',
      'trustno1',
      'jordan23',
      'harley',
      'ranger',
      'jordan',
      'hunter',
      'buster',
      'soccer',
      'hockey',
      'killer',
      'george',
      'sexy',
      'andrew',
      'charlie',
      'superman',
      'asshole',
      'fuckyou',
      'dallas',
      'jessica',
      'pussy',
      'hannah',
      'maggie',
      'jennifer',
      'joshua',
      'amanda',
      'justin',
      'sarah',
      'jessica',
      'brittany',
      'samantha',
      'ashley',
      'jessica',
      'amanda',
      'stephanie',
      'jennifer',
      'nicole',
      'elizabeth',
      'heather',
      'amber',
      'megan',
      'rachel',
      'emily',
      'lauren',
      'samantha',
      'kimberly',
      'christina',
      'michelle',
      'danielle',
      'andrea',
      'stephanie',
      'laura',
      'heather',
      'melissa',
      'rebecca',
      'deborah',
      'dorothy',
      'lisa',
      'nancy',
      'karen',
      'betty',
      'helen',
      'sandra',
      'donna',
      'carol',
      'ruth',
      'sharon',
      'michelle',
      'laura',
      'sarah',
      'kimberly',
      'deborah',
      'dorothy',
      'lisa',
      'nancy',
      'karen',
      'betty',
      'helen',
      'sandra',
      'donna',
      'carol',
      'ruth',
      'sharon',
    ];

    return commonPasswords.includes(password.toLowerCase());
  }
}
