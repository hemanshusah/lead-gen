'use client'

import { useState, useEffect } from 'react'
import DashboardLayout from '@/components/DashboardLayout'
import { UserPersona } from '@/types/persona'
import Link from 'next/link'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Alert, AlertDescription } from '@/components/ui/alert'
import { AlertCircle, User, Plus } from 'lucide-react'

export default function PersonasList() {
  const [personas, setPersonas] = useState<UserPersona[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    fetchPersonas()
  }, [])

  const fetchPersonas = async () => {
    try {
      const response = await fetch('/api/personas')
      if (response.ok) {
        const data = await response.json()
        setPersonas(data.personas || [])
      } else {
        setError('Failed to load personas')
      }
    } catch {
      setError('Failed to load personas')
    } finally {
      setLoading(false)
    }
  }

  const deletePersona = async (id: string) => {
    if (!confirm('Are you sure you want to delete this persona?')) return

    try {
      const response = await fetch(`/api/personas/${id}`, {
        method: 'DELETE',
      })

      if (response.ok) {
        setPersonas(personas.filter(p => p.id !== id))
      } else {
        alert('Failed to delete persona')
      }
    } catch {
      alert('Failed to delete persona')
    }
  }

  if (loading) {
    return (
      <DashboardLayout>
        <div className="flex items-center justify-center h-64">
          <div className="text-muted-foreground">Loading personas...</div>
        </div>
      </DashboardLayout>
    )
  }

  return (
    <DashboardLayout>
      <div className="max-w-7xl mx-auto">
        <div className="mb-8 flex justify-between items-center">
          <div>
            <h1 className="text-3xl font-bold">My Personas</h1>
            <p className="text-muted-foreground mt-2">
              Manage your customer personas and their targeting criteria.
            </p>
          </div>
          <Button asChild>
            <Link href="/dashboard/persona/create">
              <Plus className="mr-2 h-4 w-4" />
              Create New Persona
            </Link>
          </Button>
        </div>

        {error && (
          <Alert className="mb-6">
            <AlertCircle className="h-4 w-4" />
            <AlertDescription>{error}</AlertDescription>
          </Alert>
        )}

        {personas.length === 0 ? (
          <Card className="text-center py-12">
            <CardContent>
              <div className="w-16 h-16 bg-muted rounded-lg flex items-center justify-center mx-auto mb-4">
                <User className="h-8 w-8 text-muted-foreground" />
              </div>
              <h3 className="text-lg font-medium mb-2">No personas yet</h3>
              <p className="text-muted-foreground mb-6">
                Create your first customer persona to start generating targeted leads.
              </p>
              <Button asChild>
                <Link href="/dashboard/persona/create">
                  Create Your First Persona
                </Link>
              </Button>
            </CardContent>
          </Card>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {personas.map((persona) => (
              <Card key={persona.id}>
                <CardHeader>
                  <div className="flex justify-between items-start">
                    <CardTitle className="text-lg">{persona.persona_name}</CardTitle>
                    <Button
                      variant="ghost"
                      size="sm"
                      onClick={() => deletePersona(persona.id!)}
                      className="text-destructive hover:text-destructive"
                    >
                      Delete
                    </Button>
                  </div>
                </CardHeader>
                
                <CardContent className="space-y-3">
                  <div>
                    <span className="text-sm font-medium text-muted-foreground">Industry:</span>
                    <span className="text-sm ml-2">{persona.target_industry}</span>
                  </div>
                  
                  <div>
                    <span className="text-sm font-medium text-muted-foreground">Location:</span>
                    <span className="text-sm ml-2">{persona.target_location}</span>
                  </div>
                  
                  <div>
                    <span className="text-sm font-medium text-muted-foreground">Company Size:</span>
                    <span className="text-sm ml-2">
                      {persona.company_size_min}-{persona.company_size_max} employees
                    </span>
                  </div>
                  
                  <div>
                    <span className="text-sm font-medium text-muted-foreground">Keywords:</span>
                    <div className="mt-1 flex flex-wrap gap-1">
                      {persona.keywords.map((keyword, index) => (
                        <Badge key={index} variant="secondary" className="text-xs">
                          {keyword}
                        </Badge>
                      ))}
                    </div>
                  </div>
                </CardContent>
                
                <div className="px-6 pb-4 pt-0">
                  <div className="flex justify-between items-center text-xs text-muted-foreground">
                    <span>Created: {new Date(persona.created_at!).toLocaleDateString()}</span>
                    <Button variant="ghost" size="sm">
                      Use for Lead Generation
                    </Button>
                  </div>
                </div>
              </Card>
            ))}
          </div>
        )}
      </div>
    </DashboardLayout>
  )
}
