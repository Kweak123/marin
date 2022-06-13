<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "catalog".
 *
 * @property int $Id
 * @property string $label
 * @property string $photo_directory
 * @property string $photo_preview
 */
class Catalog extends \yii\db\ActiveRecord
{

    public $upladedfile;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'photo_directory', 'photo_preview', 'price'], 'required'],
            [['label', 'photo_directory', 'photo_preview'], 'string', 'max' => 255],
            ['price', 'integer'],
            ['upladedfile', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'label' => 'Название',
            'photo_directory' => 'Фото директория',
            'photo_preview' => 'Лицевое фото',
            'price' => 'Цена',
        ];
    }


    public function showAllCatalogs()
    {
        return static::find()->asArray()->all();
    }

    public function showLVLCatalogs($id)
    {
        return
            Catalog::find()
                ->leftJoin('catalog_level_assoc', 'catalog_level_assoc.catalog_id = catalog.Id')
                ->leftJoin('catalog_level', 'catalog_level.Id = catalog_level_assoc.level_id')
                ->where(['catalog_level_assoc.level_id'=>$id])
                ->asArray()->all();
    }

    public function showBuyAllCatalogs(){
        $session = Yii::$app->session;
        return static::find()
            ->leftJoin('catalog_level_assoc', 'catalog_level_assoc.catalog_id = catalog.Id')
            ->leftJoin('catalog_level', 'catalog_level.Id = catalog_level_assoc.level_id')
            ->leftJoin('user_buy_levels', 'catalog_level.Id = user_buy_levels.level_id')
            ->where(['user_buy_levels.user_id'=>$session['__id']])
            ->asArray()->all();
    }

    public function showBuyCatalogs($id){
        $session = Yii::$app->session;
        return
            Catalog::find()
                ->leftJoin('catalog_level_assoc', 'catalog_level_assoc.catalog_id = catalog.Id')
                ->leftJoin('catalog_level', 'catalog_level.Id = catalog_level_assoc.level_id')
                ->leftJoin('user_buy_levels', 'catalog_level.Id = user_buy_levels.level_id')
                ->andWhere(['catalog_level_assoc.level_id'=>$id, 'user_buy_levels.user_id'=>$session['__id']])
                ->asArray()->all();
    }

    public function getDir($id){
        return static::find()->select('photo_directory')->where(['Id'=>$id])->asArray()->all();
    }

}
