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
        foreach (static::credentialOptions($account, $password) as $credentials) {
            if (Auth::attempt($credentials, $remember)) {
                return true;
            }
        }

        return false;
    }

    public static function credentials(string $account, string $password): array
    {
        return static::credentialOptions($account, $password)[0];
    }

    public static function credentialOptions(string $account, string $password): array
    {
        $field = filter_var($account, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_card';

        if ($field === 'no_card' && ! Schema::hasColumn('users', 'no_card')) {
            $field = 'email';
        }

        $fields = [$field];

        if (str_contains($account, '@')) {
            array_unshift($fields, 'email');
        }

        if (Schema::hasColumn('users', 'no_card')) {
            $fields[] = 'no_card';
        }

        $fields[] = 'email';
        $fields = array_values(array_unique($fields));

        return array_map(fn (string $field): array => [
            $field => $account,
            'password' => $password,
        ], $fields);
    }
}
