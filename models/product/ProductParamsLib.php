<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "product_params_lib".
 *
 * @property int $Id
 * @property string $params
 * @property int $genesis
 *
 * @property ProductParamsGenesis $genesis0
 * @property ProductParamsAssoc[] $productParamsAssocs
 * @property ProductParamsGenesisAssoc[] $productParamsGenesisAssocs
 * @property ProductParamsGenesisAssoc[] $productParamsGenesisAssocs0
 */
class ProductParamsLib extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_params_lib';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['params', 'genesis'], 'required'],
            [['genesis'], 'integer'],
            [['params'], 'string', 'max' => 255],
            [['genesis'], 'exist', 'skipOnError' => true, 'targetClass' => ProductParamsGenesis::className(), 'targetAttribute' => ['genesis' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'params' => 'Параметр',
            'genesis' => 'Связь',
        ];
    }

    /**
     * Gets query for [[Genesis0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenesis0()
    {
        return $this->hasOne(ProductParamsGenesis::className(), ['Id' => 'genesis']);
    }

    /**
     * Gets query for [[ProductParamsAssocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductParamsAssocs()
    {
        return $this->hasMany(ProductParamsAssoc::className(), ['Param_Id' => 'Id']);
    }

    /**
     * Gets query for [[ProductParamsGenesisAssocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductParamsGenesisAssocs()
    {
        return $this->hasMany(ProductParamsGenesisAssoc::className(), ['FirstGenesis' => 'Id']);
    }

    /**
     * Gets query for [[ProductParamsGenesisAssocs0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductParamsGenesisAssocs0()
    {
        return $this->hasMany(ProductParamsGenesisAssoc::className(), ['SecondGenesis' => 'Id']);
    }
}
