<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class Login extends User
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'no_card',
        'password',
    ];

    public static function attempt(string $account, string $password, bool $remember = false): bool
    {
        return Auth::attempt(static::credentials($account, $password), $remember);
    }

    public static function credentials(string $account, string $password): array
    {
        $field = filter_var($account, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_card';

        if ($field === 'no_card' && ! Schema::hasColumn('users', 'no_card')) {
            $field = 'email';
        }

        return [
            $field => $account,
            'password' => $password,
        ];
    }
}
