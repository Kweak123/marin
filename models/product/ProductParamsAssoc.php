<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "product_params_assoc".
 *
 * @property int $Id
 * @property int $Product_Id
 * @property int $Param_Id
 *
 * @property ProductParamsLib $param
 * @property Product $product
 */
class ProductParamsAssoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_params_assoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Product_Id'], 'required'],
            [['Product_Id', 'Param_Id'], 'integer'],
            [['Param_Id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductParamsLib::className(), 'targetAttribute' => ['Param_Id' => 'Id']],
            [['Product_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['Product_Id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Product_Id' => 'Product ID',
            'Param_Id' => 'Param ID',
        ];
    }

    /**
     * Gets query for [[Param]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParam()
    {
        return $this->hasOne(ProductParamsLib::className(), ['Id' => 'Param_Id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['Id' => 'Product_Id']);
    }
}
