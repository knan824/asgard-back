<?php

return [
    'store' => 'Account stored successfully',
    'destroy' => 'Account deleted successfully',
    'update' => 'Account updated successfully',

    'attributes' => [
        'psn_email' => 'playStation network email',
        'password' => 'playStation network password',
        'platforms' => 'playstation platform',
        'platform' => 'playstation platform',
        'image' => 'account image',
        'is_primary' => 'primary playstation account status',
        'is_sold' => 'account is sold status',
    ],

    'errors' => [
        'primary_account_max_platforms' => 'A primary account can have a maximum of two platforms.',
        'secondary_account_max_platforms' => 'A secondary account can have a maximum of one platform.',
        'account_sold' => "Can't update your account when it is rented.",
    ],
];
