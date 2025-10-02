# Admin Panel

A modern, responsive admin panel built with React, Vite, TypeScript, and Chakra UI.

## 🚀 Features

- **Modern Stack**: React 19, Vite, TypeScript, Chakra UI
- **State Management**: Redux Toolkit for predictable state management
- **Routing**: React Router with protected routes
- **UI Components**: Beautiful, accessible components with Chakra UI
- **Dark Mode**: Built-in theme switching
- **Responsive Design**: Mobile-first responsive design
- **Testing**: Vitest for unit testing
- **Type Safety**: Full TypeScript support

## 🛠️ Tech Stack

- **Frontend**: React 19, TypeScript
- **Build Tool**: Vite
- **UI Library**: Chakra UI
- **State Management**: Redux Toolkit
- **Routing**: React Router DOM
- **Testing**: Vitest, React Testing Library
- **Icons**: React Icons
- **Charts**: Recharts (ready for implementation)

## 📦 Installation

1. **Install dependencies**:
   ```bash
   npm install
   # or
   yarn install
   ```

2. **Start development server**:
   ```bash
   npm run dev
   # or
   yarn dev
   ```

3. **Open your browser** and navigate to `http://localhost:3000`

## 🔐 Demo Login

Use these credentials to access the admin panel:

- **Email**: `admin@example.com`
- **Password**: `password`

## 📁 Project Structure

```
src/
├── components/          # Reusable UI components
│   ├── Header.tsx      # Top navigation header
│   ├── Sidebar.tsx     # Side navigation
│   ├── Layout.tsx      # Main layout wrapper
│   └── ProtectedRoute.tsx # Route protection
├── pages/              # Page components
│   ├── Login.tsx       # Login page
│   └── Dashboard.tsx   # Main dashboard
├── store/              # Redux store configuration
│   ├── index.ts        # Store setup
│   ├── hooks.ts        # Typed Redux hooks
│   └── slices/         # Redux slices
├── theme.ts            # Chakra UI theme configuration
├── main.tsx            # Application entry point
└── App.tsx             # Main app component
```

## 🎨 Theme Customization

The app uses a custom Chakra UI theme with:

- **Brand Colors**: Blue-based color palette
- **Typography**: Inter font family
- **Components**: Customized Button, Input, and Select components
- **Dark Mode**: System preference detection

## 🧪 Testing

Run tests with:

```bash
npm run test
# or
yarn test
```

Run tests with UI:

```bash
npm run test:ui
# or
yarn test:ui
```

## 🏗️ Building for Production

```bash
npm run build
# or
yarn build
```

Preview production build:

```bash
npm run preview
# or
yarn preview
```

## 📝 Available Scripts

- `dev` - Start development server
- `build` - Build for production
- `preview` - Preview production build
- `test` - Run tests
- `test:ui` - Run tests with UI
- `test:coverage` - Run tests with coverage
- `lint` - Run ESLint

## 🔧 Configuration

### Environment Variables
Create a `.env` file in the root directory to configure API settings:

```bash
# API Configuration
VITE_API_URL=http://localhost:8000/api
```

- **Development**: Uses mock API if `VITE_API_URL` is not set
- **Production**: Uses real API when `VITE_API_URL` is configured

### Vite Configuration
- React plugin enabled
- TypeScript support
- Testing with Vitest
- Development server on port 3000

### TypeScript Configuration
- Strict mode enabled
- React JSX transform
- Modern ES2020 target
- Path mapping support

## 🚀 Deployment

The app is ready for deployment to any static hosting service:

1. Build the project: `npm run build`
2. Deploy the `dist` folder to your hosting service

### Recommended Platforms
- Vercel
- Netlify
- GitHub Pages
- AWS S3 + CloudFront

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

If you encounter any issues or have questions, please:

1. Check the existing issues
2. Create a new issue with detailed information
3. Provide steps to reproduce any bugs

---

Built with ❤️ using React, Vite, and Chakra UI
