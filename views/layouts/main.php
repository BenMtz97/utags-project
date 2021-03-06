<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-
datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-
datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $navItems=[
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Activities',
            'items' => [
                ['label' => 'Maps', 'url' => '/site/maps'],
            ]
        ],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];

    if(!Yii::$app->user->isGuest && Yii::$app->user->identity->type == 2){
        $navItems[1]['items'][] = ['label' => 'Gestion de Usuarios', 'url' => '/site/users-admin'];
    }

    if (Yii::$app->user->isGuest) {
        array_push($navItems, ['label' => 'Login', 'url' => ['/site/login']], ['label' => 'Sign Up', 'url' => ['/site/register']]);
    }
    else{
        array_push($navItems,'<li>'
            . Html::beginForm(['/site/logout'], 'post',['id' => 'logout'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>');
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Universidad Tecnologica de Aguascalientes - <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<script src="/js/site.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
