<?php

namespace App\Exports;

use App\Repositories\CustomFieldsRepository;
use App\Repositories\LeadRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadsExport implements FromCollection, WithHeadings, WithMapping {

    protected $leadrepo;
    protected $customrepo;

    public function __construct(LeadRepository $leadrepo, CustomFieldsRepository $customrepo) {
        $this->leadrepo = $leadrepo;
        $this->customrepo = $customrepo;
    }

    public function collection() {
        return $this->leadrepo->search('', ['no_pagination' => true]);
    }

    public function map($leads): array{
        $map = [];

        if (is_array(request('standard_field'))) {
            foreach (request('standard_field') as $key => $value) {
                if ($value == 'on') {
                    switch ($key) {
                    case 'lead_title':
                        $map[] = $leads->lead_title;
                        break;
                    case 'lead_firstname':
                        $map[] = $leads->lead_firstname;
                        break;
                    case 'lead_lastname':
                        $map[] = $leads->lead_lastname;
                        break;
                    case 'lead_creator':
                        $map[] = $leads->first_name . ' ' . $leads->last_name;
                        break;
                    case 'lead_email':
                        $map[] = $leads->lead_email;
                        break;
                    case 'lead_phone':
                        $map[] = $leads->lead_phone;
                        break;
                    case 'lead_job_position':
                        $map[] = $leads->lead_job_position;
                        break;
                    case 'lead_website':
                        $map[] = $leads->lead_website;
                        break;
                    case 'lead_street':
                        $map[] = $leads->lead_street;
                        break;
                    case 'lead_city':
                        $map[] = $leads->lead_city;
                        break;
                    case 'lead_state':
                        $map[] = $leads->lead_state;
                        break;
                    case 'lead_zip':
                        $map[] = $leads->lead_zip;
                        break;
                    case 'lead_country':
                        $map[] = $leads->lead_country;
                        break;
                    case 'lead_description':
                        $map[] = $leads->lead_description;
                        break;
                    case 'lead_company_name':
                        $map[] = $leads->lead_company_name;
                        break;
                    case 'lead_value':
                        $map[] = runtimeExcelNumberFormat($leads->lead_value);
                        break;
                    case 'lead_source':
                        $map[] = $leads->lead_source;
                        break;
                    case 'lead_status':
                        $map[] = $leads->leadstatus_title;
                        break;
                    case 'lead_last_contacted':
                        $map[] = runtimeDate($leads->lead_last_contacted);
                        break;
                    case 'lead_converted':
                        $map[] = ($leads->lead_converted == 'yes') ? __('lang.yes') : __('lang.no');
                        break;
                    case 'lead_converted_by':
                        $map[] = $leads->converted_by_first_name . ' ' . $leads->converted_by_last_name;
                        break;
                    case 'lead_converted_date':
                        $map[] = runtimeDate($leads->lead_converted_date);
                        break;
                    default:
                        $map[] = $leads->{$key};
                        break;
                    }
                }
            }
        }

        if (is_array(request('custom_field'))) {
            foreach (request('custom_field') as $key => $value) {
                if ($value == 'on') {
                    if ($field = \App\Models\CustomField::Where('customfields_name', $key)->first()) {
                        switch ($field->customfields_datatype) {
                        case 'date':
                            $map[] = runtimeDate($leads->{$key});
                            break;
                        case 'checkbox':
                            $map[] = ($leads->{$key} == 'on') ? __('lang.checked_custom_fields') : '---';
                            break;
                        default:
                            $map[] = $leads->{$key};
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

    public function headings(): array{
        $heading = [];

        $standard_lang = [
            'lead_title' => __('lang.title'),
            'lead_firstname' => __('lang.first_name'),
            'lead_lastname' => __('lang.last_name'),
            'lead_creator' => __('lang.created_by'),
            'lead_email' => __('lang.email'),
            'lead_phone' => __('lang.phone'),
            'lead_job_position' => __('lang.job_title'),
            'lead_website' => __('lang.website'),
            'lead_street' => __('lang.street'),
            'lead_city' => __('lang.city'),
            'lead_state' => __('lang.state'),
            'lead_zip' => __('lang.zipcode'),
            'lead_country' => __('lang.country'),
            'lead_description' => __('lang.description'),
            'lead_company_name' => __('lang.company_name'),
            'lead_value' => __('lang.value'),
            'lead_source' => __('lang.source'),
            'lead_status' => __('lang.status'),
            'lead_last_contacted' => __('lang.last_contacted'),
            'lead_converted' => __('lang.converted'),
            'lead_converted_by' => __('lang.converted_by'),
            'lead_converted_date' => __('lang.date_converted'),
        ];

        $custom_lang = $this->customrepo->fieldTitles();

        if (is_array(request('standard_field'))) {
            foreach (request('standard_field') as $key => $value) {
                if ($value == 'on') {
                    $heading[] = (isset($standard_lang[$key])) ? $standard_lang[$key] : $key;
                }
            }
        }

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