<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog_level".
 *
 * @property int $Id
 * @property string $label
 * @property string $description
 * @property int $price
 *
 * @property CatalogLevelAssoc[] $catalogLevelAssocs
 */
class CatalogLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'description', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'integer'],
            [['label'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'label' => 'Уровнь',
            'description' => 'Описание',
            'price' => 'Цена',
        ];
    }

    /**
     * Gets query for [[CatalogLevelAssocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogLevelAssocs()
    {
        return $this->hasMany(CatalogLevelAssoc::className(), ['level_id' => 'Id']);
    }


    public function showAllLevels(){
        return static::find()->asArray()->all();
    }

    public function showBuysLevels(){
        $session = Yii::$app->session;
        return static::find()
            ->leftJoin('user_buy_levels', 'user_buy_levels.level_id = catalog_level.Id')
            ->where(['user_buy_levels.user_id' => $session['__id']])->asArray()->all();
    }
}
