<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /* Менеджер адресов общего характера */
        'urlManager' => [
        	'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => '',
                    'route' => 'site/index',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'about',
                    'route' => 'site/about',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'login',
                    'route' => 'site/login',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'contact',
                    'route' => 'site/contact',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'найти-<search:\w*>-<year:\d{4}>',
                    'route' => 'main/search',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => 'найти-<search:\w*>',
                    'route' => 'main/search',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => 'serials/<id:\d+>',
                    'route' => 'serials/view',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'serials',
                    'route' => 'serials/index',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'release/<id:\d+>/season/<season:\d+>/episode/<episode:\d+>',
                    'route' => 'episode/view',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'release/<id:\d+>/season/<season:\d+>',
                    'route' => 'release/view',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'release/<id:\d+>',
                    'route' => 'release/view',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'release/<id:\d+>',
                    'route' => 'release/index',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'release',
                    'route' => 'release/index',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<controller>/<action>/<id:\d+>',
                    'route' => '<controller>/<action>',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<controller>/<action>',
                    'route' => '<controller>/<action>',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => '<module>/<controller>/<action>/<id:\d+>',
                    'route' => '<module>/<controller>/<action>',
                    'suffix' => ''
                ],
                [
                    'pattern' => '<module>/<controller>/<action>',
                    'route' => '<module>/<controller>/<action>',
                    'suffix' => '.html'
                ],
            ]
        ],
        /* */
    ],
];
