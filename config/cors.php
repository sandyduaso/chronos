<?php

return [
    'supportsCredentials' => false,
    'allowedOrigins' => '*',
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => 'Authorization, X-Requested-With, Origin, X-Auth-Token, XSRF-TOKEN, X-CSRF-Token, Content-type',
    'allowedMethods' => 'GET, POST, PUT, DELETE, OPTIONS',
    'exposedHeaders' => [],
    'maxAge' => 0,
];
