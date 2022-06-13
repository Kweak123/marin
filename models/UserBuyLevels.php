<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_buy_levels".
 *
 * @property int $Id
 * @property int $level_id
 * @property int $user_id
 * @property string $time
 */
class UserBuyLevels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_buy_levels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level_id', 'user_id'], 'required'],
            [['level_id', 'user_id'], 'integer'],
            [['time'], 'safe'],
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
            'user_id' => 'User ID',
            'time' => 'Time',
        ];
    }
}
