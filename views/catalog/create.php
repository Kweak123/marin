<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Catalog */
/* @var $blur app\models\CatalogPhotoBlur */

$this->title = 'Загрузить фотосет';
$this->params['breadcrumbs'][] = ['label' => 'Фотосеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'blur' => $blur,
    ]) ?>

</div>
