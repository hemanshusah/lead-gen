import './style.css'
import { HomePage } from './components/pages/HomePage'

// Mount the HomePage component
const app = document.querySelector<HTMLDivElement>('#app')!
app.innerHTML = ''

// For now, we'll render the HomePage directly
// In a real React app, you would use ReactDOM.render or createRoot
const homePageElement = document.createElement('div')
homePageElement.innerHTML = `
  <div class="min-h-screen bg-gray-50">
    <nav class="bg-white shadow-sm border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex-shrink-0">
            <div class="text-xl font-bold text-gray-900">Admin Panel</div>
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="#" class="bg-blue-100 text-blue-700 px-3 py-2 rounded-md text-sm font-medium">Home</a>
              <a href="#" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Features</a>
              <a href="#" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Pricing</a>
              <a href="#" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
    
    <main>
      <section class="relative bg-gray-50 py-20">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
              Welcome to Admin Panel
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8">
              Manage your application with our comprehensive admin panel. Built with modern technologies and designed for efficiency.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
              <button class="bg-blue-600 text-white px-8 py-3 rounded-md font-medium hover:bg-blue-700 transition-colors">
                Get Started
              </button>
              <button class="border border-gray-300 bg-white text-gray-700 px-8 py-3 rounded-md font-medium hover:bg-gray-50 transition-colors">
                Learn More
              </button>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
`

app.appendChild(homePageElement)
