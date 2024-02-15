<?php

return [
    'endpoint' => env('PROXY_ENDPOINT', null),
    'timeout' => env('PROXY_TIMEOUT', 10),
    'maxRetries' => env('PROXY_MAX_RETRIES', 3),
    'waitRetries' => env('PROXY_WAIT_RETRIES', 30000),
];
