<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Admin';
$this->params['breadcrumbs'][] = "Админ панель";
?>
<div class="site-about">

    <?= Html::a('<div class="admin-card">
<div class="admin-card-header">Фотосеты</div>
<div class="admin-card-info">Посмотреть таблицу фотосетов</div>
 </div>', '/catalog-level/index') ?>

    <?= Html::a('<div class="admin-card">
<div class="admin-card-header">Товары</div>
<div class="admin-card-info">Посмотреть таблицу товаров</div>
 </div>', '/product/index') ?>

    <?= Html::a('<div class="admin-card">
<div class="admin-card-header">Параметры</div>
<div class="admin-card-info">Посмотреть таблицу параметров</div>
 </div>', '/products-params/index') ?>


</div>
