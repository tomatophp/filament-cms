<?php

return [
    /*
     * ---------------------------------------------------
     * Allow Features
     * ---------------------------------------------------
     */
    "features" => [
        "category" => true,
        "posts" => true,
        "comments" => true,
        "theme-manager" => false,
        "forms" => false,
        "form_requests" => false,
        "tickets" => false,
        "apis" => false,
    ],

    /*
     * ---------------------------------------------------
     * Youtube Integration For Posts Meta
     * ---------------------------------------------------
     */
    "youtube_key" => env('YOUTUBE_KEY', null),

    /*
     * ---------------------------------------------------
     * Supported Lanuages For Content
     * ---------------------------------------------------
     */
    "lang" => [
        "en" => "English",
        "ar" => "Arabic"
    ],


    "themes" => [
        "scan" => true,
        "sections" => [
            "/vendor/tomatophp/filament-cms/src/Sections"
        ]
    ],

    /*
     * ---------------------------------------------------
     * Legacy Splade Page Builder Routes (admin/pages/{model}/*)
     * ---------------------------------------------------
     * Off by default. When enabled, every request needs a
     * registered Post policy that allows `update`.
     */
    "builder_routes" => [
        "enabled" => env('FILAMENT_CMS_BUILDER_ROUTES', false),
        "middleware" => ['web', 'auth', \ProtoneMedia\Splade\Http\SpladeMiddleware::class],
    ],
];
