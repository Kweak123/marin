<?php


/** @var yii\web\View $this */
/** @var \app\models\Catalog $catalog */
/** @var \app\models\CatalogLevel $level */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$levels_array = $level->showBuysLevels();
?>
<div class="site-index">

    <div class="container d-flex justify-content-center lvl-container">
        <?php foreach ($levels_array as $value): ?>
            <a href="?lvl=<?=$value['Id']?>"><button class="btn-primary btn"><?=$value['label']?></button></a>
        <?php endforeach;?>
    </div>
    <?php ActiveForm::begin()?>
    <div class="photoset-lvl-card" style="display: flex; justify-content: center">
        <?php if(!isset($_GET['lvl'])){
            $catalog_array = $catalog->showBuyAllCatalogs();
            foreach ($catalog_array as $value){ ?>
                <?= Html::a( '<div class="lvl-card2" style=\'background-image: url("../images/'.$value['photo_directory'].'/'.$value['photo_preview'].'")\'>
                </div>'
                    , "photosetview?cat={$value['Id']}", ['class' => ''])?>


            <?php }
        } else{
            $catalog_array = $catalog->showBuyCatalogs($_GET['lvl']);
            foreach ($catalog_array as $value){ ?>

                <div class="lvl-card" style="background-image: url('../images/<?=$value['photo_directory']?>/<?=$value['photo_preview']?>')">
                </div>

            <?php }
        }?>

    </div>
    <?php ActiveForm::end(); ?>
</div>
