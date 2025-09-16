# Lead Generation Platform - User Persona Builder

A comprehensive Next.js application for creating and managing customer personas for lead generation. This is the first step in our lead generation system where users define their ideal customer profiles.

## 🎯 Features

### ✅ Completed Features
- **Dashboard Interface**: Clean, professional dashboard with navigation
- **Persona Creation**: Comprehensive form with all required fields
- **Persona Management**: View, manage, and delete personas
- **Form Validation**: Client and server-side validation
- **Success Feedback**: Confirmation messages and error handling
- **Responsive Design**: Works on all devices
- **Supabase Integration**: Secure database storage

### 🔄 In Development
- **Lead Generation**: Web scraping and lead scoring
- **User Authentication**: Login and user management
- **Advanced Analytics**: Persona performance metrics
- **Export Features**: CSV/Excel export capabilities

## 🚀 Quick Start

### 1. Install Dependencies

```bash
cd draft02/persona-builder
npm install
```

### 2. Set Up Supabase

1. **Create a Supabase Project**
   - Go to [supabase.com](https://supabase.com)
   - Create a new project
   - Note your project URL and anon key

2. **Create the Database Table**
   - Go to your Supabase SQL Editor
   - Run this SQL to create the `user_personas` table:

```sql
CREATE TABLE user_personas (
  id UUID DEFAULT gen_random_uuid() PRIMARY KEY,
  persona_name TEXT NOT NULL,
  target_industry TEXT NOT NULL,
  target_location TEXT NOT NULL,
  keywords TEXT[] NOT NULL,
  company_size_min INTEGER NOT NULL,
  company_size_max INTEGER NOT NULL,
  created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
  updated_at TIMESTAMP WITH TIME ZONE DEFAULT NOW()
);

-- Enable Row Level Security (optional but recommended)
ALTER TABLE user_personas ENABLE ROW LEVEL SECURITY;

-- Create a policy that allows all operations (for demo purposes)
CREATE POLICY "Allow all operations" ON user_personas FOR ALL USING (true);
```

3. **Configure Environment Variables**
   - Create a `.env.local` file in the root directory:

```env
NEXT_PUBLIC_SUPABASE_URL=your_supabase_project_url
NEXT_PUBLIC_SUPABASE_ANON_KEY=your_supabase_anon_key
```

### 3. Run the Development Server

```bash
npm run dev
```

Open [http://localhost:3000](http://localhost:3000) to view the application.

## 📋 User Journey

1. **Dashboard**: Users land on the main dashboard with quick stats and actions
2. **Create Persona**: Navigate to `/dashboard/persona/create` to define customer personas
3. **Manage Personas**: View all personas at `/dashboard/personas`
4. **Lead Generation**: (Coming soon) Use personas to generate targeted leads

## 🎨 Form Fields

### Required Fields:
1. **Persona Name**: Text field (e.g., "SaaS Companies in Texas")
2. **Target Industry**: Dropdown with suggestions (e.g., "Dentistry," "IT Consulting," "Real Estate")
3. **Target Location**: Text field for city, state, or zip code
4. **Keywords**: Text area for specific keywords (separated by commas)
5. **Company Size**: Two number inputs for min and max employee count

### Industry Suggestions:
- Dentistry
- IT Consulting
- Real Estate
- Healthcare
- Finance
- Education
- Manufacturing
- Retail
- Technology
- Legal Services
- Marketing
- Construction
- Hospitality
- Transportation
- Other

## 🔌 API Endpoints

### POST /api/personas
Creates a new user persona.

**Request Body:**
```json
{
  "persona_name": "SaaS Companies in Texas",
  "target_industry": "Technology",
  "target_location": "Austin, TX",
  "keywords": "Family owned, 24-hour service, Cloud solutions",
  "company_size_min": 1,
  "company_size_max": 50
}
```

**Response:**
```json
{
  "message": "Persona 'SaaS Companies in Texas' created successfully!",
  "data": {
    "id": "uuid",
    "persona_name": "SaaS Companies in Texas",
    "target_industry": "Technology",
    "target_location": "Austin, TX",
    "keywords": ["Family owned", "24-hour service", "Cloud solutions"],
    "company_size_min": 1,
    "company_size_max": 50,
    "created_at": "2024-01-01T00:00:00Z",
    "updated_at": "2024-01-01T00:00:00Z"
  }
}
```

### GET /api/personas
Fetches all personas.

**Response:**
```json
{
  "personas": [
    {
      "id": "uuid",
      "persona_name": "SaaS Companies in Texas",
      "target_industry": "Technology",
      "target_location": "Austin, TX",
      "keywords": ["Family owned", "24-hour service", "Cloud solutions"],
      "company_size_min": 1,
      "company_size_max": 50,
      "created_at": "2024-01-01T00:00:00Z",
      "updated_at": "2024-01-01T00:00:00Z"
    }
  ]
}
```

### DELETE /api/personas/[id]
Deletes a specific persona.

**Response:**
```json
{
  "message": "Persona deleted successfully"
}
```

## 🏗️ Project Structure

```
src/
├── app/
│   ├── api/
│   │   └── personas/
│   │       ├── route.ts              # POST/GET personas
│   │       └── [id]/
│   │           └── route.ts          # DELETE persona
│   ├── dashboard/
│   │   ├── page.tsx                  # Main dashboard
│   │   ├── persona/
│   │   │   └── create/
│   │   │       └── page.tsx          # Create persona page
│   │   ├── personas/
│   │   │   └── page.tsx              # List all personas
│   │   ├── leads/
│   │   │   └── page.tsx              # Lead generation (coming soon)
│   │   └── settings/
│   │       └── page.tsx              # Settings page
│   ├── page.tsx                      # Redirect to dashboard
│   └── layout.tsx                    # Root layout
├── components/
│   ├── DashboardLayout.tsx           # Dashboard layout with navigation
│   └── PersonaForm.tsx               # Main persona creation form
├── lib/
│   └── supabase.ts                   # Supabase client configuration
└── types/
    └── persona.ts                    # TypeScript interfaces
```

## 🛠️ Technologies Used

- **Next.js 15** - React framework with App Router
- **TypeScript** - Type safety and better development experience
- **Tailwind CSS** - Utility-first CSS framework
- **Supabase** - Backend-as-a-Service for database and API
- **React Hooks** - State management and side effects

## 🎯 Next Steps

This User Persona Builder is the foundation for the lead generation system. The next phases will include:

1. **Lead Generation Engine**: Web scraping based on persona criteria
2. **Lead Scoring System**: AI-powered lead ranking and scoring
3. **Contact Information Extraction**: Automated contact data collection
4. **Export & Integration**: CSV/Excel export and CRM integrations
5. **Analytics Dashboard**: Performance metrics and insights
6. **User Authentication**: Multi-user support with roles and permissions

## 🔧 Development

### Available Scripts

```bash
npm run dev          # Start development server
npm run build        # Build for production
npm run start        # Start production server
npm run lint         # Run ESLint
```

### Environment Variables

Make sure to set up your `.env.local` file with:
- `NEXT_PUBLIC_SUPABASE_URL`
- `NEXT_PUBLIC_SUPABASE_ANON_KEY`

## 📝 License

This project is part of the Lead Generation Platform.
