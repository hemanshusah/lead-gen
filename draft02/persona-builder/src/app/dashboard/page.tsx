import DashboardLayout from '@/components/DashboardLayout'
import { Card, CardContent } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import Link from 'next/link'

export default function Dashboard() {
  return (
    <DashboardLayout>
      <div className="max-w-7xl mx-auto">
        <div className="mb-8">
          <h1 className="text-3xl font-bold">Dashboard</h1>
          <p className="text-muted-foreground mt-2">
            Welcome to your Lead Generation Platform. Start by creating your first customer persona.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {/* Quick Stats */}
          <Card>
            <CardContent className="p-6">
              <div className="flex items-center">
                <div className="flex-shrink-0">
                  <div className="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span className="text-blue-600 text-lg">👤</span>
                  </div>
                </div>
                <div className="ml-4">
                  <p className="text-sm font-medium text-muted-foreground">Total Personas</p>
                  <p className="text-2xl font-semibold">0</p>
                </div>
              </div>
            </CardContent>
          </Card>

          <Card>
            <CardContent className="p-6">
              <div className="flex items-center">
                <div className="flex-shrink-0">
                  <div className="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <span className="text-green-600 text-lg">🎯</span>
                  </div>
                </div>
                <div className="ml-4">
                  <p className="text-sm font-medium text-muted-foreground">Leads Generated</p>
                  <p className="text-2xl font-semibold">0</p>
                </div>
              </div>
            </CardContent>
          </Card>

          <Card>
            <CardContent className="p-6">
              <div className="flex items-center">
                <div className="flex-shrink-0">
                  <div className="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span className="text-purple-600 text-lg">📊</span>
                  </div>
                </div>
                <div className="ml-4">
                  <p className="text-sm font-medium text-muted-foreground">Success Rate</p>
                  <p className="text-2xl font-semibold">0%</p>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>

        {/* Quick Actions */}
        <div className="mt-8">
          <h2 className="text-xl font-semibold mb-4">Quick Actions</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <Card className="border-2 border-dashed hover:border-primary/50 transition-colors">
              <CardContent className="p-6 text-center">
                <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                  <span className="text-blue-600 text-2xl">👤</span>
                </div>
                <h3 className="text-lg font-medium mb-2">Create Your First Persona</h3>
                <p className="text-muted-foreground mb-4">
                  Define your ideal customer profile to start generating targeted leads.
                </p>
                <Button asChild>
                  <Link href="/dashboard/persona/create">
                    Create Persona
                  </Link>
                </Button>
              </CardContent>
            </Card>

            <Card className="border-2 border-dashed hover:border-primary/50 transition-colors">
              <CardContent className="p-6 text-center">
                <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                  <span className="text-green-600 text-2xl">🎯</span>
                </div>
                <h3 className="text-lg font-medium mb-2">Start Lead Generation</h3>
                <p className="text-muted-foreground mb-4">
                  Begin scraping and scoring leads based on your personas.
                </p>
                <Button asChild variant="outline">
                  <Link href="/dashboard/leads">
                    Generate Leads
                  </Link>
                </Button>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </DashboardLayout>
  )
}
