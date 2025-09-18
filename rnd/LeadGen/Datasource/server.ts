import express from 'express';
import cors from 'cors';

const app = express();
app.use(cors());
app.use(express.json());

type Job = {
	id: string;
	source: string;
	status: string;
	records: number;
};

const jobs: Job[] = [
	{ id: 'e58ed763-928c-4155-3...', source: 'Google Map', status: 'Running', records: 100 },
	{ id: 'e58ed763-928c-4155-b...', source: 'LinkedIn', status: 'Validating', records: 6 },
];

app.get('/api/jobs', (_req, res) => {
	res.json(jobs);
});

const port = process.env.PORT || 5555;
app.listen(port, () => {
	console.log(`Datasource API listening on http://localhost:${port}`);
});


