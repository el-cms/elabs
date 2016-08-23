<?php

define('STATUS_DRAFT', 0);
define('STATUS_PUBLISHED', 1);
define('STATUS_LOCKED', 2);
define('STATUS_DELETED', 3);
return ['cms' => [
        'siteName' => 'YourSite',
        'isRegistrationOpen' => true,
        'defaultRole' => 'author',
        'defaultUserStatus' => 0,
        'defaultUserPreferences' => [
            'showNSFW' => false,
            'defaultSiteLanguage' => 'eng',
            'defaultWritingLanguage' => 'eng',
            'defaultWritingLicense' => '1',
        ],
        'defaultLockedUser' => false,
        'defaultSeeNSFW' => false,
        'defaultMinPassLenght' => 8,
        'defaultMinUserNameLenght' => 6,
        'defaultSiteLang' => '', // Null for no specific lang.
        'escapeMarkdown' => true,
        'adminCVUrl' => '#',
    ]
];
