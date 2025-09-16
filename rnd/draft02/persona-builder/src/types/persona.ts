export interface UserPersona {
  id?: string
  persona_name: string
  target_industry: string
  target_location: string
  keywords: string[]
  company_size_min: number
  company_size_max: number
  created_at?: string
  updated_at?: string
}

export interface PersonaFormData {
  persona_name: string
  target_industry: string
  target_location: string
  keywords: string
  company_size_min: number
  company_size_max: number
}
