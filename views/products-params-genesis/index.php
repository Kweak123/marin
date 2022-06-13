<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\product\ProductParamsGenesisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Params Geneses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-params-genesis-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Params Genesis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'label',
            [
                'label' => 'Добавить Set',
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
