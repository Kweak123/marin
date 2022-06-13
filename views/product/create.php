<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\product\Product */
/* @var $param app\models\product\ProductParamsLib */
/* @var $assoc app\models\product\ProductParamsAssoc*/

$this->title = 'Добавить товар';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'param' => $param,
        'assoc' => $assoc,
    ]) ?>

</div>
