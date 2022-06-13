<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\product\ProductParamsLib */

$this->title = 'Добавление параметра каталога';
$this->params['breadcrumbs'][] = ['label' => 'Параметры каталога', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-params-lib-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>



</div>
