<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "catalog_photo".
 *
 * @property int $Id
 * @property string $photo
 * @property int $category_id
 *
 * @property Catalog $category
 */
class CatalogPhoto extends \yii\db\ActiveRecord
{
    public $upladedfile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['category_id' => 'Id']],
            ['upladedfile', 'safe'],

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
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Catalog::className(), ['Id' => 'category_id']);
    }

    public function showBuyCatalogesPhoto($id)
    {
        $session = Yii::$app->session;
            return static::find()
                ->leftJoin('catalog', 'catalog.Id = catalog_photo.category_id')
                ->leftJoin('catalog_level_assoc', 'catalog.Id = catalog_level_assoc.catalog_id')
                ->leftJoin('user_buy_levels', 'user_buy_levels.level_id = catalog_level_assoc.level_Id')
                ->andWhere(['user_buy_levels.user_id'=>$session['__id'], 'catalog_level_assoc.catalog_id' => $_GET['cat']])
                ->asArray()->all();
    }
}
