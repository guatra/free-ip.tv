<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'forceTranslation' => true,
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            // 'db' => 'mydb',  // ID компонента для взаимодействия с БД. По умолчанию 'db'.
            // 'sessionTable' => 'my_session', // название таблицы для хранения данных сессии. По умолчанию 'session'.
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
                    'pattern' => 'gii',
                    'route' => 'gii/index',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'rss',
                    'route' => 'site/rss',
                    'suffix' => '.html'
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
//                [
//                    'pattern' => 'search/<q:\w*>',
//                    'route' => 'site/search',
//                    'suffix' => ''
//                ],
                [
                    'pattern' => 'series/<id:\d+>',
                    'route' => 'series/view',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'series',
                    'route' => 'series/index',
                    'suffix' => ''
                ],
                //
                [
                    'pattern' => 'movies/<id:\d+>',
                    'route' => 'movies/view',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'movies',
                    'route' => 'movies/index',
                    'suffix' => ''
                ],
                // просмотр страницы видео файла
                [
                    'pattern' => 'release/<id:\d+>/season/<season:\d+>/episode/<episode:\d+>',
                    'route' => 'episode/view',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'release/<id:\d+>/season/<season:\d+>',
                    'route' => 'release/index',
                    'suffix' => ''
                ],
//                [
//                    'pattern' => 'release/<alias:\w*>',
//                    'route' => 'release/index',
//                    'suffix' => ''
//                ],
                [
                    'pattern' => 'release/<id:\d+>',
                    'route' => 'release/view',
                    'suffix' => ''
                ],
                [
                    'pattern' => 'tv/<action>',
                    'route' => 'tv/<action>',
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
