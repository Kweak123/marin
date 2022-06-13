<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "product_params_genesis_assoc".
 *
 * @property int $Id
 * @property int $FirstGenesis
 * @property int $SecondGenesis
 *
 * @property ProductParamsLib $firstGenesis
 * @property ProductParamsLib $secondGenesis
 */
class ProductParamsGenesisAssoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_params_genesis_assoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FirstGenesis', 'SecondGenesis'], 'required'],
            [['FirstGenesis', 'SecondGenesis'], 'integer'],
            [['FirstGenesis'], 'exist', 'skipOnError' => true, 'targetClass' => ProductParamsLib::className(), 'targetAttribute' => ['FirstGenesis' => 'Id']],
            [['SecondGenesis'], 'exist', 'skipOnError' => true, 'targetClass' => ProductParamsLib::className(), 'targetAttribute' => ['SecondGenesis' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'FirstGenesis' => 'First Genesis',
            'SecondGenesis' => 'Second Genesis',
        ];
    }

    /**
     * Gets query for [[FirstGenesis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFirstGenesis()
    {
        return $this->hasOne(ProductParamsLib::className(), ['Id' => 'FirstGenesis']);
    }

    /**
     * Gets query for [[SecondGenesis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSecondGenesis()
    {
        return $this->hasOne(ProductParamsLib::className(), ['Id' => 'SecondGenesis']);
    }
}
