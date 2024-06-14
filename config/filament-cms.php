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
        "comments" => false,
        "forms" => false,
        "form_requests" => false,
        "tickets" => false,
        "apis" => false
    ],

    /*
     * ---------------------------------------------------
     * Behanace Integration For Portfolio Import
     * ---------------------------------------------------
     */
    "behance" => [
        "username" => null,
        "service_id" => null
    ],

    /*
     * ---------------------------------------------------
     * Youtube Integration For Posts Meta
     * ---------------------------------------------------
     */
    "youtube_key" => null,

    /*
     * ---------------------------------------------------
     * Supported Lanuages For Content
     * ---------------------------------------------------
     */
    "lang" => [
        "en" => "English",
        "ar" => "Arabic"
    ],
];
