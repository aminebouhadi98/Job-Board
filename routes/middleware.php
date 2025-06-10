<?php

use App\Http\Middleware\EnsureUserIsCompany;

return [
    'company' => EnsureUserIsCompany::class,
];
