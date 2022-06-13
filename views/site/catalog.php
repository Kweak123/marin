<?php

/** @var yii\web\View $this */

/* @var $search app\models\ProductsCatalog */
/* @var $product app\models\product\Product */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $lib app\models\product\ProductParamsLib */


use yii\widgets\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\grid\ActionColumn;


$this->title = 'catalog';
?>
<div class="site-catalog">

    <div class="container params-list">
        <div class="params-block">
            <?php
            $form = ActiveForm::begin(['method' => 'get', 'fieldConfig' => [

                'template' => "{label}\n{input}\n{error}",
                'errorOptions' => ['class' => 'd-none'],
            ]]);

            $params_array = $search->Params();
            foreach ($params_array as $genesis => $param) {

                $item = ArrayHelper::map($param, 'Id', 'params');
                foreach ($param as $key=>$value) {
                    $options = [
                        'prompt' => $param[$key]['label'],
                        'class' => 'params_dropdown'
                    ];
                    break;
                }
                echo Html::dropDownList($genesis, isset($_GET[$genesis]) ? ($_GET[$genesis]) : (0), $item, $options);
            } ?>
            <div class='btn-param-block'><?= Html::submitButton('Показать', ['class' => 'btn btn-primary paramBtn', 'name' => 'view']) ?></div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


    <?php Pjax::begin(['enablePushState' => false, 'timeout' => 5000]); ?>
    <?php $form = ActiveForm::begin(['method' => 'post']); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => [
            'tag' => 'div',
        ],
        'layout' => '{pager}<div class="container prod-render-fild">{items}</div>{pager}',
        'pager' => ['class' => \yii\bootstrap4\LinkPager::class],
        'itemView' => function ($model, $key, $index, $widget) {
            return
                "<div class='product-cart'>" .
                "<img class='prod-img' src='../images/product/1/{$model->photo}'>" .
                "<div class='product-cart-titles'>" .
                "<p style='text-align: center'>{$model->title}</p>" .
                "<p style='text-align: center; min-height: 5rem'>{$model->discription}</p>" .
                "<p>{$model->price} руб</p>" .
                Html::submitButton('Купить', ['class' => 'btn btn-primary', 'name' => 'buy', 'value' => $model->Id, 'style' => 'margin: auto;']) .
                "</div>" .
                "</div>";
        }
    ]); ?>

    <?php ActiveForm::end() ?>
    <?php Pjax::end(); ?>

</div>
