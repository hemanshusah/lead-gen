import DashboardLayout from '@/components/DashboardLayout'

export default function LeadsPage() {
  return (
    <DashboardLayout>
      <div className="max-w-7xl mx-auto">
        <div className="mb-8">
          <h1 className="text-3xl font-bold text-gray-900">Lead Generation</h1>
          <p className="text-gray-600 mt-2">
            Generate and manage leads based on your customer personas.
          </p>
        </div>

        <div className="bg-white rounded-lg shadow p-8 text-center">
          <div className="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-4">
            <span className="text-yellow-600 text-2xl">🚧</span>
          </div>
          <h2 className="text-xl font-semibold text-gray-900 mb-2">Coming Soon</h2>
          <p className="text-gray-600 mb-6">
            The lead generation feature is currently under development. This will allow you to scrape and score leads based on your personas.
          </p>
          <div className="text-sm text-gray-500">
            <p>Features in development:</p>
            <ul className="mt-2 space-y-1">
              <li>• Web scraping based on persona criteria</li>
              <li>• Lead scoring and ranking</li>
              <li>• Contact information extraction</li>
              <li>• Export and integration capabilities</li>
            </ul>
          </div>
        </div>
      </div>
    </DashboardLayout>
  )
}
