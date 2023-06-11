<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface;

use Illuminate\Foundation\Http\FormRequest;

class OwnershipFormRequest extends FormRequest {

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        /**
         * @TODO implement authorization
         * see https://laracasts.com/discuss/channels/laravel/authorization-in-form-request-objects?page=1
         */

        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'pk' => [
                'required',
                [
                    'regex' => '/^[\w]+\:(.*)$/'
                ]
            ],
            'name' => 'required|in:users,groups'
        ];
    }

}
