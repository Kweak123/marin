<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фотосеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset($_GET['lvl'])){
            echo Html::a('Создать фотосет', ['create?lvl='.$_GET['lvl']], ['class' => 'btn btn-success']);
        }
        else{
            echo Html::a('Создать фотосет', ['create'], ['class' => 'btn btn-success']);
        }?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'label',
            'photo_preview',
            'price',
            [
                'label' => 'Добавить Фото',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        'Добавить',
                        "/photo/index?id={$data->Id}"
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
