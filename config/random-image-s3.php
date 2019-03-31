<?php

return [
    'uri' => env('RANDOM-IMAGE-URL', 'randomimage'),
    'chache-dir' =>  env('RANDOM-IMAGE-CACHE-DIR', 'randomimage_chache'),
    'chache-disk' => env('RANDOM-IMAGE-CACHE-DISK', 'local'),
    'iscache' => env('RANDOM-IMAGE-ISCACHE', true),
    'disk' => env('RANDOM-IMAGE-DISK', 's3'),
];
