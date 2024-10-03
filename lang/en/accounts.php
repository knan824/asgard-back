<?php

return [

    'store' => 'Account stored successfully',
    'delete' => 'Account deleted successfully',
    'update' => 'Account updated successfully',

    'attributes' => [
    'psn_email' => 'PlayStation Network email',
    'password' => 'PlayStation Network password',
    'platform' => 'Playstation platform',
    'image' => 'Account image',
    'is_primary' => 'Primary Playstation Account status',
    'is_sold' => 'Account is sold status',
    ],

    'errors' => [
    'primary_account_max_platforms' => 'A primary account can have a maximum of two platforms.',
    'secondary_account_max_platforms' => 'A secondary account can have a maximum of one platform.',
    ],
];
