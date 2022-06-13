<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\product\Product */
/* @var $param app\models\product\ProductParamsLib */
/* @var $assoc app\models\product\ProductParamsAssoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'photo')->fileInput() ?>

    <?php
    $param_arr = $param::find()
        ->leftJoin('product_params_genesis', 'product_params_genesis.Id = product_params_lib.genesis')
        ->asArray()->all();

    $params_array =  \yii\helpers\ArrayHelper::index($param_arr, 'Id','genesis' );
    foreach ($params_array as $value){
        $item = \yii\helpers\ArrayHelper::map($value, 'Id', 'params');
        $options = [
            'prompt' => 'Выберите фильтр...'
        ];

        echo $form->field($assoc, 'Param_Id')->dropDownList($item, $options);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>



    <?php ActiveForm::end(); ?>

</div>
