<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\product\ProductParamsLib */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-params-lib-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'params')->textInput(['maxlength' => true]) ?>

    <?php $genesis = \app\models\product\ProductParamsGenesis::find()->asArray()->all();
    $items = \yii\helpers\ArrayHelper::map($genesis, 'Id', 'label');
    $params = [
        'prompt' => 'Выберите категорию фильтра'
    ];
    echo $form->field($model, 'genesis')->dropDownList($items,$params) ?>
    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
