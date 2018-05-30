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
    
    'channels' => [
        'local' => [
            'ip' => '127.0.0.1',
            'port' => 22,
            'username' => 'vagrant',
            'hostkey' => 'ssh-rsa',
            'path' => 'Code',
            'password' => 'vagrant' // Optinal
        ],
    ],

    'ssh_paths' => [
        'private' => '~/.ssh/id_rsa',
        'public' => '~/.ssh/id_rsa.pub',
    ],
];
