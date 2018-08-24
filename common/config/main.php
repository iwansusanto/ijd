<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'admin' =>  [
            'class' => 'mdm\admin\Module',
        ],
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
//        'user' => [
////            'class' => 'mdm\admin\models\User', // uncomment before execute migration yii migrate --migrationPath=@yii/rbac/migrations
//            'identityClass' => 'mdm\admin\models\User',
//            'loginUrl' => ['admin/user/login'],
//        ],
//        'as access' => [
//            'class' => 'mdm\admin\components\AccessControl',
//            'allowActions' => [
//                'site/*',
////                'admin/*',
//            ]
//        ]
    ],
];


/*
 * Yii2-Admin -> https://www.yiiframework.com/wiki/848/installation-guide-yii-2-advanced-template-with-rbac-system
 * 
 */
