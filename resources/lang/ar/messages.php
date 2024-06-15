<?php

return [
    "content" => [
        "group" => "المحتوي",
        "posts" => [
            "title" => "المقالات",
            "single" => "المقالة",
            "sections" => [
                "post" => [
                    "title" => "تفاصيل المقالة",
                    "description" => "إنشاء مقالة جديدة",
                    "columns" => [
                        "title" => "العنوان",
                        "slug" => "الرابط المختصر",
                        "body" => "المحتوي",
                    ]
                ],
                "seo" => [
                    "title" => "تحسين محركات البحث",
                    "description" => "إعدادات تحسين محركات البحث",
                    "columns" => [
                        "short_description" => "الوصف المختصر",
                        "keywords" => "الكلمات الدلالية",
                    ]
                ],
                "meta" => [
                    "title" => "ميتا",
                    "description" => "إعدادات ميتا",
                    "columns" => [
                        "meta_url" => "رابط ميتا",
                        "meta" => "ميتا",
                        "meta_redirect" => "إعادة توجيه ميتا",
                    ]
                ],
                "images" => [
                    "title" => "الصور",
                    "description" => "إعدادات الصور",
                    "columns" => [
                        "feature_image" => "صورة مميزة",
                        "cover_image" => "صورة الغلاف",
                    ]
                ],
                "author" => [
                    "title" => "الكاتب",
                    "description" => "إعدادات الكاتب",
                    "columns" => [
                        "author_type" => "نوع الكاتب",
                        "author" => "الكاتب",
                    ]
                ],
                "status" => [
                    "title" => "الحالة",
                    "description" => "إعدادات الحالة",
                    "columns" => [
                        "type" => "النوع",
                        "is_published" => "تم النشر",
                        "is_trend" => "متصدر",
                        "published_at" => "تاريخ النشر",
                        "likes" => "الإعجابات",
                        "views" => "المشاهدات",
                        "categories" => "التصنيفات",
                        "tags" => "الوسوم",
                    ]
                ],
            ]
        ],
        "category" => [
            "title" => "التصنيفات",
            "single" => "التصنيف",
            "sections" => [
                "details" => [
                    "title" => "تفاصيل التصنيف",
                    "description" => "إنشاء تصنيف جديد",
                    "columns" => [
                        "name" => "الاسم",
                        "slug" => "الرابط المختصر",
                        "description" => "الوصف",
                        "icon" => "الأيقونة",
                        "color" => "اللون",
                    ]
                ],
                "status" => [
                    "title" => "الحالة",
                    "description" => "إعدادات الحالة",
                    "columns" => [
                        "parent_id" => "الأب",
                        "type" => "النوع",
                        "for" => "لـ",
                        "is_active" => "نشط",
                        "show_in_menu" => "إظهار في القائمة",
                    ]
                ]
            ]
        ],
        "comments" => [
            "title" => "التعليقات",
            "single" => "تعليق",
            "columns" => [
                "user_type" => "نوع المستخدم",
                "user_id" => "المستخدم",
                "content_id" => "معرف المحتوى",
                "content_type" => "نوع المحتوى",
                "comment" => "التعليق",
                "rate" => "التقييم",
                "is_active" => "نشط",
                "created_at" => "تاريخ الإنشاء",
                "updated_at" => "تاريخ التحديث",
            ]
        ]
    ],
    "types" => [
        'post' => 'مقالة',
        'video' => 'فيديو',
        'audio' => 'صوت',
        'gallary' => 'معرض',
        'link' => 'رابط',
        'open-source' => 'مصدر مفتوح',
        'info' => 'معلومات',
        'event' => 'حدث',
        'quote' => 'اقتباس',
        'default' => 'غير معروف',
        'category' => 'تصنيف',
        'tags' => 'وسوم',
        'skill' => 'مهارة',
        'testimonials' => 'شهادات',
        'feature' => 'ميزة',
        'page' => 'صفحة',
        'builder' => 'بناء',
        'service' => 'خدمة',
        'portfolio' => 'محفظة',
        'faq' => 'أسئلة مكررة',
    ]
];
