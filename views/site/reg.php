<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\RegForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<div class="login-page">
    <div class="form">
        <h2>Регистрация</h2>
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
            <?= $form->field($model, 'email')->textInput()->input('email', ['placeholder' => 'Почта'])->label('') ?>
            <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => 'Пароль'])->label('') ?>
            <?= $form->field($model, 'password_repeat')->passwordInput()->input('password', ['placeholder' => 'Повтор пароля'])->label('') ?>
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>


