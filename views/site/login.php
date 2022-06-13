<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<div class="login-page">
    <div class="form">
        <h2>Авторизация</h2>
        <?php $form = ActiveForm::begin([
            'id' => 'reg-form',
            'layout' => 'horizontal',
            'options' => ['class' => 'login-form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'reg-input'],
            ],
        ]); ?>
        <?= $form->field($model, 'login')->textInput(['autofocus' => true])->input('text', ['placeholder' => 'Логин'])->label('') ?>
        <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => 'Пароль'])->label('') ?>
        <?= Html::submitButton('Авторизация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>


