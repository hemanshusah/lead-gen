# 🚀 Quick Setup Guide

## Your User Persona Builder is Ready!

The application is now running at: **http://localhost:3000**

## 📋 What You Need to Do Next:

### 1. Set Up Supabase (Required)
1. Go to [supabase.com](https://supabase.com) and create a free account
2. Create a new project
3. Go to SQL Editor and run this SQL:

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
```

### 2. Get Your Supabase Credentials
1. Go to your Supabase project dashboard
2. Click on "Settings" → "API"
3. Copy your "Project URL" and "anon public" key

### 3. Create Environment File
Create a file called `.env.local` in the root directory with:

```env
NEXT_PUBLIC_SUPABASE_URL=your_project_url_here
NEXT_PUBLIC_SUPABASE_ANON_KEY=your_anon_key_here
```

### 4. Restart the Server
Press `Ctrl+C` to stop the server, then run `npm run dev` again

## 🎯 What You Can Do Now:

✅ **Dashboard**: View your main dashboard at `/dashboard`
✅ **Create Personas**: Go to `/dashboard/persona/create`
✅ **Manage Personas**: View all personas at `/dashboard/personas`
✅ **Navigation**: Use the sidebar to navigate between sections

## 🔧 If You Get Errors:

- Make sure Supabase is set up correctly
- Check that your `.env.local` file exists
- Ensure the database table was created
- Restart the development server after adding environment variables

## 📱 Test the Application:

1. Open http://localhost:3000
2. You'll be redirected to the dashboard
3. Click "Create Your First Persona"
4. Fill out the form and test saving a persona
5. View your created personas in the "My Personas" section

## 🎉 You're All Set!

Your User Persona Builder is now complete and ready for:
- Creating customer personas
- Managing multiple personas
- Setting up targeting criteria
- Preparing for lead generation features

The system is designed to be the foundation for your lead generation platform!
