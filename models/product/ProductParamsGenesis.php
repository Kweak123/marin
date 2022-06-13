<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "product_params_genesis".
 *
 * @property int $Id
 * @property int $label
 *
 * @property ProductParamsLib[] $productParamsLibs
 */
class ProductParamsGenesis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_params_genesis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label'], 'required'],
            [['label'], 'string', 'max'=>255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'label' => 'Label',
        ];
    }

    /**
     * Gets query for [[ProductParamsLibs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductParamsLibs()
    {
        return $this->hasMany(ProductParamsLib::className(), ['genesis' => 'Id']);
    }
}
