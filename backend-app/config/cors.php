<?php


  return [
'paths' => ['*'], // أو ['api/*', 'sanctum/csrf-cookie', 'lesson']

'allowed_methods' => ['*'],

'allowed_origins' => ['http://localhost:3000'], // ✅ مهم جدًا

'allowed_headers' => ['*'],

'exposed_headers' => [],

'max_age' => 0,

'supports_credentials' => false,


];

