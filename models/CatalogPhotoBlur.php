<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog_photo_blur".
 *
 * @property int $Id
 * @property string $photo
 * @property int $catalog_id
 *
 * @property Catalog $catalog
 */
class CatalogPhotoBlur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog_photo_blur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo', 'catalog_id'], 'required'],
            [['catalog_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
            [['catalog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['catalog_id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'photo' => 'Photo',
            'catalog_id' => 'Catalog ID',
        ];
    }

    /**
     * Gets query for [[Catalog]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['Id' => 'catalog_id']);
    }

    public function showLVLCatalogs($id)
    {
        return $query = (new \yii\db\Query())
            ->select(['photo', 'catalog.photo_directory'])
            ->from('catalog_photo_blur')
            ->leftJoin('catalog', 'catalog.Id = catalog_photo_blur.catalog_id')
            ->leftJoin('catalog_level_assoc', 'catalog_level_assoc.catalog_id = catalog.Id')
            ->leftJoin('catalog_level', 'catalog_level.Id = catalog_level_assoc.level_id')
            ->where(['catalog_level_assoc.level_id'=>$id])
            ->all();
//        return
//            CatalogPhotoBlur::find()
//                ->leftJoin('catalog', 'catalog.Id = catalog_photo_blur.catalog_id')
//                ->leftJoin('catalog_level_assoc', 'catalog_level_assoc.catalog_id = catalog.Id')
//                ->leftJoin('catalog_level', 'catalog_level.Id = catalog_level_assoc.level_id')
//                ->where(['catalog_level_assoc.level_id'=>$id])
//                ->asArray()->all();
    }

    public function showAllCatalogs(){
        return $query = (new \yii\db\Query())
            ->select(['photo', 'catalog.photo_directory'])
            ->from('catalog_photo_blur')
            ->leftJoin('catalog', 'catalog.Id = catalog_photo_blur.catalog_id')
            ->all();
    }
}
