<?php

use kartik\mpdf\Pdf;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
//    'modules' => [],
    'modules' => [
        'admin' =>  [
            'class' => 'mdm\admin\Module',
        ]
    ],
    'name'  =>  'Imbal Jasa Dosen',
    'components' => [
        // setup Krajee Pdf component
        'pdf' => [
            'class' => Pdf::className(),
            'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'destination' => Pdf::DEST_BROWSER,
//            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css'
            // refer settings section for all configuration options
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/views'
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue-light',
                ],
            ],
        ],
        'db'=>[
            'class'=>'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ijd',
            'username' => 'fatih',
            'password' => '1234',
            'charset' => 'utf8'            
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/*',
                'admin/*',
                // 'some-controller/some-action',
                // The actions listed here will be allowed to everyone including guests.
                // So, 'admin/*' should not appear here in the production, of course.
                // But in the earlier stages of your development, you may probably want to
                // add a lot of actions here until you finally completed setting up rbac,
                // otherwise you may not even take a first step.
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'class' => 'app\components\User', // extend User component
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            'class' => 'app\components\Session', // extend User component
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'formatter' => [
              'class' => 'app\components\isFormatter',
              'dateFormat' => 'php:l, d F Y',
              'defaultTimeZone' =>  'Asia/Jakarta'
//            'class' => 'yii\i18n\formatter',
//            'thousandSeparator' => '.',
//            'decimalSeparator' => ',',
//            'currencyCode' => 'Rp. ',
            
        ],
    ],
    'params' => $params,
];
