<?php

/** @var yii\web\View $this */
/* @var $model app\models\product\Product */
/* @var $modelBuy app\models\UserBuy */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$session = Yii::$app->session;
$buy_array = $session->get('buy');

if (isset($_POST['buy-delete-button'])) {
    $id = $_POST['buy-delete-button'];
    unset($buy_array[$id]);
    $session['buy'] = $buy_array;
}

if (isset($_POST['buy-update-button-q'])) {
    $buy_array[$_POST['buy-update-button-q']]['quantity'] = $_POST['quantity'];
    $session['buy'] = $buy_array;
}

if (isset($_POST['buy-update-button'])) {
    $buy_array[$_POST['buy-update-button']]['quantity'] = $session['buy'][$_POST['buy-update-button']]['quantity'] + 1;
    $session['buy'] = $buy_array;
}

if (isset($_POST['buy-remove-button'])) {
    $buy_array[$_POST['buy-remove-button']]['quantity'] = $session['buy'][$_POST['buy-remove-button']]['quantity'] - 1;
    $session['buy'] = $buy_array;
}

?>
<div class="site-busket">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($buy_array != null) { ?>
        <table class="basket-table">
            <?php foreach ($buy_array as $key => $x){
                $product = $modelBuy->getBuyProduct($key)?>
            <tr>

                <td class="prod-title" style="width: 150px"><?= yii\helpers\Html::a($product[0]['title'], ["site/productview", 'prod' => $key], ['class' => 'big-button']) ?></td>
                <td class="prod-price">:  <?= $product[0]['price'] ?>руб</td>
                <?= Html::input('hidden', 'hash', $session['hash']) ?>
                <td class="quantity-prod">
                    <?= Html::submitButton('<i class="minus">-</i>', ['class' => 'btn btn-link px-2', 'name' => 'buy-remove-button', 'value' => $key]); ?>
                    <?= Html::input('int', 'quantity', $x['quantity'] , Yii::$app->request->post('string'), ['class' => 'form-control quantity-prod', 'id' => $key]) ?>
                    <?= Html::submitButton('<i class="plus">+</i>', ['class' => 'btn btn-link px-2', 'name' => 'buy-update-button', 'value' => $key]); ?>
                </td>
                <td><?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'buy-update-button-q', 'value' => $key]); ?></td>
                <td><?= Html::submitButton('Удалить', ['class' => 'btn btn-primary', 'name' => 'buy-delete-button', 'value' => $key]); ?></td>

                <?php } ?>
            </tr>
        </table>

        <div>
            <p>Всего: <?= $modelBuy->getSum($session['buy']) ?>руб</p>

            <?= !Yii::$app->user->isGuest ?  ('<button class="btn btn-primary" type="submit" name="buy">Купить</button>') : ('<a href="login">Войти</a>')?>
        </div>
        <?php ActiveForm::end(); ?>
        <?php
    }
    else{?>
        <h2>Корзина пуста</h2>

    <?php }?>
</div>
