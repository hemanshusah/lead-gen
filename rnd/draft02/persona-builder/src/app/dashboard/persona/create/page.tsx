import DashboardLayout from '@/components/DashboardLayout'
import PersonaForm from '@/components/PersonaForm'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'

export default function CreatePersona() {
  return (
    <DashboardLayout>
      <div className="max-w-4xl mx-auto">
        <div className="mb-8">
          <h1 className="text-3xl font-bold">Create Customer Persona</h1>
          <p className="text-muted-foreground mt-2">
            Define your ideal customer profile. This persona will be used to generate targeted leads and score potential customers.
          </p>
        </div>

        <PersonaForm />

        {/* Help Section */}
        <Card className="mt-8">
          <CardHeader>
            <CardTitle className="flex items-center gap-2">
              💡 Tips for Creating Effective Personas
            </CardTitle>
          </CardHeader>
          <CardContent>
            <ul className="text-sm space-y-2">
              <li>• <strong>Be specific:</strong> Instead of &quot;tech companies,&quot; try &quot;SaaS companies with 10-50 employees&quot;</li>
              <li>• <strong>Use relevant keywords:</strong> Include terms your target customers would use to describe themselves</li>
              <li>• <strong>Consider location:</strong> Target specific cities, states, or zip codes where your ideal customers are located</li>
              <li>• <strong>Think about company size:</strong> Smaller companies have different needs than larger enterprises</li>
            </ul>
          </CardContent>
        </Card>
      </div>
    </DashboardLayout>
  )
}
