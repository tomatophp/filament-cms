<?php

return [
    "content" => [
        "group" => "Content",
        "posts" => [
            "title" => "Posts",
            "single" => "Post",
            "sections" => [
                "type" => [
                    "title" => "Type",
                    "description" => "Type settings",
                    "columns" => [
                        "type" => "Type",
                    ]
                ],
                "post" => [
                    "title" => "Post Details",
                    "description" => "Create a new post",
                    "columns" => [
                        "title" => "Title",
                        "slug" => "Slug",
                        "body" => "Body",
                    ]
                ],
                "seo" => [
                    "title" => "SEO",
                    "description" => "SEO settings",
                    "columns" => [
                        "short_description" => "Short Description",
                        "keywords" => "Keywords",
                    ]
                ],
                "meta" => [
                    "title" => "Meta",
                    "description" => "Meta settings",
                    "columns" => [
                        "meta_url" => "Meta URL",
                        "meta" => "Meta",
                        "meta_redirect" => "Meta Redirect",
                    ]
                ],
                "images" => [
                    "title" => "Images",
                    "description" => "Images settings",
                    "columns" => [
                        "images" => "Gallary Images",
                        "feature_image" => "Feature Image",
                        "cover_image" => "Cover Image",
                    ]
                ],
                "author" => [
                    "title" => "Author",
                    "description" => "Author settings",
                    "columns" => [
                        "author_type" => "Author Type",
                        "author" => "Author",
                    ]
                ],
                "status" => [
                    "title" => "Status",
                    "description" => "Status settings",
                    "columns" => [
                        "type" => "Type",
                        "is_published" => "Is Published",
                        "is_trend" => "Is Trending",
                        "published_at" => "Published At",
                        "likes" => "Likes",
                        "views" => "Views",
                        "categories" => "Categories",
                        "tags" => "Tags",
                    ]
                ]
            ],
            "import" => [
                "button" => "Import From URL",
                "youtube_type" => "Import From Youtube",
                "behance_type" => "Import From Behance",
                "github_type" => "Import From Github",
                "url" => "URL",
                "redirect_url" => "Redirect URL",
                "notifications" => [
                    "title" => "Imported Successfully",
                    "description" => "The post has been imported successfully",
                ],
                "youtube" => [
                    "notifications" => [
                        "title" => "Youtube Video Imported",
                        "description" => "The video has been imported successfully",
                        "view" => "View Post",
                        "failed_title" => "Youtube Video Import Failed",
                        "failed_description" => "The video import has failed",
                    ]
                ],
                "behance" => [
                    "notifications" => [
                        "title" => "Behance Project Imported",
                        "description" => "The project has been imported successfully",
                        "failed_title" => "Behance Project Import Failed",
                        "failed_description" => "The project import has failed",
                    ]
                ],
                "github" => [
                    "notifications" => [
                        "title" => "Github Repository Imported",
                        "description" => "The repository has been imported successfully",
                        "view" => "View Post",
                        "failed_title" => "Github Repository Import Failed",
                        "failed_description" => "The repository import has failed",
                    ]
                ]
            ]
        ],
        "category" => [
            "title" => "Categories",
            "single" => "Category",
            "sections" => [
                "details" => [
                    "title" => "Category Details",
                    "description" => "Create a new category",
                    "columns" => [
                        "name" => "Name",
                        "slug" => "Slug",
                        "description" => "Description",
                        "icon" => "Icon",
                        "color" => "Color",
                    ]
                ],
                "status" => [
                    "title" => "Status",
                    "description" => "Status settings",
                    "columns" => [
                        "parent_id" => "Parent",
                        "type" => "Type",
                        "for" => "For",
                        "is_active" => "Is Active",
                        "show_in_menu" => "Show In Menu",
                    ]
                ]
            ]
        ],
        "comments" => [
            "title" => "Comments",
            "single" => "Comment",
            "columns" => [
                "user_type" => "User Type",
                "user_id" => "User",
                "content_id" => "Content ID",
                "content_type" => "Content Type",
                "comment" => "Comment",
                "rate" => "Rate",
                "is_active" => "Is Active",
                "created_at" => "Created At",
                "updated_at" => "Updated At",
            ]
        ]
    ],
    "types" => [
        'post' => 'Post',
        'video' => 'Video',
        'audio' => 'Audio',
        'gallary' => 'Gallary',
        'link' => 'Link',
        'open-source' => 'Open Source',
        'info' => 'Info',
        'event' => 'Event',
        'quote' => 'Quote',
        'default' => 'Unknown',
        'category' => 'Category',
        'tags' => 'Tags',
        'skill' => 'Skill',
        'testimonials' => 'Testimonials',
        'feature' => 'Feature',
        'page' => 'Page',
        'faq' => 'FAQ',
        'builder' => 'Builder',
        'service' => 'Service',
        'portfolio' => 'Portfolio',
    ],
    "themes" => [
        "title" => "Themes",
        "single" => "Theme",
        "actions" => [
            "active" => "Active",
            "disable" => "Disable",
        ],
        "notifications" => [
            "autoload" => [
                "title" => "Autoload Error",
                "body" => "The theme autoload class does not exist",
            ],
            "enabled" => [
                "title" => "Theme Enabled",
                "body" => "The theme has been enabled successfully",
            ],
            "disabled" => [
                "title" => "Theme Disabled",
                "body" => "The theme has been disabled successfully",
            ],
            "deleted" => [
                "title" => "Theme Deleted",
                "body" => "The theme has been deleted successfully",
            ],
        ],
    ]
];
