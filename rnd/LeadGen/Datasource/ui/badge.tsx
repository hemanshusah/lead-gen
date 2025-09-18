import * as React from 'react'

type BadgeProps = React.HTMLAttributes<HTMLSpanElement> & {
	variant?: 'default' | 'success' | 'info' | 'warning' | 'destructive'
}

const base = 'inline-flex items-center rounded-full border px-2 py-0.5 text-xs'

const variants: Record<string, string> = {
	default: 'bg-neutral-800 border-neutral-700 text-neutral-200',
	success: 'bg-emerald-950/60 border-emerald-800 text-emerald-200',
	info: 'bg-sky-950/60 border-sky-800 text-sky-200',
	warning: 'bg-amber-950/60 border-amber-800 text-amber-200',
	destructive: 'bg-rose-950/60 border-rose-800 text-rose-200'
}

export const Badge = React.forwardRef<HTMLSpanElement, BadgeProps>(({ className = '', variant = 'default', ...props }, ref) => (
	<span ref={ref} className={`${base} ${variants[variant]} ${className}`} {...props} />
))

Badge.displayName = 'Badge'

export default Badge


