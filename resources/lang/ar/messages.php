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
                        "images" => "صور المعرض",
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
            ],
            "import" => [
                "button" => "استيراد من رابط",
                "youtube_type" => "استيراد من يوتيوب",
                "behance_type" => "استيراد من Behance",
                "github_type" => "استيراد من Github",
                "url" => "الرابط",
                "redirect_url" => "رابط التوجيه",
                "notifications" => [
                    "title" => "تم استيراد المقالة بنجاح",
                    "description" => "تم استيراد المقالة بنجاح",
                ],
                "youtube" => [
                    "notifications" => [
                        "title" => "تم استيراد الفيديو من يوتيوب",
                        "description" => "تم استيراد الفيديو بنجاح",
                        "view" => "عرض المقالة",
                        "failed_title" => "فشل استيراد الفيديو من يوتيوب",
                        "failed_description" => "فشل استيراد الفيديو",
                    ]
                ],
                "behance" => [
                    "notifications" => [
                        "title" => "تم استيراد المشروع من Behance",
                        "description" => "تم استيراد المشروع بنجاح",
                        "failed_title" => "فشل استيراد المشروع من Behance",
                        "failed_description" => "فشل استيراد المشروع",
                    ]
                ],
                "github" => [
                    "notifications" => [
                        "title" => "تم استيراد المشروع من Github",
                        "description" => "تم استيراد المشروع بنجاح",
                        "view" => "عرض المقالة",
                        "failed_title" => "فشل استيراد المشروع من Github",
                        "failed_description" => "فشل استيراد المشروع",
                    ]
                ]
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
    ],
    "themes" => [
        "title" => "القوالب",
        "single" => "القالب",
        "actions" => [
            "active" => "تفعيل",
            "disable" => "تعطيل",
        ],
        "notifications" => [
            "autoload" => [
                "title" => "فشل تحميل القالب",
                "body" => "فشل تحميل القالب",
            ],
            "enabled" => [
                "title" => "تم تفعيل القالب",
                "body" => "تم تفعيل القالب بنجاح",
            ],
            "disabled" => [
                "title" => "تم تعطيل القالب",
                "body" => "تم تعطيل القالب بنجاح",
            ],
            "deleted" => [
                "title" => "تم حذف القالب",
                "body" => "تم حذف القالب بنجاح",
            ],
        ],
    ],
    "forms" => [
        "section" => [
            "information" => "تفاصيل النموذج"
        ],
        "title" => "منشيء النماذج",
        "single" => "نموذج",
        "columns" => [
            "type" => "النوع",
            "method" => "الطريقة",
            "title" => "العنوان",
            "key" => "المفتاح",
            "description" => "الوصف",
            "endpoint" => "الرابط",
            "is_active" => "نشط",
        ],
        "fields" => [
            "title" => "الحقول",
            "single" => "حقل",
            "columns" => [
                "type" => "النوع",
                "name" => "الاسم",
                "group" => "المجموعة",
                "default" => "القيمة الافتراضية",
                "is_relation" => "علاقة",
                "relation_name" => "اسم العلاقة",
                "relation_column" => "عمود العلاقة",
                "sub_form" => "نموذج فرعي",
                "is_multi" => "متعدد",
                "has_options" => "لديه خيارات",
                "options" => "الخيارات",
                "label" => "التسمية",
                "value"=> "القيمة",
                "placeholder" => "النص البديل",
                "hint" => "تلميح",
                "is_required" => "مطلوب",
                "required_message" => "رسالة الخطأ",
                "has_validation" => "لديه تحقق",
                "validation" => "التحقق",
                "rule" => "القاعدة",
                "message" => "الرسالة",
            ],
            "tabs" => [
                "general" => "عام",
                "options" => "الخيارات",
                "validation" => "التحقق",
                "relation" => "العلاقة",
                "labels" => "التسميات",
            ],
            "actions" => [
                "preview" => "معاينة",
            ]
        ],
        "requests" => [
            "title" => "طلبات النموذج",
            "single" => "طلب",
            "columns" => [
                "status" => "الحالة",
                "description" => "الوصف",
                "time" => "الوقت",
                "date" => "التاريخ",
                "payload" => "الرسالة",
                "pending" => "قيد الانتظار",
                "processing" => "جاري المعالجة",
                "completed" => "تم الانتهاء",
                "cancelled" => "تم الإلغاء",

            ]
        ]
    ],
];
