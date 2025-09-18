import {injectable, BindingScope, inject} from '@loopback/core';
import * as jwt from 'jsonwebtoken';
import {AuthUser, JwtPayload} from '../types/auth.types';

/**
 * JWT Service
 * Handles JWT token generation, verification, and management
 */
@injectable({scope: BindingScope.SINGLETON})
export class JwtService {
  private readonly secret: string;
  private readonly expiresIn: string = '24h';
  private readonly issuer: string = 'lead-gen-api';
  private readonly audience: string = 'lead-gen-users';

  constructor(
    @inject('authentication.jwt.secret')
    secret: string,
  ) {
    this.secret = secret;
  }

  /**
   * Generate a JWT token for a user
   * @param user User information
   * @returns JWT token string
   */
  async generateToken(user: AuthUser): Promise<string> {
    try {
      const payload: Partial<JwtPayload> = {
        sub: user.id,
        email: user.email,
        name: user.name,
        role: user.role,
        account_id: user.account_id,
        status: user.status,
        account: user.account,
      };

      const options: jwt.SignOptions = {
        issuer: this.issuer,
        audience: this.audience,
        expiresIn: this.expiresIn as jwt.SignOptions['expiresIn'],
        algorithm: 'HS256',
      };

      return jwt.sign(payload, this.secret, options);
    } catch (error) {
      throw new Error(`Token generation failed: ${error}`);
    }
  }

  /**
   * Verify and decode a JWT token
   * @param token JWT token string
   * @returns Decoded payload
   */
  async verifyToken(token: string): Promise<JwtPayload> {
    try {
      const options: jwt.VerifyOptions = {
        issuer: this.issuer,
        audience: this.audience,
        algorithms: ['HS256'],
      };

      return jwt.verify(token, this.secret, options) as unknown as JwtPayload;
    } catch (error) {
      if (error instanceof jwt.TokenExpiredError) {
        throw new Error('Token has expired');
      }
      if (error instanceof jwt.JsonWebTokenError) {
        throw new Error('Invalid token');
      }
      throw new Error(`Token verification failed: ${error}`);
    }
  }

  /**
   * Decode a JWT token without verification (for debugging)
   * @param token JWT token string
   * @returns Decoded payload
   */
  decodeToken(token: string): JwtPayload | null {
    try {
      return jwt.decode(token) as unknown as JwtPayload;
    } catch (error) {
      return null;
    }
  }

  /**
   * Get token expiration time in seconds
   * @returns Expiration time in seconds
   */
  getTokenExpiration(): number {
    // Convert expiresIn string to seconds
    const expiresIn = this.expiresIn;
    if (expiresIn.endsWith('h')) {
      return parseInt(expiresIn.slice(0, -1)) * 3600;
    }
    if (expiresIn.endsWith('d')) {
      return parseInt(expiresIn.slice(0, -1)) * 86400;
    }
    if (expiresIn.endsWith('m')) {
      return parseInt(expiresIn.slice(0, -1)) * 60;
    }
    if (expiresIn.endsWith('s')) {
      return parseInt(expiresIn.slice(0, -1));
    }
    // Default to 24 hours
    return 86400;
  }

  /**
   * Check if a token is expired
   * @param token JWT token string
   * @returns True if token is expired
   */
  isTokenExpired(token: string): boolean {
    try {
      const decoded = this.decodeToken(token);
      if (!decoded || !decoded.exp) {
        return true;
      }
      return Date.now() >= decoded.exp * 1000;
    } catch (error) {
      return true;
    }
  }

  /**
   * Get token expiration date
   * @param token JWT token string
   * @returns Expiration date or null if invalid
   */
  getTokenExpirationDate(token: string): Date | null {
    try {
      const decoded = this.decodeToken(token);
      if (!decoded || !decoded.exp) {
        return null;
      }
      return new Date(decoded.exp * 1000);
    } catch (error) {
      return null;
    }
  }

  /**
   * Get token issued date
   * @param token JWT token string
   * @returns Issued date or null if invalid
   */
  getTokenIssuedDate(token: string): Date | null {
    try {
      const decoded = this.decodeToken(token);
      if (!decoded || !decoded.iat) {
        return null;
      }
      return new Date(decoded.iat * 1000);
    } catch (error) {
      return null;
    }
  }

  /**
   * Extract user information from token
   * @param token JWT token string
   * @returns User information or null if invalid
   */
  extractUserFromToken(token: string): AuthUser | null {
    try {
      const decoded = this.decodeToken(token);
      if (!decoded) {
        return null;
      }

      return {
        id: decoded.sub,
        email: decoded.email,
        name: decoded.name,
        role: decoded.role,
        account_id: decoded.account_id,
        status: decoded.status,
        account: decoded.account,
      };
    } catch (error) {
      return null;
    }
  }

  /**
   * Generate a refresh token (longer expiration)
   * @param user User information
   * @returns Refresh token string
   */
  async generateRefreshToken(user: AuthUser): Promise<string> {
    try {
      const payload: Partial<JwtPayload> = {
        sub: user.id,
        email: user.email,
        name: user.name,
        role: user.role,
        account_id: user.account_id,
        status: user.status,
        account: user.account,
      };

      const options: jwt.SignOptions = {
        issuer: this.issuer,
        audience: this.audience,
        expiresIn: '7d', // 7 days for refresh token
        algorithm: 'HS256',
      };

      return jwt.sign(payload, this.secret, options);
    } catch (error) {
      throw new Error(`Refresh token generation failed: ${error}`);
    }
  }

  /**
   * Verify refresh token
   * @param token Refresh token string
   * @returns Decoded payload
   */
  async verifyRefreshToken(token: string): Promise<JwtPayload> {
    try {
      const options: jwt.VerifyOptions = {
        issuer: this.issuer,
        audience: this.audience,
        algorithms: ['HS256'],
      };

      return jwt.verify(token, this.secret, options) as unknown as JwtPayload;
    } catch (error) {
      if (error instanceof jwt.TokenExpiredError) {
        throw new Error('Refresh token has expired');
      }
      if (error instanceof jwt.JsonWebTokenError) {
        throw new Error('Invalid refresh token');
      }
      throw new Error(`Refresh token verification failed: ${error}`);
    }
  }
}
