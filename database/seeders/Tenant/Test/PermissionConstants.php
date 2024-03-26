<?php

class PermissionConstants
{
    public static $ALL_ACTIONS = [
        'a' => 'add',
        'v' => 'view',
        'u' => 'update',
        'd' => 'delete',
    ];

    public static $GROUP_TO_ACTIONS = [
        'user' => ['a', 'v', 'u','d'],
    ];

    public static $GROUP_TO_PERMISSIONS = [
        'reports' => [
            'activity log report',
        ]
    ];
}
