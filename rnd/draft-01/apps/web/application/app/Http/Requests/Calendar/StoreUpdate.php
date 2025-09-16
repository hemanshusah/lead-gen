<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the template controller
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\Calendar;

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
     * custom error messages for specific valdation checks
     * @optional
     * @return array
     */
    public function messages() {
        return [
            'calendar_event_title.required' => __('lang.title') . ' - ' . __('lang.is_required'),
            'calendar_event_start_date.required' => __('lang.start_date') . ' - ' . __('lang.is_required'),
            'calendar_event_start_date.date' => __('lang.start_date') . ' - ' . __('lang.is_invalid'),
            'calendar_event_end_date.required_if' => __('lang.end_date') . ' - ' . __('lang.is_required'),
            'calendar_event_end_date.date' => __('lang.end_date') . ' - ' . __('lang.is_invalid'),
            'calendar_event_start_time.required_if' => __('lang.start_time') . ' - ' . __('lang.is_required'),
            'calendar_event_start_time.regex' => __('lang.start_time') . ' - ' . __('lang.is_invalid'),
            'calendar_event_end_time.required_if' => __('lang.end_time') . ' - ' . __('lang.is_required'),
            'calendar_event_end_time.regex' => __('lang.end_time') . ' - ' . __('lang.is_invalid'),
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
            'calendar_event_title' => [
                'required',
            ],
            'calendar_event_start_date' => [
                'required',
                'date',
            ],
            'calendar_event_end_date' => [
                'required_if:resource_type,==,calendarevent',
                'nullable',
                'date',
            ],
            'calendar_event_start_time' => [
                'required_if:calendar_event_all_day,==,off',
                'nullable',
            ],
            'calendar_event_end_time' => [
                'required_if:calendar_event_all_day,==,off',
                'nullable',
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
