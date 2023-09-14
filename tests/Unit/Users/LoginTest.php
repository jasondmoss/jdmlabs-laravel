<?php

declare(strict_types=1);

namespace Tests\Unit\Users;

use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{

    /**
     * @return void
     */
    public function test_is_admin_login_working(): void
    {
        Auth::login(UserEloquentModel::where('email', 'jason@jdmlabs.com')->first());

        // check if user is logged in
        $this->assertTrue(Auth::check());
    }


    /**
     * @return void
     */
    public function test_is_admin_logout_working(): void
    {
        Auth::logout();

        // check if user is logged in
        $this->assertFalse(Auth::check());
    }

}
