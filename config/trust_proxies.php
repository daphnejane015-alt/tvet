<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Trusted Proxies
    |--------------------------------------------------------------------------
    |
    | This array defines the proxies that are trusted by your application.
    | By default, the IP address of the current request is trusted. However,
    | you may want to trust the IPs of proxies that forward requests to your
    | application, such as load balancers or reverse proxies.
    |
    | You may also specify a wildcard "*" to trust all proxies.
    |
    */

    'proxies' => '*', // Trust all proxies (for development with ngrok, etc.)

    /*
    |--------------------------------------------------------------------------
    | Trusted Headers
    |--------------------------------------------------------------------------
    |
    | This array defines the headers that should be trusted by your application.
    | By default, Laravel trusts the X-Forwarded-For and X-Forwarded-Host headers.
    | You may want to trust additional headers depending on your proxy configuration.
    |
    */

    'headers' => [
        Illuminate\Http\Request::HEADER_X_FORWARDED_FOR,
        Illuminate\Http\Request::HEADER_X_FORWARDED_HOST,
        Illuminate\Http\Request::HEADER_X_FORWARDED_PORT,
        Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO,
        Illuminate\Http\Request::HEADER_X_FORWARDED_AWS_ELB,
    ],
];
