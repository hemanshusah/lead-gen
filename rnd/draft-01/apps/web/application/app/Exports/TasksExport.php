<?php

namespace App\Exports;

use App\Repositories\CustomFieldsRepository;
use App\Repositories\TaskRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasksExport implements FromCollection, WithHeadings, WithMapping {

    /**
     * Repository instances
     */
    protected $taskrepo;
    protected $customrepo;

    public function __construct(TaskRepository $taskrepo, CustomFieldsRepository $customrepo) {
        $this->taskrepo = $taskrepo;
        $this->customrepo = $customrepo;
    }

    //get the tasks
    public function collection() {
        //search
        $tasks = $this->taskrepo->search('', ['no_pagination' => true]);
        //return
        return $tasks;
    }

    //map the columns that we want
    public function map($tasks): array{
        $map = [];

        //standard fields - loop through all post data
        if (is_array(request('standard_field'))) {
            foreach (request('standard_field') as $key => $value) {
                if ($value == 'on') {
                    switch ($key) {
                    case 'task_id':
                        $map[] = $tasks->task_id;
                        break;
                    case 'task_title':
                        $map[] = $tasks->task_title;
                        break;
                    case 'task_date_start':
                        $map[] = runtimeDate($tasks->task_date_start);
                        break;
                    case 'task_date_due':
                        $map[] = runtimeDate($tasks->task_date_due);
                        break;
                    case 'task_description':
                        $map[] = (config('system.settings_system_exporting_strip_html') == 'yes') ? convert_html_to_plain_text($tasks->task_description) : html_entity_decode($tasks->task_description);
                        break;
                    case 'task_assigned':
                        $assigned_users = [];
                        foreach ($tasks->assigned as $user) {
                            $assigned_users[] = strip_tags($user->first_name . ' ' . $user->last_name);
                        }
                        $map[] = implode(", ", $assigned_users);
                        break;
                    case 'task_creatorid':
                        $map[] = $tasks->first_name . ' ' . $tasks->last_name;
                        break;
                    case 'task_clientid':
                        $map[] = $tasks->client_id;
                        break;
                    case 'task_client':
                        $map[] = $tasks->client_company_name;
                        break;
                    case 'task_projectid':
                        $map[] = $tasks->project_id;
                        break;
                    case 'task_project':
                        $map[] = $tasks->project_title;
                        break;
                    case 'task_milestoneid':
                        $map[] = $tasks->milestone_title;
                        break;
                    case 'task_priority':
                        $map[] = $tasks->taskpriority_title;
                        break;
                    case 'task_status':
                        $map[] = $tasks->taskstatus_title;
                        break;
                    case 'task_billable':
                        $map[] = ($tasks->task_billable == 'yes') ? __('lang.yes') : __('lang.no');
                        break;
                    case 'task_billable_status':
                        $map[] = ($tasks->task_billable_status == 'invoiced') ? __('lang.invoiced') : __('lang.not_invoiced');
                        break;
                    case 'task_billable_invoiceid':
                        $map[] = runtimeInvoiceIdFormat($tasks->task_billable_invoiceid);
                        break;
                    case 'task_recurring':
                        $map[] = ($tasks->task_recurring == 'yes') ? __('lang.yes') : __('lang.no');
                        break;
                    case 'task_recurring_duration':
                        $map[] = $tasks->task_recurring_duration;
                        break;
                    case 'task_recurring_period':
                        $map[] = $tasks->task_recurring_period;
                        break;
                    case 'task_recurring_cycles':
                        $map[] = $tasks->task_recurring_cycles;
                        break;
                    case 'task_recurring_cycles_counter':
                        $map[] = $tasks->task_recurring_cycles_counter;
                        break;
                    case 'task_recurring_last':
                        $map[] = runtimeDate($tasks->task_recurring_last);
                        break;
                    case 'task_recurring_next':
                        $map[] = runtimeDate($tasks->task_recurring_next);
                        break;
                    case 'task_recurring_parent_id':
                        $map[] = $tasks->task_recurring_parent_id;
                        break;
                    default:
                        $map[] = $tasks->{$key};
                        break;
                    }
                }
            }
        }

        //custom fields - loop through all post data
        if (is_array(request('custom_field'))) {
            foreach (request('custom_field') as $key => $value) {
                if ($value == 'on') {
                    if ($field = \App\Models\CustomField::Where('customfields_name', $key)->first()) {
                        switch ($field->customfields_datatype) {
                        case 'date':
                            $map[] = runtimeDate($tasks->{$key});
                            break;
                        case 'checkbox':
                            $map[] = ($tasks->{$key} == 'on') ? __('lang.checked_custom_fields') : '---';
                            break;
                        default:
                            $map[] = $tasks->{$key};
                            break;
                        }
                    } else {
                        $map[] = '';
                    }
                }
            }
        }

        return $map;
    }

    //create heading
    public function headings(): array{
        //headings
        $heading = [];

        //lang - standard fields (map each field here)
        $standard_lang = [
            'task_id' => __('lang.id'),
            'task_title' => __('lang.title'),
            'task_date_start' => __('lang.start_date'),
            'task_date_due' => __('lang.due_date'),
            'task_description' => __('lang.description'),
            'task_assigned' => __('lang.assigned'),
            'task_creatorid' => __('lang.created_by'),
            'task_clientid' => __('lang.client_id'),
            'task_projectid' => __('lang.project_id'),
            'task_milestoneid' => __('lang.milestone'),
            'task_priority' => __('lang.priority'),
            'task_status' => __('lang.status'),
            'task_billable' => __('lang.billable'),
            'task_billable_status' => __('lang.billing_status'),
            'task_billable_invoiceid' => __('lang.invoice_id'),
            'task_recurring' => __('lang.recurring'),
            'task_recurring_duration' => __('lang.duration'),
            'task_recurring_period' => __('lang.period'),
            'task_recurring_cycles' => __('lang.cycles'),
            'task_recurring_cycles_counter' => __('lang.recurred_counter'),
            'task_recurring_last' => __('lang.last_recurred'),
            'task_recurring_next' => __('lang.next_recurring'),
            'task_client' => __('lang.client'),
            'task_client' => __('lang.project'),
            'task_recurring_parent_id' => __('lang.recurring_parent_id'),
        ];

        //lang - custom fields (i.e. field titles)
        $custom_lang = $this->customrepo->fieldTitles();

        //standard fields - loop through all post data
        if (is_array(request('standard_field'))) {
            foreach (request('standard_field') as $key => $value) {
                if ($value == 'on') {
                    $heading[] = (isset($standard_lang[$key])) ? $standard_lang[$key] : $key;
                }
            }
        }

        //custom fields - loop through all post data
        if (is_array(request('custom_field'))) {
            foreach (request('custom_field') as $key => $value) {
                if ($value == 'on') {
                    $heading[] = (isset($custom_lang[$key])) ? $custom_lang[$key] : $key;
                }
            }
        }

        return $heading;
    }
}