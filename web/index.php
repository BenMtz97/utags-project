<?php
$server = $_SERVER['SERVER_NAME'];
if(strpos($server,'local') !== false || 1){
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}

defined('VERSION_CSS') or define('VERSION_CSS','1.0.1');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
