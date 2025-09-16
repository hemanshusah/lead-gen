<?php

namespace App\Exports;

use App\Repositories\ItemRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements FromCollection, WithHeadings, WithMapping {

    /**
     * The items repo repository
     */
    protected $itemsrepo;

    public function __construct(ItemRepository $itemsrepo) {
        $this->itemsrepo = $itemsrepo;
    }

    //get the items
    public function collection() {
        //search
        $items = $this->itemsrepo->search('', ['no_pagination' => true]);
        //return
        return $items;
    }

    //map the columns that we want
    public function map($items): array{
        //get sold data from lineitems
        $count_sold = \App\Models\Lineitem::where('lineitem_linked_product_id', $items->item_id)
            ->join('invoices', 'lineitems.lineitemresource_id', '=', 'invoices.bill_invoiceid')
            ->where('lineitemresource_type', 'invoice')
            ->where('bill_status', 'paid')
            ->count() ?? 0;

        $sum_sold = \App\Models\Lineitem::where('lineitem_linked_product_id', $items->item_id)
            ->join('invoices', 'lineitems.lineitemresource_id', '=', 'invoices.bill_invoiceid')
            ->where('lineitemresource_type', 'invoice')
            ->where('bill_status', 'paid')
            ->sum('lineitem_total') ?? 0;

        $map = [];

        //standard fields - loop thorugh all post data
        if (is_array(request('standard_field'))) {
            foreach (request('standard_field') as $key => $value) {
                if ($value == 'on') {
                    switch ($key) {
                    case 'item_created':
                        $map[] = runtimeDate($items->item_created);
                        break;
                    case 'item_description':
                        $map[] = $items->item_description;
                        break;
                    case 'item_unit':
                        $map[] = $items->item_unit;
                        break;
                    case 'item_rate':
                        $map[] = runtimeMoneyFormat($items->item_rate);
                        break;
                    case 'item_category':
                        $map[] = $items->category_name;
                        break;
                    case 'item_notes_estimatation':
                        $map[] = $items->item_notes_estimatation;
                        break;
                    case 'count_sold':
                        $map[] = runtimeExcelNumberFormat($count_sold);
                        break;
                    case 'sum_sold':
                        $map[] = runtimeExcelNumberFormat($sum_sold);
                        break;
                    default:
                        $map[] = $items->{$key};
                        break;
                    }
                }
            }
        }

        return $map;
    }

    //create heading
    public function headings(): array
    {
        //headings
        $heading = [];

        //lang - standard fields (map each field here)
        $standard_lang = [
            'item_created' => __('lang.date_created'),
            'item_description' => __('lang.description'),
            'item_unit' => __('lang.unit'),
            'item_rate' => __('lang.rate'),
            'item_category' => __('lang.category'),
            'item_notes_estimatation' => __('lang.notes'),
            'count_sold' => __('lang.number_sold'),
            'sum_sold' => __('lang.amount_sold'),
        ];

        //standard fields - loop thorugh all post data
        if (is_array(request('standard_field'))) {
            foreach (request('standard_field') as $key => $value) {
                if ($value == 'on') {
                    $heading[] = (isset($standard_lang[$key])) ? $standard_lang[$key] : $key;
                }
            }
        }

        return $heading;
    }
}