<?php

// Same status code but different meanings
define('STATUS_INACTIVE', 0); // Users
define('STATUS_DRAFT', 0); // Content
define('STATUS_ACTIVE', 1); // Users
define('STATUS_PUBLISHED', 1); // Content
define('STATUS_LOCKED', 2);
define('STATUS_DELETED', 3);

define('SFW_SAFE', 1);
define('SFW_UNSAFE', 0);

return ['cms' => [
        'siteName' => 'YourSite',
        'isRegistrationOpen' => true,
        'defaultRole' => 'author',
        'defaultUserStatus' => 0,
        'defaultUserPreferences' => [
            'showNSFW' => '0',
            'defaultSiteLanguage' => '',
            'defaultWritingLanguage' => 'eng',
            'defaultWritingLicense' => '1',
        ],
        'defaultLockedUser' => false,
        'defaultSeeNSFW' => false,
        'defaultMinPassLenght' => 8,
        'defaultMinUserNameLenght' => 6,
        'defaultSiteLang' => '', // Null for no specific lang.
        'escapeMarkdown' => true,
        'useGravatarSecureUrls' => false,
        'maxRelatedData' =>6,
        'adminCVUrl' => '#',
    ]
];
