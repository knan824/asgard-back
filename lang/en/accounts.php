<?php

return [
    'store' => 'Account stored successfully',
    'destroy' => 'Account deleted successfully',
    'update' => 'Account updated successfully',

    'attributes' => [
        'psn_email' => 'playStation Network email',
        'password' => 'playStation Network password',
        'platform' => 'playstation platform',
        'platform_exists' => 'playstation platform',
        'image' => 'account image',
        'is_primary' => 'primary Playstation Account status',
        'is_sold' => 'account is sold status',
    ],

    'errors' => [
        'primary_account_max_platforms' => 'A primary account can have a maximum of two platforms.',
        'secondary_account_max_platforms' => 'A secondary account can have a maximum of one platform.',
    ],
];
