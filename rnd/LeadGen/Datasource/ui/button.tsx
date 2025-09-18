import * as React from 'react'

type ButtonProps = React.ButtonHTMLAttributes<HTMLButtonElement> & {
	variant?: 'default' | 'outline' | 'destructive' | 'ghost'
	size?: 'sm' | 'md' | 'icon'
}

const base = 'inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-neutral-400 disabled:pointer-events-none disabled:opacity-50'

const variants: Record<string, string> = {
	default: 'bg-neutral-800 text-neutral-100 hover:bg-neutral-700 border border-neutral-700',
	outline: 'bg-transparent text-neutral-100 border border-neutral-700 hover:border-neutral-500',
	destructive: 'bg-rose-900/40 text-rose-200 border border-rose-800 hover:bg-rose-900/60',
	ghost: 'bg-transparent hover:bg-neutral-800/50 text-neutral-100 border border-transparent'
}

const sizes: Record<string, string> = {
	sm: 'h-8 px-3',
	md: 'h-9 px-4',
	icon: 'h-7 w-7 p-0'
}

export const Button = React.forwardRef<HTMLButtonElement, ButtonProps>(
	({ className = '', variant = 'default', size = 'md', ...props }, ref) => (
		<button ref={ref} className={`${base} ${variants[variant]} ${sizes[size]} ${className}`} {...props} />
	)
)

Button.displayName = 'Button'

export default Button


