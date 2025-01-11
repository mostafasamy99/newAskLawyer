<?php

return [
    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS'),  
        'auto_discovery' => true,
    ],
    'database' => [
        'url' => env('FIREBASE_DATABASE_URL'),  
    ],
    'dynamic_links' => [
        'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN')  
    ],
    'storage' => [
        'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET'),  
    ],
    'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),  
];
