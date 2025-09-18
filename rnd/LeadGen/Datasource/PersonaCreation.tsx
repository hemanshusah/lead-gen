import React from 'react'
import { Button } from './ui/button'
import { Badge } from './ui/badge'

type Option = {
	value: string
	label: string
	description?: string
}

type PersonaCreationProps = {
	title?: string
	options?: Option[]
	selected?: string
	onSelect?: (value: string) => void
	onStart?: (values: string[]) => void
}

const defaultOptions: Option[] = [
	{ value: 'gmap', label: 'Google Map Scrapper', description: 'Start scrapping with Google Map scrapper.' },
	{ value: 'linkedin', label: 'LinkedIn Scrapper', description: 'Start scrapping with LinkedIn scrapper.' }
]

export default function PersonaCreation(props: PersonaCreationProps) {
	const { title = 'Select Datasource', options = defaultOptions, onStart } = props
	const [expanded, setExpanded] = React.useState<string | null>(null)
	const [selected, setSelected] = React.useState<Set<string>>(new Set())

	function toggleExpand(v: string) {
		setExpanded(prev => (prev === v ? null : v))
	}

	function toggleSelect(v: string) {
		setSelected(prev => {
			const next = new Set(prev)
			next.has(v) ? next.delete(v) : next.add(v)
			return next
		})
	}

	function handleStart() {
		onStart?.(Array.from(selected))
	}

	return (
		<div className="rounded-2xl border border-neutral-800 bg-neutral-900 text-neutral-50 p-6">
			<h2 className="text-lg font-semibold mb-4">{title}</h2>

			<div className="space-y-3">
				{options.map(opt => {
					const isChecked = selected.has(opt.value)
					const isOpen = expanded === opt.value
					return (
						<div key={opt.value} className={`rounded-2xl ${isChecked ? 'ring-1 ring-neutral-700 bg-amber-100/50' : 'bg-amber-100/40'} text-neutral-900 transition-all`}>
							<button className="h-12 w-full px-4 flex items-center justify-between" onClick={() => toggleSelect(opt.value)}>
								<span className="text-sm font-medium flex items-center gap-2">
									{opt.label}
									{isChecked && <Badge variant="default">Selected</Badge>}
								</span>
								<span onClick={(e) => { e.stopPropagation(); toggleExpand(opt.value); }} className="inline-flex items-center justify-center">
									<ChevronDown />
								</span>
							</button>
							{isOpen && (
								<div className="px-4 pb-4 text-neutral-800">
									{opt.description && (
										<p className="text-xs leading-relaxed">{opt.description}</p>
									)}
								</div>
							)}
						</div>
					)
				})}
			</div>

			<div className="mt-8 flex justify-end">
				<Button variant="outline" size="sm" onClick={handleStart}>Start Scrapping</Button>
			</div>
		</div>
	)
}

function ChevronDown() {
	return (
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M6 9l6 6 6-6" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
		</svg>
	)
}


