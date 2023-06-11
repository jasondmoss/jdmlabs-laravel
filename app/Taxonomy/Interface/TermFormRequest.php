<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface;

use App\Taxonomy\Infrastructure\Term;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class TermFormRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
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
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        /**
         * Modify the uniqueness rule on update to exclude the current model's
         * database row from the duplicates check.
         */
        $rules = $validator->getRules();
        $rules['name'] = [
            'required',
            'max:80',
        ];

        /**
         * Need Validation rule to enforce that name is unique for a given
         * vocabulary_id is unique.
         */
        if ($this->method() == 'POST') {
            $rules['name'][] = Rule::unique('terms', 'name')
                ->where('vocabulary_id', $this->input('vocabulary_id'));
        }

        if ($this->method() == 'PUT') {
            $rules['name'][] = Rule::unique('terms', 'name')
                ->where('vocabulary_id', $this->input('vocabulary_id'))
                ->ignore($this->input('id'));
        }

        $validator->setRules($rules);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return Term::$rules;
    }

}
