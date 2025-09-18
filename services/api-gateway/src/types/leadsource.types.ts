/**
 * LeadSource-related types and interfaces
 */

/**
 * Lead source parameter definition
 */
export interface LeadSourceParam {
  name: string;
  type: string;
  required: boolean;
  description?: string;
  default?: any;
  validation?: {
    min?: number;
    max?: number;
    pattern?: string;
    enum?: string[];
  };
}

/**
 * Lead source with parameters
 */
export interface LeadSourceWithParams {
  id: number;
  name: string;
  description?: string;
  is_active: boolean;
  params: LeadSourceParam[];
}

/**
 * Lead sources response
 */
export interface LeadSourcesResponse {
  success: boolean;
  message: string;
  data: LeadSourceWithParams[];
}

/**
 * Saved input parameter
 */
export interface SavedInputParam {
  name: string;
  value: any;
  type: string;
}

/**
 * Saved input with parameters
 */
export interface SavedInputWithParams {
  id: number;
  name: string;
  source_id: number;
  params: SavedInputParam[];
  is_active: boolean;
  created_at: string;
  updated_at: string;
}

/**
 * Lead source with saved inputs
 */
export interface LeadSourceWithSavedInputs {
  id: number;
  name: string;
  description?: string;
  is_active: boolean;
  params: LeadSourceParam[];
  saved_inputs: SavedInputWithParams[];
}
