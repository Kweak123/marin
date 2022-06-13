<?php

namespace app\models\product;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $Id
 * @property string $title
 * @property string $discription
 * @property int $price
 * @property string|null $photo
 *
 * @property ProductParamsAssoc[] $productParamsAssocs
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'discription', 'price'], 'required'],
            [['discription'], 'string'],
            [['price'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'title' => 'Название товара',
            'discription' => 'Описание',
            'price' => 'Цена',
            'photo' => 'Фото',
        ];
    }

    /**
     * Gets query for [[ProductParamsAssocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductParamsAssocs()
    {
        return $this->hasMany(ProductParamsAssoc::className(), ['Product_Id' => 'Id']);
    }

    public function searchProducts($params){
        $query = Product::find()
            ->leftJoin('product_params_lib', 'product_params_lib.Product_Id = product_Id');
        if($params != null){
            return $query->addWhere($params);
        }
        return $query;
    }

    public function Params(){

        $query = (new \yii\db\Query())
            ->select('*')
            ->from('product_params_genesis')
            ->join('left join','product_params_lib', 'product_params_lib.genesis = product_params_genesis.Id')
            ->all();

        return ArrayHelper::index($query, 'Id', 'label');
    }
}
