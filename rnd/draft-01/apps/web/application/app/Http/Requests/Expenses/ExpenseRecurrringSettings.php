<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the invoices controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\Expenses;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseRecurrringSettings extends FormRequest {

    /**
     * we are checking authorised users via the middleware
     * so just retun true here
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * custom error messages for specific valdation checks
     * @optional
     * @return array
     */
    public function messages() {
        return [
            'expense_recurring_duration.required' => __('lang.recurring_period').' - '. __('lang.is_required'),
            'expense_recurring_duration.integer' => __('lang.recurring_period').' - '. __('lang.is_invalid'),
            'expense_recurring_period.required' => __('lang.recurring_period').' - '. __('lang.is_required'),
            'expense_recurring_cycles.integer' => __('lang.recurring_cycle').' - '. __('lang.is_invalid'),
            'expense_recurring_next.required' => __('lang.next_expense_date').' - '. __('lang.is_required'),
            'expense_recurring_next.date' => __('lang.next_expense_date').' - '. __('lang.is_invalid'),
        ];
    }

    /**
     * Validate the request
     * @return array
     */
    public function rules() {

        /**-------------------------------------------------------
         * common rules for both [create] and [update] requests
         * ------------------------------------------------------*/
        $rules = [
            'expense_recurring_duration' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value <= 0) {
                        return $fail(__('lang.repeat_value_greater_than_zero'));
                    }
                },
            ],
            'expense_recurring_period' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, ['day', 'week', 'month', 'year'])) {
                        return $fail(__('lang.invalid_repeat_every'));
                    }
                },
            ],
            'expense_recurring_cycles' => [
                'integer',
            ],
            'expense_recurring_next' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(now()->toDateString())) {
                        return $fail(__('lang.next_expense_date_cannot_be_in_past'));
                    }
                },
            ],
        ];
        //validate
        return $rules;
    }

    /**
     * Deal with the errors - send messages to the frontend
     */
    public function failedValidation(Validator $validator) {

        $errors = $validator->errors();
        $messages = '';
        foreach ($errors->all() as $message) {
            $messages .= "<li>$message</li>";
        }

        abort(409, $messages);
    }
}
