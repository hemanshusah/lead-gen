<?php

/** --------------------------------------------------------------------------------
 * {EXAMPLE] Request Class for validating form submission
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\Fooo;

use App\Rules\NoTags;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdate extends FormRequest {

    //use App\Http\Requests\Foo\TemplateValidation;
    //function update(TemplateValidation $request,

    /**
     * we are checking authorised users via the middleware
     * so just retun true here
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * add messages for all checked items here (e.g. required|int|email|min|max|etc)
     * @optional
     * @return array
     */
    public function messages() {
        return [
            'fooo_bar.required' => __('lang.fooo') . ' - ' . __('lang.is_required'),
            'fooo_bar.int' => __('lang.fooo') . ' - ' . __('lang.is_not_a_valid_number'),
            'fooo_bar.email' => __('lang.fooo') . ' - ' . __('lang.is_not_a_valid_email_address'),
            'fooo_bar.min' => __('lang.fooo') . ' - ' . __('lang.must_be_greater_than_or_equal_to') . ' 100',
            'fooo_bar.max' => __('lang.fooo') . ' - ' . __('lang.must_be_less_than_or_equal_to') . ' 100',
            'fooo_bar.url' => __('lang.fooo') . ' - ' . __('lang.is_not_a_valid_url'),
        ];
    }

    /**
     * Validate the request
     * @return array
     */
    public function rules() {

        //initialize
        $rules = [];

        /**-------------------------------------------------------
         * [create] only rules
         * ------------------------------------------------------*/
        if ($this->getMethod() == 'POST') {
            $rules += [
                'fooo_clientid' => [
                    'required',
                ],
            ];
        }

        /**-------------------------------------------------------
         * [update] only rules
         * ------------------------------------------------------*/
        if ($this->getMethod() == 'PUT') {
            $rules += [
                'fooo_clientid' => [
                    'required',
                ],
            ];
        }

        /**-------------------------------------------------------
         * common rules for both [create] and [update] requests
         * ------------------------------------------------------*/
        $rules += [
            'fooo_title' => [
                'required',
                new NoTags,
            ],
            'fooo_date_start' => [
                'required',
                'date',
            ],
            function ($attribute, $value, $fail) {
                if ($value != '' && request('fooo_date_start') != '' && (strtotime($value) < strtotime(request('fooo_date_start')))) {
                    return $fail(__('lang.due_date_must_be_after_start_date'));
                }
            },
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
