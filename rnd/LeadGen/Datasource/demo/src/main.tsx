import React, { useEffect, useSyncExternalStore } from 'react'
import { createRoot } from 'react-dom/client'
import { GenerateLead } from '../../GenerateLead'
import PersonaCreation from '../../PersonaCreation'
import './index.css'

function useHash() {
	const subscribe = (cb: () => void) => {
		window.addEventListener('hashchange', cb)
		return () => window.removeEventListener('hashchange', cb)
	}
	const getSnapshot = () => window.location.hash
	return useSyncExternalStore(subscribe, getSnapshot, getSnapshot)
}

function App() {
	const hash = useHash()
	useEffect(() => { if (!hash) window.location.hash = '#/' }, [])
	return (
		<div className="p-6">
			{hash === '#/persona' ? (
				<PersonaCreation />
			) : (
				<GenerateLead />
			)}
		</div>
	)
}

const root = createRoot(document.getElementById('root') as HTMLElement)
root.render(
	<React.StrictMode>
		<App />
	</React.StrictMode>
)


