<?php
namespace AppTasks;

/**
 * Class Config
 * @package AppTasks
 */
class Config
{
    const ROUTES = [
        'account/login' => [
            'controller' => 'Account',
            'action'     => 'Login'
        ],
        'account/logout' => [
            'controller' => 'Account',
            'action'     => 'Logout'
        ],
        'task/create' => [
            'controller' => 'Task',
            'action'     => 'Create'
        ],
        'task/change' => [
            'controller' => 'Task',
            'action'     => 'Change'
        ],
        'index' => [
            'controller' => 'Main',
            'action'     => 'Index'
        ]
    ];

    const DB_PARAMS = [
        'host' => 'localhost',
        'dbname' => 'akorotkov_task',
        'username' => 'akorotkov_task',
        'password' => 'vGMesJp3'
    ];
}