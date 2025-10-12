<?php

namespace App\Imports;

use App\Models\Checklist;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ChecklistImport implements ToModel, WithStartRow, WithValidation, SkipsOnFailure {

    use Importable, SkipsFailures;

    private $rows = 0;
    private $skipped = 0;
    private $checklistresource_type;
    private $checklistresource_id;
    private $import_limit;
    private $max_limit_reached = false;

    public function __construct($checklistresource_type, $checklistresource_id, $import_limit = 500) {
        $this->checklistresource_type = $checklistresource_type;
        $this->checklistresource_id = $checklistresource_id;
        $this->import_limit = $import_limit;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {

        // Check if we've reached the import limit
        if ($this->rows >= $this->import_limit) {
            $this->max_limit_reached = true;
            $this->skipped++;
            return null;
        }

        // Check for duplicates before creating the checklist item
        if ($this->isDuplicate($row)) {
            $this->skipped++;
            return null;
        }

        ++$this->rows;

        // Get next position
        if ($last = \App\Models\Checklist::Where('checklistresource_type', $this->checklistresource_type)
            ->Where('checklistresource_id', $this->checklistresource_id)
            ->orderBy('checklist_position', 'desc')
            ->first()) {
            $position = $last->checklist_position + 1;
        } else {
            // Default position
            $position = 1;
        }

        // Determine checklist status from second column
        $status = $this->determineStatus($row);

        // Get checklist text - try expected column names first, then fall back to first column
        $checklist_text = $this->getChecklistText($row);

        return new Checklist([
            'checklist_text' => $checklist_text,
            'checklist_status' => $status,
            'checklist_position' => $position + $this->rows,
            'checklistresource_type' => $this->checklistresource_type,
            'checklistresource_id' => $this->checklistresource_id,
            'checklist_creatorid' => auth()->id(),
            'checklist_created' => now(),
        ]);
    }

    /**
     * Get checklist text from first column (index 0)
     * @param array $row
     * @return string
     */
    private function getChecklistText($row) {
        // Get the first column value
        $values = array_values($row);
        $text = isset($values[0]) ? trim($values[0]) : '';

        return $text;
    }

    /**
     * Determine the checklist status from the second column (index 1)
     * @param array $row
     * @return string
     */
    private function determineStatus($row) {
        // Default status
        $status = 'pending';

        // Get the second column value
        $values = array_values($row);
        $status_value = isset($values[1]) ? trim($values[1]) : '';

        // Convert to lowercase for comparison
        $status_value = strtolower($status_value);

        // Check for completed status indicators
        $completed_indicators = [
            'x',
            'done', 'completed', 'complete', 'finished',
            'yes', 'y', 'true', '1',
            'checked', 'tick', 'ticked',
        ];

        if (in_array($status_value, $completed_indicators)) {
            $status = 'completed';
        }

        return $status;
    }

    /**
     * Check if the checklist item is a duplicate
     * @param array $row
     * @return bool
     */
    protected function isDuplicate($row) {

        $checklist_text = $this->getChecklistText($row);

        if (empty($checklist_text)) {
            return true; // Skip empty rows
        }

        //14 june 2025 - lets ignore this functionality for now
        return false;

        // Check for duplicate checklist text in the same resource
        if (\App\Models\Checklist::where('checklistresource_type', $this->checklistresource_type)
            ->where('checklistresource_id', $this->checklistresource_id)
            ->where('checklist_text', $checklist_text)
            ->exists()) {
            return true;
        }

        return false;
    }

    public function rules(): array
    {
        return [
            // No specific rules needed for position-based columns
        ];
    }

    /**
     * we start with row number (1) since there are no headers
     * @return int
     */
    public function startRow(): int {
        return 1;
    }

    /**
     * lets count the total imported rows
     * @return int
     */
    public function getRowCount(): int {
        return $this->rows;
    }

    /**
     * get count of skipped duplicate rows
     * @return int
     */
    public function getSkippedCount(): int {
        return $this->skipped;
    }

    /**
     * Check if maximum import limit was reached
     * @return bool
     */
    public function maxLimitReached(): bool {
        return $this->max_limit_reached;
    }

    /**
     * Get the maximum number of items that can be imported
     * @return int
     */
    public function getMaxItems(): int {
        return $this->import_limit;
    }
}