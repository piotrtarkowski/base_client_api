<?php

use BaseClientApi\Controller\MainController;

return [
    'main_index' => [
        'route' => '/api/list',
        'controller' => MainController::class,
        'action' => 'index',
    ],
    'main_new' => [
        'route' => '/api/new',
        'controller' => MainController::class,
        'action' => 'new',
    ],
    'main_edit' => [
        'route' => '/api/edit/{id}',
        'controller' => MainController::class,
        'action' => 'edit',
        'constraints' => [
            'id' => '\d+'
        ]
    ],
    'main_delete' => [
        'route' => '/api/delete/{id}',
        'controller' => MainController::class,
        'action' => 'delete',
        'constraints' => [
            'id' => '\d+'
        ]
    ],
];