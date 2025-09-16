'use client'

import { useState } from 'react'
import { PersonaFormData } from '@/types/persona'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Alert, AlertDescription } from '@/components/ui/alert'
import { CheckCircle, AlertCircle } from 'lucide-react'

const INDUSTRY_SUGGESTIONS = [
  'Dentistry',
  'IT Consulting',
  'Real Estate',
  'Healthcare',
  'Finance',
  'Education',
  'Manufacturing',
  'Retail',
  'Technology',
  'Legal Services',
  'Marketing',
  'Construction',
  'Hospitality',
  'Transportation',
  'Other'
]

export default function PersonaForm() {
  const [formData, setFormData] = useState<PersonaFormData>({
    persona_name: '',
    target_industry: '',
    target_location: '',
    keywords: '',
    company_size_min: 1,
    company_size_max: 10
  })
  
  const [isSubmitting, setIsSubmitting] = useState(false)
  const [message, setMessage] = useState<{ type: 'success' | 'error', text: string } | null>(null)

  const handleInputChange = (field: keyof PersonaFormData, value: string | number) => {
    setFormData(prev => ({
      ...prev,
      [field]: value
    }))
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setIsSubmitting(true)
    setMessage(null)

    try {
      const response = await fetch('/api/personas', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      })

      let result: { message?: string; error?: string; data?: unknown } | null = null
      try {
        result = await response.json()
      } catch {
        const text = await response.text()
        throw new Error(text || 'Unexpected server response')
      }

      if (response.ok && result) {
        setMessage({ type: 'success', text: result.message || 'Saved successfully.' })
        // Reset form
        setFormData({
          persona_name: '',
          target_industry: '',
          target_location: '',
          keywords: '',
          company_size_min: 1,
          company_size_max: 10
        })
      } else {
        const errText = result?.error || 'Failed to save persona. Please check your inputs.'
        setMessage({ type: 'error', text: errText })
      }
    } catch (error: unknown) {
      const errorMessage = error instanceof Error ? error.message : 'Failed to save persona. Please try again.'
      setMessage({ type: 'error', text: errorMessage })
    } finally {
      setIsSubmitting(false)
    }
  }

  return (
    <Card className="w-full max-w-2xl mx-auto">
      <CardHeader>
        <CardTitle className="text-3xl font-bold text-center">Create Customer Persona</CardTitle>
        <CardDescription className="text-center">
          Define your ideal customer profile to start generating targeted leads
        </CardDescription>
      </CardHeader>
      
      <CardContent className="space-y-6">
        {message && (
          <Alert className={message.type === 'success' ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50'}>
            {message.type === 'success' ? (
              <CheckCircle className="h-4 w-4 text-green-600" />
            ) : (
              <AlertCircle className="h-4 w-4 text-red-600" />
            )}
            <AlertDescription className={message.type === 'success' ? 'text-green-800' : 'text-red-800'}>
              {message.text}
            </AlertDescription>
          </Alert>
        )}

        <form onSubmit={handleSubmit} className="space-y-6">
          {/* Persona Name */}
          <div className="space-y-2">
            <Label htmlFor="persona_name" className="text-sm font-medium">
              Persona Name *
            </Label>
            <Input
              id="persona_name"
              value={formData.persona_name}
              onChange={(e) => handleInputChange('persona_name', e.target.value)}
              placeholder="e.g., SaaS Companies in Texas"
              required
            />
          </div>

          {/* Target Industry */}
          <div className="space-y-2">
            <Label htmlFor="target_industry" className="text-sm font-medium">
              Target Industry *
            </Label>
            <Select value={formData.target_industry} onValueChange={(value) => handleInputChange('target_industry', value)}>
              <SelectTrigger>
                <SelectValue placeholder="Select an industry" />
              </SelectTrigger>
              <SelectContent>
                {INDUSTRY_SUGGESTIONS.map((industry) => (
                  <SelectItem key={industry} value={industry}>
                    {industry}
                  </SelectItem>
                ))}
              </SelectContent>
            </Select>
          </div>

          {/* Target Location */}
          <div className="space-y-2">
            <Label htmlFor="target_location" className="text-sm font-medium">
              Target Location *
            </Label>
            <Input
              id="target_location"
              value={formData.target_location}
              onChange={(e) => handleInputChange('target_location', e.target.value)}
              placeholder="e.g., Austin, TX or 78701"
              required
            />
          </div>

          {/* Keywords */}
          <div className="space-y-2">
            <Label htmlFor="keywords" className="text-sm font-medium">
              Keywords *
            </Label>
            <Textarea
              id="keywords"
              value={formData.keywords}
              onChange={(e) => handleInputChange('keywords', e.target.value)}
              placeholder="e.g., Family owned, 24-hour service, Cloud solutions (separate with commas)"
              rows={3}
              required
            />
            <p className="text-sm text-muted-foreground">
              Separate keywords with commas
            </p>
          </div>

          {/* Company Size Range */}
          <div className="space-y-2">
            <Label className="text-sm font-medium">Company Size Range *</Label>
            <div className="grid grid-cols-2 gap-4">
              <div className="space-y-2">
                <Label htmlFor="company_size_min" className="text-xs text-muted-foreground">
                  Min Employees
                </Label>
                <Input
                  type="number"
                  id="company_size_min"
                  value={formData.company_size_min}
                  onChange={(e) => handleInputChange('company_size_min', parseInt(e.target.value || '1', 10))}
                  min="1"
                  required
                />
              </div>
              <div className="space-y-2">
                <Label htmlFor="company_size_max" className="text-xs text-muted-foreground">
                  Max Employees
                </Label>
                <Input
                  type="number"
                  id="company_size_max"
                  value={formData.company_size_max}
                  onChange={(e) => handleInputChange('company_size_max', parseInt(e.target.value || '10', 10))}
                  min="1"
                  required
                />
              </div>
            </div>
          </div>

          {/* Submit Button */}
          <Button type="submit" disabled={isSubmitting} className="w-full" size="lg">
            {isSubmitting ? 'Saving...' : 'Save Persona'}
          </Button>
        </form>
      </CardContent>
    </Card>
  )
}
