<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'America/Mexico_City',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '3iXse-YEOVNGFOPdpz8Lv3Y3Wn1nc3Ne',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailtrap.io',
                'username' => '5d3ecdfae224b6',
                'password' => '00a421541afa62',
                'port' => '2525',
                'encryption' => 'tls',
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@app/runtime/logs/eauth.log',
                    'categories' => ['nodge\eauth\*'],
                    'logVars' => [],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login/<service:google|facebook|etc>' => 'site/login',
            ],
        ],
        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'httpClient' => [
                // uncomment this to use streams in safe_mode
                //'useStreamsFallback' => true,
            ],
//            'tokenStorage' => [
//                'class' => '@app\eauth\DatabaseTokenStorage'
//            ],
            'services' => [ // You can change the providers and their classes.
//                'google' => [
//                    // register your app here: https://code.google.com/apis/console/
//                    'class' => 'nodge\eauth\services\GoogleOAuth2Service',
//                    'clientId' => '35609626707-ges8c4985ulj0gsijbi840kgftmlhmdb.apps.googleusercontent.com',
//                    'clientSecret' => 'QsMYxXN9hgdvjqp77NRJEoS-',
//                    'title' => 'Google',
//                ],
//                'twitter' => [
//                    // register your app here: https://dev.twitter.com/apps/new
//                    'class' => 'nodge\eauth\services\TwitterOAuth1Service',
//                    'key' => '...',
//                    'secret' => '...',
//                ],
//                'yandex' => [
//                    // register your app here: https://oauth.yandex.ru/client/my
//                    'class' => 'nodge\eauth\services\YandexOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'title' => 'Yandex',
//                ],
//                'facebook' => [
//                    // register your app here: https://developers.facebook.com/apps/
//                    'class' => 'nodge\eauth\services\FacebookOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'yahoo' => [
//                    'class' => 'nodge\eauth\services\YahooOpenIDService',
//                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
//                ],
//                'linkedin' => [
//                    // register your app here: https://www.linkedin.com/secure/developer
//                    'class' => 'nodge\eauth\services\LinkedinOAuth1Service',
//                    'key' => '...',
//                    'secret' => '...',
//                    'title' => 'LinkedIn (OAuth1)',
//                ],
//                'linkedin_oauth2' => [
//                    // register your app here: https://www.linkedin.com/secure/developer
//                    'class' => 'nodge\eauth\services\LinkedinOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'title' => 'LinkedIn (OAuth2)',
//                ],
//                'github' => [
//                    // register your app here: https://github.com/settings/applications
//                    'class' => 'nodge\eauth\services\GitHubOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'live' => [
//                    // register your app here: https://account.live.com/developers/applications/index
//                    'class' => 'nodge\eauth\services\LiveOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'steam' => [
//                    'class' => 'nodge\eauth\services\SteamOpenIDService',
//                    //'realm' => '*.example.org', // your domain, can be with wildcard to authenticate on subdomains.
//                    'apiKey' => '...', // Optional. You can get it here: https://steamcommunity.com/dev/apikey
//                ],
//                'instagram' => [
//                    // register your app here: https://instagram.com/developer/register/
//                    'class' => 'nodge\eauth\services\InstagramOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'vkontakte' => [
//                    // register your app here: https://vk.com/editapp?act=create&site=1
//                    'class' => 'nodge\eauth\services\VKontakteOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'mailru' => [
//                    // register your app here: http://api.mail.ru/sites/my/add
//                    'class' => 'nodge\eauth\services\MailruOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                ],
//                'odnoklassniki' => [
//                    // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
//                    // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
//                    'class' => 'nodge\eauth\services\OdnoklassnikiOAuth2Service',
//                    'clientId' => '...',
//                    'clientSecret' => '...',
//                    'clientPublic' => '...',
//                    'title' => 'Odnoklas.',
//                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
