<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_quantity".
 *
 * @property int $Id
 * @property int $Product_Id
 * @property int $quantity
 *
 * @property Product $product
 */
class ProductQuantity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_quantity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Product_Id', 'quantity'], 'required'],
            [['Product_Id', 'quantity'], 'integer'],
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
            'quantity' => 'Quantity',
        ];
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
