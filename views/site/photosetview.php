<?php


/** @var yii\web\View $this */
/** @var \app\models\CatalogPhoto $photo */
/** @var \app\models\Catalog $catalog */
/** @var \app\models\CatalogLevel $level */

use yii\helpers\Html;


?>
<div class="site-preview">
    <?php if(!isset($_GET['lvl'])){
            $photo_array = $photo->showBuyCatalogesPhoto($_GET['cat']);
            $direct = $catalog->getDir($_GET['cat']);
            foreach ($photo_array as $value){ ?>

                <div class="ctlg-cart">
                    <img class="ctlg-photo" src="../images/<?=$direct[0]['photo_directory'] ?>/<?=$value['photo']?>" alt="photo">
                </div>

            <?php }
    }?>
</div>
