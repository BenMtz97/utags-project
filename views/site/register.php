<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
/* @var $countries Array */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\base\Model;

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'form-control email']) ?>

    <?= $form->field($model, 'phone')->textInput(['autofocus' => true, 'class' => 'form-control phone']) ?>


    <?= $form->field($model, 'birth')->textInput(['autofocus' => true, 'class' => 'form-control datepicker']) ?>

    <?=$form->field($model,'country')->dropDownList($countries) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'registration-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
