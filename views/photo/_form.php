<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogPhoto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-photo-form">



    <?php $form = ActiveForm::begin(); ?>

    <?php $catalog = \app\models\Catalog::find()->asArray()->all();
    $items = \yii\helpers\ArrayHelper::map($catalog, 'Id', 'label');
    $params = [
            'prompt' => 'Выберите каталог...'
    ];
    echo $form->field($model, 'category_id')->dropDownList($items,$params) ?>

    <?= $form->field($model, 'photo')->fileInput()->label('Фото') ?>


    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
