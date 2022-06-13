<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog_level_assoc".
 *
 * @property int $Id
 * @property int $level_id
 * @property int $catalog_id
 *
 * @property Catalog $catalog
 * @property CatalogLevel $level
 */
class CatalogLevelAssoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog_level_assoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level_id', 'catalog_id'], 'required'],
            [['level_id', 'catalog_id'], 'integer'],
            [['catalog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['catalog_id' => 'Id']],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogLevel::className(), 'targetAttribute' => ['level_id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'level_id' => 'Level ID',
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

    /**
     * Gets query for [[Level]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(CatalogLevel::className(), ['Id' => 'level_id']);
    }
}
