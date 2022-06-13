<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Каталог уровней';
?>
<div class="catalog-level-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать уровень', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'label',
            'description:ntext',
            'price',
            [
                'label' => 'Добавить Фото',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        'Добавить',
                        "/catalog/index?lvl={$data->Id}"
                    );
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Id' => $model->Id]);
                 }
            ],
        ],
    ]); ?>


</div>
