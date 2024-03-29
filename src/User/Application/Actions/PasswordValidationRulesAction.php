<?php

declare(strict_types=1);

namespace Aenginus\User\Application\Actions;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRulesAction
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    private function passwordRules(): array
    {
        return ['required', 'string', new Password(), 'confirmed'];
    }
}
