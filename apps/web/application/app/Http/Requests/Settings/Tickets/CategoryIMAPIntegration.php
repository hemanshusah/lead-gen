<?php

/** --------------------------------------------------------------------------------
 * This middleware class validates input requests for the template controller
 * [IMAP - table column mapping]
 *    email        - category_meta_5
 *    username     - category_meta_6
 *    password     - category_meta_7
 *    host         - category_meta_8
 *    port         - category_meta_9
 *    encryption   - category_meta_10
 *    post_action  - category_meta_11
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Requests\Settings\Tickets;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CategoryIMAPIntegration extends FormRequest {

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
            'category_meta_5.required' => __('lang.email_address') . ' - ' . __('lang.is_required'),
            'category_meta_6.required' => __('lang.user_name') . ' - ' . __('lang.is_required'),
            'category_meta_7.required' => __('lang.password') . ' - ' . __('lang.is_required'),
            'category_meta_8.required' => __('lang.host') . ' - ' . __('lang.is_required'),
            'category_meta_9.required' => __('lang.port') . ' - ' . __('lang.is_required'),
            'category_meta_10.required' => __('lang.encryption') . ' - ' . __('lang.is_required'),
            'category_meta_11.required' => __('lang.action_after_fetching_email') . ' - ' . __('lang.is_required'),
        ];
    }

    /**
     * Validate the request
     * @return array
     */
    public function rules() {

        $rules = [];

        /**-------------------------------------------------------
         * common rules for both [create] and [update] requests
         * ------------------------------------------------------*/
        if (request('category_email_integration') == 'enabled' || request()->segment(4) == 'test') {
            $rules += [
                'category_meta_5' => [
                    'required',
                ],
                'category_meta_6' => [
                    'required',
                ],
                'category_meta_7' => [
                    'required',
                ],
                'category_meta_8' => [
                    'required',
                ],
                'category_meta_9' => [
                    'required',
                ],
                'category_meta_10' => [
                    'required',
                ],
                'category_meta_11' => [
                    'required',
                ],
            ];
        }

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
