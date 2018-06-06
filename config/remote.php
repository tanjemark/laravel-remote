<?php

/*
 * This file is part of Remote.
 *
 * (c) Tobias Anjemark <tobias.anjemark@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Server Aliases
    |--------------------------------------------------------------------------
    |
    | Here you may configure the server aliases for your application.
    |
    */
    'servers' => [
        'local' => [
            'ip' => '127.0.0.1',
            'port' => 22,
            'username' => 'vagrant',
            'path' => 'Code', // Optinal
            'password' => 'vagrant' // Optinal
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | SSH Paths
    |--------------------------------------------------------------------------
    |
    */
    'ssh_paths' => [
        'private' => '~/.ssh/id_rsa',
        'public' => '~/.ssh/id_rsa.pub',
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Tables
    |--------------------------------------------------------------------------
    |
    | Here you may define all tables that will exported.
    |
    */
    'tables' => [
        'users',
        'password_resets',
    ],

    /*
    |--------------------------------------------------------------------------
    | Fake Columns
    |--------------------------------------------------------------------------
    |
    | Here you may define all columns that will be faked.
    | (Faker\Generator)
    |
    */
    'fake' => [
        'users' => [
            'email' => 'email',
            'first_name' => 'firstName',
            'last_name' => 'lastName',
        ],
        'password_resets' => [
            'email' => 'email',
        ],
    ],
];
