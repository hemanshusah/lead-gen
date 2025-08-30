<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LeadsImport implements ToModel, WithStartRow, WithHeadingRow, WithValidation, SkipsOnFailure {

    use Importable, SkipsFailures;

    private $rows = 0;
    private $skipped = 0;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {

        // Check for duplicates before creating the lead
        if ($this->isDuplicate($row)) {
            $this->skipped++;
            return null;
        }

        ++$this->rows;

        return new Lead([
            'lead_importid' => request('import_ref'),
            'lead_firstname' => $row['firstname'] ?? '',
            'lead_lastname' => $row['lastname'] ?? '',
            'lead_email' => $row['email'] ?? '',
            'lead_title' => $row['title'] ?? '',
            'lead_value' => $row['value'] ?? '',
            'lead_phone' => (string) $row['telephone'] ?? '',
            'lead_source' => $row['source'] ?? '',
            'lead_company_name' => $row['companyname'] ?? '',
            'lead_job_position' => $row['jobposition'] ?? '',
            'lead_street' => $row['street'] ?? '',
            'lead_city' => $row['city'] ?? '',
            'lead_state' => $row['state'] ?? '',
            'lead_zip' => $row['zipcode'] ?? '',
            'lead_country' => $row['country'] ?? '',
            'lead_website' => $row['website'] ?? '',
            'lead_description' => $row['description'] ?? '',
            'lead_custom_field_1' => $row['customfield1'] ?? '',
            'lead_custom_field_2' => $row['customfield2'] ?? '',
            'lead_custom_field_3' => $row['customfield3'] ?? '',
            'lead_custom_field_4' => $row['customfield4'] ?? '',
            'lead_custom_field_5' => $row['customfield5'] ?? '',
            'lead_custom_field_6' => $row['customfield6'] ?? '',
            'lead_custom_field_7' => $row['customfield7'] ?? '',
            'lead_custom_field_8' => $row['customfield8'] ?? '',
            'lead_custom_field_9' => $row['customfield9'] ?? '',
            'lead_custom_field_10' => $row['customfield10'] ?? '',
            'lead_custom_field_11' => $row['customfield11'] ?? '',
            'lead_custom_field_12' => $row['customfield12'] ?? '',
            'lead_custom_field_13' => $row['customfield13'] ?? '',
            'lead_custom_field_14' => $row['customfield14'] ?? '',
            'lead_custom_field_15' => $row['customfield15'] ?? '',
            'lead_custom_field_16' => $row['customfield16'] ?? '',
            'lead_custom_field_17' => $row['customfield17'] ?? '',
            'lead_custom_field_18' => $row['customfield18'] ?? '',
            'lead_custom_field_19' => $row['customfield19'] ?? '',
            'lead_custom_field_20' => $row['customfield20'] ?? '',
            'lead_custom_field_21' => $row['customfield21'] ?? '',
            'lead_custom_field_22' => $row['customfield22'] ?? '',
            'lead_custom_field_23' => $row['customfield23'] ?? '',
            'lead_custom_field_24' => $row['customfield24'] ?? '',
            'lead_custom_field_25' => $row['customfield25'] ?? '',
            'lead_custom_field_26' => $row['customfield26'] ?? '',
            'lead_custom_field_27' => $row['customfield27'] ?? '',
            'lead_custom_field_28' => $row['customfield28'] ?? '',
            'lead_custom_field_29' => $row['customfield29'] ?? '',
            'lead_custom_field_30' => $row['customfield30'] ?? '',
            'lead_custom_field_31' => $row['customfield31'] ?? '',
            'lead_custom_field_32' => $row['customfield32'] ?? '',
            'lead_custom_field_33' => $row['customfield33'] ?? '',
            'lead_custom_field_34' => $row['customfield34'] ?? '',
            'lead_custom_field_35' => $row['customfield35'] ?? '',
            'lead_custom_field_36' => $row['customfield36'] ?? '',
            'lead_custom_field_37' => $row['customfield37'] ?? '',
            'lead_custom_field_38' => $row['customfield38'] ?? '',
            'lead_custom_field_39' => $row['customfield39'] ?? '',
            'lead_custom_field_40' => $row['customfield40'] ?? '',
            'lead_custom_field_41' => $row['customfield41'] ?? '',
            'lead_custom_field_42' => $row['customfield42'] ?? '',
            'lead_custom_field_43' => $row['customfield43'] ?? '',
            'lead_custom_field_44' => $row['customfield44'] ?? '',
            'lead_custom_field_45' => $row['customfield45'] ?? '',
            'lead_custom_field_46' => $row['customfield46'] ?? '',
            'lead_custom_field_47' => $row['customfield47'] ?? '',
            'lead_custom_field_48' => $row['customfield48'] ?? '',
            'lead_custom_field_49' => $row['customfield49'] ?? '',
            'lead_custom_field_50' => $row['customfield50'] ?? '',
            'lead_custom_field_51' => $row['customfield51'] ?? '',
            'lead_custom_field_52' => $row['customfield52'] ?? '',
            'lead_custom_field_53' => $row['customfield53'] ?? '',
            'lead_custom_field_54' => $row['customfield54'] ?? '',
            'lead_custom_field_55' => $row['customfield55'] ?? '',
            'lead_custom_field_56' => $row['customfield56'] ?? '',
            'lead_custom_field_57' => $row['customfield57'] ?? '',
            'lead_custom_field_58' => $row['customfield58'] ?? '',
            'lead_custom_field_59' => $row['customfield59'] ?? '',
            'lead_custom_field_60' => $row['customfield60'] ?? '',
            'lead_custom_field_61' => $row['customfield61'] ?? '',
            'lead_custom_field_62' => $row['customfield62'] ?? '',
            'lead_custom_field_63' => $row['customfield63'] ?? '',
            'lead_custom_field_64' => $row['customfield64'] ?? '',
            'lead_custom_field_65' => $row['customfield65'] ?? '',
            'lead_custom_field_66' => $row['customfield66'] ?? '',
            'lead_custom_field_67' => $row['customfield67'] ?? '',
            'lead_custom_field_68' => $row['customfield68'] ?? '',
            'lead_custom_field_69' => $row['customfield69'] ?? '',
            'lead_custom_field_70' => $row['customfield70'] ?? '',
            'lead_custom_field_71' => $row['customfield71'] ?? '',
            'lead_custom_field_72' => $row['customfield72'] ?? '',
            'lead_custom_field_73' => $row['customfield73'] ?? '',
            'lead_custom_field_74' => $row['customfield74'] ?? '',
            'lead_custom_field_75' => $row['customfield75'] ?? '',
            'lead_custom_field_76' => $row['customfield76'] ?? '',
            'lead_custom_field_77' => $row['customfield77'] ?? '',
            'lead_custom_field_78' => $row['customfield78'] ?? '',
            'lead_custom_field_79' => $row['customfield79'] ?? '',
            'lead_custom_field_80' => $row['customfield80'] ?? '',
            'lead_custom_field_81' => $row['customfield81'] ?? '',
            'lead_custom_field_82' => $row['customfield82'] ?? '',
            'lead_custom_field_83' => $row['customfield83'] ?? '',
            'lead_custom_field_84' => $row['customfield84'] ?? '',
            'lead_custom_field_85' => $row['customfield85'] ?? '',
            'lead_custom_field_86' => $row['customfield86'] ?? '',
            'lead_custom_field_87' => $row['customfield87'] ?? '',
            'lead_custom_field_88' => $row['customfield88'] ?? '',
            'lead_custom_field_89' => $row['customfield89'] ?? '',
            'lead_custom_field_90' => $row['customfield90'] ?? '',
            'lead_custom_field_91' => $row['customfield91'] ?? '',
            'lead_custom_field_92' => $row['customfield92'] ?? '',
            'lead_custom_field_93' => $row['customfield93'] ?? '',
            'lead_custom_field_94' => $row['customfield94'] ?? '',
            'lead_custom_field_95' => $row['customfield95'] ?? '',
            'lead_custom_field_96' => $row['customfield96'] ?? '',
            'lead_custom_field_97' => $row['customfield97'] ?? '',
            'lead_custom_field_98' => $row['customfield98'] ?? '',
            'lead_custom_field_99' => $row['customfield99'] ?? '',
            'lead_custom_field_100' => $row['customfield100'] ?? '',
            'lead_custom_field_101' => $row['customfield101'] ?? '',
            'lead_custom_field_102' => $row['customfield102'] ?? '',
            'lead_custom_field_103' => $row['customfield103'] ?? '',
            'lead_custom_field_104' => $row['customfield104'] ?? '',
            'lead_custom_field_105' => $row['customfield105'] ?? '',
            'lead_custom_field_106' => $row['customfield106'] ?? '',
            'lead_custom_field_107' => $row['customfield107'] ?? '',
            'lead_custom_field_108' => $row['customfield108'] ?? '',
            'lead_custom_field_109' => $row['customfield109'] ?? '',
            'lead_custom_field_110' => $row['customfield110'] ?? '',
            'lead_custom_field_111' => $row['customfield111'] ?? '',
            'lead_custom_field_112' => $row['customfield112'] ?? '',
            'lead_custom_field_113' => $row['customfield113'] ?? '',
            'lead_custom_field_114' => $row['customfield114'] ?? '',
            'lead_custom_field_115' => $row['customfield115'] ?? '',
            'lead_custom_field_116' => $row['customfield116'] ?? '',
            'lead_custom_field_117' => $row['customfield117'] ?? '',
            'lead_custom_field_118' => $row['customfield118'] ?? '',
            'lead_custom_field_119' => $row['customfield119'] ?? '',
            'lead_custom_field_120' => $row['customfield120'] ?? '',
            'lead_custom_field_121' => $row['customfield121'] ?? '',
            'lead_custom_field_122' => $row['customfield122'] ?? '',
            'lead_custom_field_123' => $row['customfield123'] ?? '',
            'lead_custom_field_124' => $row['customfield124'] ?? '',
            'lead_custom_field_125' => $row['customfield125'] ?? '',
            'lead_custom_field_126' => $row['customfield126'] ?? '',
            'lead_custom_field_127' => $row['customfield127'] ?? '',
            'lead_custom_field_128' => $row['customfield128'] ?? '',
            'lead_custom_field_129' => $row['customfield129'] ?? '',
            'lead_custom_field_130' => $row['customfield130'] ?? '',
            'lead_custom_field_131' => $row['customfield131'] ?? '',
            'lead_custom_field_132' => $row['customfield132'] ?? '',
            'lead_custom_field_133' => $row['customfield133'] ?? '',
            'lead_custom_field_134' => $row['customfield134'] ?? '',
            'lead_custom_field_135' => $row['customfield135'] ?? '',
            'lead_custom_field_136' => $row['customfield136'] ?? '',
            'lead_custom_field_137' => $row['customfield137'] ?? '',
            'lead_custom_field_138' => $row['customfield138'] ?? '',
            'lead_custom_field_139' => $row['customfield139'] ?? '',
            'lead_custom_field_140' => $row['customfield140'] ?? '',
            'lead_custom_field_141' => $row['customfield141'] ?? '',
            'lead_custom_field_142' => $row['customfield142'] ?? '',
            'lead_custom_field_143' => $row['customfield143'] ?? '',
            'lead_custom_field_144' => $row['customfield144'] ?? '',
            'lead_custom_field_145' => $row['customfield145'] ?? '',
            'lead_custom_field_146' => $row['customfield146'] ?? '',
            'lead_custom_field_147' => $row['customfield147'] ?? '',
            'lead_custom_field_148' => $row['customfield148'] ?? '',
            'lead_custom_field_149' => $row['customfield149'] ?? '',
            'lead_custom_field_150' => $row['customfield150'] ?? '',
            'lead_creatorid' => auth()->id(),
            'lead_created' => now(),
            'lead_status' => request('lead_status'),
        ]);
    }

    /**
     * Check if the lead is a duplicate based on system settings
     * Each setting is checked individually, and if any match is found, it's a duplicate
     * @param array $row
     * @return bool
     */
    protected function isDuplicate($row) {

        // Check each enabled setting separately
        $duplicate_found = false;

        // Get duplicate checking settings
        $check_name = config('system.settings2_importing_leads_duplicates_name') == 'yes';
        $check_email = config('system.settings2_importing_leads_duplicates_email') == 'yes';
        $check_telephone = config('system.settings2_importing_leads_duplicates_telephone') == 'yes';
        $check_company = config('system.settings2_importing_leads_duplicates_company') == 'yes';

        // If no duplicate checking is enabled, return false
        if (!$check_name && !$check_email && !$check_telephone && !$check_company) {
            return false;
        }

        // Check name
        if ($check_name) {
            if (!empty($row['firstname']) && !empty($row['lastname'])) {
                if (\App\Models\Lead::where('lead_firstname', $row['firstname'])->Where('lead_lastname', $row['lastname'])->exists()) {
                    $duplicate_found = true;
                }
            }

            /* also check only first name or only last name ???
            if (!empty($row['firstname']) && empty($row['lastname'])) {
                if (\App\Models\Lead::where('lead_firstname', $row['firstname'])->exists()) {
                    $duplicate_found = true;
                }
            }

            if (empty($row['firstname']) && !empty($row['lastname'])) {
                if (\App\Models\Lead::where('lead_lastname', $row['lastname']->exists())) {
                    $duplicate_found = true;
                }
            }
            */
        }

        // Check email
        if (!$duplicate_found && $check_email && !empty($row['email'])) {
            if (\App\Models\Lead::where('lead_email', $row['email'])->exists()) {
                $duplicate_found = true;
            }
        }

        // Check telephone
        if (!$duplicate_found && $check_telephone && !empty($row['telephone'])) {
            if (\App\Models\Lead::where('lead_phone', (string) $row['telephone'])->exists()) {
                $duplicate_found = true;
            }
        }

        // Check company name
        if (!$duplicate_found && $check_company && !empty($row['companyname'])) {
            if (\App\Models\Lead::where('lead_company_name', $row['companyname'])->exists()) {
                $duplicate_found = true;
            }
        }

        return $duplicate_found;
    }

    public function rules(): array
    {
        return [
            'firstname' => [
                'required',
            ],
            'lastname' => [
                'required',
            ],
            'title' => [
                'required',
            ],
        ];
    }

    /**
     * we are ignoring the header and so we will start with row number (2)
     * @return int
     */
    public function startRow(): int {
        return 2;
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
}