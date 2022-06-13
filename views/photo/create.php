<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogPhoto */

$this->title = 'Добавить фотографий';
$this->params['breadcrumbs'][] = ['label' => 'Каталог фото', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
