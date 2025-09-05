# Atomic Design Components

This directory follows the Atomic Design methodology, organizing components into a clear hierarchy from smallest to largest building blocks.

## Structure

```
components/
├── atoms/              # Smallest building blocks
│   ├── Button/         # Button component with variants
│   ├── Input/          # Input component with validation
│   └── Typography/     # Text component with variants
│
├── molecules/          # Groups of atoms
│   ├── SearchBar/      # Search input with button
│   ├── Card/           # Card container with header/actions
│   └── NavItem/        # Navigation item with icon
│
├── organisms/          # Complex sections
│   ├── Navbar/         # Main navigation bar
│   ├── Hero/           # Hero section with CTA
│   └── Footer/         # Site footer
│
├── templates/          # Page layouts
│   ├── MainLayout.tsx  # Basic page layout
│   └── DashboardLayout.tsx # Dashboard with sidebar
│
└── pages/              # Complete pages
    ├── HomePage.tsx    # Landing page
    ├── AboutPage.tsx   # About page
    └── ContactPage.tsx # Contact page
```

## Usage

### Importing Components

```typescript
// Import individual components
import { Button } from './components/atoms/Button/Button';
import { Card } from './components/molecules/Card/Card';

// Or import from the main index
import { Button, Card, Navbar } from './components';
```

### Component Examples

#### Atoms
```typescript
// Button with different variants
<Button variant="primary" size="lg" onClick={handleClick}>
  Click me
</Button>

// Input with validation
<Input
  label="Email"
  type="email"
  value={email}
  onChange={handleChange}
  error={emailError}
  required
/>

// Typography with variants
<Text variant="h1" color="primary" weight="bold">
  Main Heading
</Text>
```

#### Molecules
```typescript
// Search bar with callback
<SearchBar
  placeholder="Search users..."
  onSearch={handleSearch}
  onClear={handleClear}
/>

// Card with title and actions
<Card
  title="User Profile"
  subtitle="Manage user information"
  actions={<Button>Edit</Button>}
>
  <p>Card content here</p>
</Card>
```

#### Organisms
```typescript
// Navigation bar
<Navbar
  logo={<img src="/logo.png" alt="Logo" />}
  navItems={[
    { label: 'Dashboard', href: '/dashboard', active: true },
    { label: 'Users', href: '/users' },
  ]}
  onSearch={handleSearch}
  userMenu={<UserDropdown />}
/>
```

#### Templates
```typescript
// Main layout
<MainLayout
  navbarProps={{ navItems, onSearch }}
  footerProps={{ links, socialLinks }}
>
  <YourPageContent />
</MainLayout>

// Dashboard layout
<DashboardLayout
  sidebarItems={sidebarItems}
  navbarProps={{ userMenu }}
>
  <DashboardContent />
</DashboardLayout>
```

## Design Principles

1. **Single Responsibility**: Each component has one clear purpose
2. **Reusability**: Components are designed to be reused across the application
3. **Composability**: Components can be combined to create more complex UI
4. **Consistency**: All components follow the same design patterns
5. **Accessibility**: Components include proper ARIA attributes and keyboard navigation

## Styling

Components use Tailwind CSS classes for styling. The design system includes:

- **Colors**: Primary, secondary, muted, error, success, warning
- **Sizes**: Small, medium, large variants
- **Spacing**: Consistent padding and margins
- **Typography**: Heading and body text variants
- **States**: Hover, focus, active, disabled states

## Testing

Each component includes comprehensive tests covering:

- Rendering with different props
- User interactions
- Accessibility features
- Edge cases and error states

Run tests with:
```bash
npm test
```

## Contributing

When adding new components:

1. Follow the atomic design hierarchy
2. Include TypeScript interfaces for all props
3. Add comprehensive tests
4. Update this README if needed
5. Ensure accessibility compliance
