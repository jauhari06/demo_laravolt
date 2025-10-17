<?php

return [

    'Content Management' => [
        'order' => 10, 
        'menu' => [
            'Home' => [
                'route' => 'topics.index',
                'active' => 'topics/*',
                'icon' => 'tags', 
            ],
            'Manajemen Berita' => [
                'route' => 'news.index',
                'active' => 'news/*',
                'icon' => 'newspaper', 
            ],
            'Manajemen Topik' => [
                'route' => 'topics.index',       // route yang sudah kita buat
                'active' => 'topics/*',          // agar menu aktif saat di halaman /topics/*
                'icon' => 'tags',                // ikon tags cocok untuk topik
            ],
        ],
    ],
    
    'System' => [
        'order' => 99,
        'menu' => [
            'Users' => [
                'route' => 'epicentrum::users.index',
                'active' => 'epicentrum/users/*',
                'icon' => 'user-friends',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_USER],
            ],
            'Roles' => [
                'route' => 'epicentrum::roles.index',
                'config' => 'epicentrum/roles/*',
                'icon' => 'user-astronaut',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_ROLE],
            ],
            'Permissions' => [
                'route' => 'epicentrum::permissions.edit',
                'active' => 'epicentrum/permissions/*',
                'icon' => 'shield-check',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_PERMISSION],
            ],
            'Settings' => [
                'route' => 'platform::settings.edit',
                'active' => 'platform/settings/*',
                'icon' => 'sliders-v',
                'permissions' => [\Laravolt\Platform\Enums\Permission::MANAGE_SETTINGS],
            ],
        ],
    ],
];
