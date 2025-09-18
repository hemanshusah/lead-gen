import React from 'react';
import { Button } from './ui/button';
import { Badge } from './ui/badge';
import { Table, type TableColumn } from './ui/table';

export type LeadJob = {
	id: string;
	source: 'Google Map' | 'LinkedIn' | 'X' | 'Custom';
	status: 'Running' | 'Validating' | 'Queued' | 'Completed' | 'Failed';
	records: number;
};

type GenerateLeadProps = {
	title?: string;
	jobs?: LeadJob[];
	onPreview?: (jobId: string) => void;
	onDelete?: (jobId: string) => void;
	onAssign?: (jobId: string) => void;
	// navigation
	onNewLead?: () => void;
};

const sampleJobs: LeadJob[] = [
	{
		id: 'e58ed763-928c-4155-3...',
		source: 'Google Map',
		status: 'Running',
		records: 100,
	},
	{
		id: 'e58ed763-928c-4155-b...',
		source: 'LinkedIn',
		status: 'Validating',
		records: 6,
	},
];

export function GenerateLead(props: GenerateLeadProps) {
	const { title = 'Generate Lead', jobs = sampleJobs, onPreview, onDelete, onAssign, onNewLead } = props;

	return (
		<div className="rounded-2xl border border-neutral-800 bg-neutral-900 text-neutral-50 p-4">
			<div className="flex items-center justify-between mb-3">
				<h2 className="m-0 text-xl font-semibold">{title}</h2>
				<Button variant="outline" size="sm" type="button" onClick={() => onNewLead ? onNewLead() : (window.location.hash = '#/persona')}>New Lead</Button>
			</div>

			<Table
				columns={leadColumns}
				rows={jobs}
				getRowKey={(row, i) => row.id + i}
				renderCell={({ columnId, row, rowIndex }) => renderLeadCell({ columnId, row, rowIndex, onPreview, onDelete, onAssign })}
			/>
		</div>
	);
}

const leadColumns: TableColumn[] = [
	{ id: 'serial', header: 'S. No', width: '112px' },
	{ id: 'id', header: 'Job Id', width: '1.3fr' },
	{ id: 'source', header: 'Job Source', width: '1fr' },
	{ id: 'status', header: 'Status', width: '1fr' },
	{ id: 'records', header: 'Records Scrapped', width: '1fr' },
	{ id: 'actions', header: 'Action', width: '132px' },
];

function renderLeadCell({ columnId, row, rowIndex, onPreview, onDelete, onAssign }: { columnId: string; row: LeadJob; rowIndex: number; onPreview?: (id: string) => void; onDelete?: (id: string) => void; onAssign?: (id: string) => void; }) {
	switch (columnId) {
		case 'serial':
			return <>#{rowIndex + 1}</>
		case 'id':
			return <span title={row.id} className="truncate inline-block max-w-full align-middle">{row.id}</span>
		case 'source':
			return row.source
		case 'status':
			return <Badge variant={variantForStatus(row.status)}>{row.status}</Badge>
		case 'records':
			return row.records
		case 'actions':
			return (
				<div className="flex items-center justify-start gap-2">
					<Button size="icon" variant="default" aria-label="Preview" onClick={() => onPreview?.(row.id)}>
						<GridIcon />
					</Button>
					<Button size="icon" variant="destructive" aria-label="Delete" onClick={() => onDelete?.(row.id)}>
						<TrashIcon />
					</Button>
					<Button size="icon" variant="default" aria-label="Assign" onClick={() => onAssign?.(row.id)}>
						<UserPlusIcon />
					</Button>
				</div>
			)
		default:
			return null
	}
}

function variantForStatus(status: LeadJob['status']): React.ComponentProps<typeof Badge>['variant'] {
	switch (status) {
		case 'Running':
			return 'success';
		case 'Validating':
			return 'info';
		case 'Completed':
			return 'success';
		case 'Queued':
			return 'default';
		case 'Failed':
			return 'destructive';
		default:
			return 'default';
	}
}

function GridIcon() {
	return (
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M10 3H3v7h7V3Zm11 0h-7v7h7V3ZM10 14H3v7h7v-7Zm11 0h-7v7h7v-7Z" stroke="currentColor" strokeWidth="1.5"/>
		</svg>
	);
}

function TrashIcon() {
	return (
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M4 7h16M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M6 7l1 12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-12" stroke="currentColor" strokeWidth="1.5"/>
			<path d="M10 11v6M14 11v6" stroke="currentColor" strokeWidth="1.5"/>
		</svg>
	);
}

function UserPlusIcon() {
	return (
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M16 21v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1" stroke="currentColor" strokeWidth="1.5"/>
			<circle cx="9" cy="7" r="4" stroke="currentColor" strokeWidth="1.5"/>
			<path d="M20 8v6M17 11h6" stroke="currentColor" strokeWidth="1.5"/>
		</svg>
	);
}

export default GenerateLead;


