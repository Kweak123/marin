<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\product\ProductParamsLib */

$this->title = 'Update Product Params Lib: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Product Params Libs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-params-lib-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
