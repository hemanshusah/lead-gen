import DashboardLayout from '@/components/DashboardLayout'

export default function SettingsPage() {
  return (
    <DashboardLayout>
      <div className="max-w-4xl mx-auto">
        <div className="mb-8">
          <h1 className="text-3xl font-bold text-gray-900">Settings</h1>
          <p className="text-gray-600 mt-2">
            Manage your account settings and preferences.
          </p>
        </div>

        <div className="bg-white rounded-lg shadow p-8 text-center">
          <div className="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-4">
            <span className="text-gray-600 text-2xl">⚙️</span>
          </div>
          <h2 className="text-xl font-semibold text-gray-900 mb-2">Settings</h2>
          <p className="text-gray-600 mb-6">
            Account settings and configuration options will be available here.
          </p>
          <div className="text-sm text-gray-500">
            <p>Future settings:</p>
            <ul className="mt-2 space-y-1">
              <li>• API keys and integrations</li>
              <li>• Notification preferences</li>
              <li>• Export settings</li>
              <li>• Account management</li>
            </ul>
          </div>
        </div>
      </div>
    </DashboardLayout>
  )
}
