<?php

use Carbon\Carbon;

return [
    'exp' => [
        'ttl' => Carbon::now()->addMinutes(1000)->timestamp,
        'refresh_ttl' => Carbon::now()->addMinutes(1000000)->timestamp,
    ]
];


/**
 * readable:store , product , anything
 * 
 * readable_id
 * readable_type
 * 
 * user:customers , super_admin , any user
 * 
 * user_id
 * user_type
 * 
 */