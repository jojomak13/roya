<?php

return [
    'role_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'stores' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'dashboard' => 'r',
            'permissions' => 'r',
        ],
        'supplier' => [],
        'casher' => [],
        'user' => [],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
