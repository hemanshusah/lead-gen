import * as React from 'react'

export type TableColumn = {
	/** Unique column id used for rendering cells */
	id: string
	/** Header label or node */
	header: React.ReactNode
	/** CSS width used to build gridTemplateColumns (e.g., '1fr', '112px') */
	width?: string
}

export type TableProps<T> = {
	columns: TableColumn[]
	rows: T[]
	/** Return a stable key for each row */
	getRowKey: (row: T, index: number) => string
	/** Render a cell for the given column id */
	renderCell: (args: { columnId: string; row: T; rowIndex: number }) => React.ReactNode
	className?: string
}

export function Table<T>(props: TableProps<T>) {
	const { columns, rows, getRowKey, renderCell, className = '' } = props

	const gridTemplateColumns = React.useMemo(() => {
		return columns.map(c => c.width ?? '1fr').join(' ')
	}, [columns])

	return (
		<div className={`overflow-hidden rounded-xl border border-neutral-800 bg-neutral-950 ${className}`}>
			<div
				className="grid items-center bg-neutral-900/70 text-neutral-200 text-sm font-medium"
				style={{ gridTemplateColumns }}
			>
				{columns.map(col => (
					<div key={col.id} className="px-4 py-3">{col.header}</div>
				))}
			</div>

			{rows.map((row, rowIndex) => (
				<div
					key={getRowKey(row, rowIndex)}
					className="grid items-center text-sm border-t border-neutral-900/80"
					style={{ gridTemplateColumns }}
				>
					{columns.map(col => (
						<div key={col.id} className="px-4 py-3">
							{renderCell({ columnId: col.id, row, rowIndex })}
						</div>
					))}
				</div>
			))}
		</div>
	)
}

export default Table


