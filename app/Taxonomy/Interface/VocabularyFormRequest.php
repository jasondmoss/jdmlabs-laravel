<?php

declare(strict_types=1);

namespace App\Taxonomy\Interface;

use App\Taxonomy\Infrastructure\Vocabulary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class VocabularyFormRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
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
        if ($this->method() == 'PUT') {
            $rules = $validator->getRules();

            $rules['name'] = [
                'required',
                'max:80',
                Rule::unique('vocabularies', 'name')->ignore($this->input('id'))
            ];

            $validator->setRules($rules);
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return Vocabulary::$rules;
    }

}
