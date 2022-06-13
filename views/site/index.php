<?php

/** @var yii\web\View $this */
/** @var app\models\Catalog $catalog */
/** @var app\models\CatalogLevel $level */
/** @var app\models\CatalogPhotoBlur $blur */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Marin';
$levels_array = $level->showAllLevels();
?>
<div class="site-index">

    <div class="container d-flex justify-content-center lvl-container">
        <?php foreach ($levels_array as $value): ?>
            <a href="?lvl=<?=$value['Id']?>"><button class="btn-primary btn"><?=$value['label']?></button></a>
        <?php endforeach;?>
    </div>
    <?php ActiveForm::begin()?>
    <div class="" style="display: flex; justify-content: center; flex-wrap: wrap">
        <?php if(!isset($_GET['lvl'])){
            $catalog_array = $blur->showAllCatalogs();
            foreach ($catalog_array as $value){ ?>

            <div class="lvl-card" style="background-image: url('../images/<?=$value['photo_directory']?>/<?=$value['photo']?>')">
            </div>


        <?php }
        } else{
            $catalog_array = $blur->showLVLCatalogs($_GET['lvl']);
            foreach ($catalog_array as $value){ ?>

                <div class="lvl-card" style="background-image: url('../images/<?=$value['photo_directory']?>/<?=$value['photo']?>')">
                </div>

        <?php }
        }?>

        <?php
        if(isset($_GET['lvl'])){
            echo !Yii::$app->user->isGuest ? (
            Html::submitButton("Купить Уровень-{$_GET['lvl']}", ['class'=>'buyBtn w-100', 'name' => 'buy-lvl', 'value' => $_GET['lvl']])
            ) : "Для оформления подписки вам нужно зарегистрироваться";
        }
            ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
