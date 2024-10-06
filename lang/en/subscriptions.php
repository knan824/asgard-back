<?php

return [
    'store' => 'Subscription stored successfully',
    'destroy' => 'Subscription deleted successfully',
    'update' => 'Subscription updated successfully',

    'attributes' => [
        'name' => 'subscription name',
        'price' => 'subscription price',
        'image' => 'subscription image',
    ],

    'errors' => [
        'destroy_failed' => 'Subscription could not be deleted as users are subscribed to it',
    ],
];
