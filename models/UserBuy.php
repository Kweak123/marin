<?php

namespace app\models;

use app\models\product\Product;
use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "user_buy".
 *
 * @property int $Id
 * @property int $User_Id
 * @property int $Product_Id
 * @property string $time
 * @property int $quantity
 *
 * @property Product $product
 * @property User $user
 */
class UserBuy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_buy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['User_Id', 'Product_Id', 'quantity'], 'required'],
            [['User_Id', 'Product_Id', 'quantity'], 'integer'],
            [['time'], 'safe'],
            [['Product_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['Product_Id' => 'Id']],
            [['User_Id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['User_Id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'User_Id' => 'User ID',
            'Product_Id' => 'Product ID',
            'time' => 'Time',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['Id' => 'User_Id']);
    }

    public function addBuy($buy_id){
        $session = Yii::$app->session;

        if(isset($session['buy'])) {
            $ses_array = $session->get('buy');
            $session->remove('buy');

            if (isset($ses_array[$buy_id])) {
                $ses_array[$buy_id]['quantity'] = $ses_array[$buy_id]['quantity'] + 1;
                $session['buy'] = $ses_array;
            }
            else {
                $ses_array[$buy_id] = [
                    "quantity" => 1
                ];
                $session['buy'] = $ses_array;
            }
        }
        else{
            $session['buy'] = [$buy_id => [
                "quantity" => 1
            ]];
        }
    }

    public static function getQuantity(){
        $ses = Yii::$app->session->get('buy');
        if($ses){
            return count($ses);

        }
        return 0;
    }


    public function getBuyProduct($product_id){
        return Product::find()->where(['Id' => $product_id])->asArray()->all();
    }


    public function getSum($buy){

        $sum = 0;
        if (isset($buy)) {
            foreach ($buy as $id => $quantity) {
                $price = Product::find()->select('price')->where(['Id'=>$id])->asArray()->all();
                $sum = $quantity['quantity'] * $price[0]['price'] + $sum;
            }
        }
        return $sum;
    }

    public function deleteProductSessionBuy($id){
        $session = Yii::$app->session;
        $buy_array = $session->get('buy');
        unset($buy_array[$id]);
        $session['buy'] = $buy_array;
    }

}
