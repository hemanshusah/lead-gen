<?php

/** --------------------------------------------------------------------------------
 * This class validates input requests for the fooos crud controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\Fooo;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreUpdate extends FormRequest {

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
            'fooo_bar.required' => __('lang.fooo') . ' - ' . __('lang.is_required'),
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
         * these rules apply one when creating a new fooo
         * ------------------------------------------------------*/
        if ($this->getMethod() == 'POST') {
            $rules += [
                'fooo_clientid' => [
                    'required',
                ],
            ];
        }

        /**-------------------------------------------------------
         * these rules apply one when editing a fooo
         * ------------------------------------------------------*/
        if ($this->getMethod() == 'PUT') {
            $rules += [
                'fooo_clientid' => [
                    'required',
                ],
            ];
        }

        /**-------------------------------------------------------
         * these rules apply for both creating and editing fooos
         * ------------------------------------------------------*/
        $rules += [
            'fooo_example_text' => [
                'required',
            ],
            'fooo_example_date' => [
                'required',
                'date',
            ],
            function ($attribute, $value, $fail) {
                if ($value != 'bar') {
                    return $fail(__('lang.incorrect_value'));
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
