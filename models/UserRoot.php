<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_root".
 *
 * @property int $Id
 * @property int $User_id
 * @property int $root
 *
 * @property User $user
 */
class UserRoot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_root';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['User_id', 'root'], 'required'],
            [['User_id', 'root'], 'integer'],
            [['User_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['User_id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'User_id' => 'User ID',
            'root' => 'Root',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['Id' => 'User_id']);
    }

    public function checkAdmin(){
        $session = Yii::$app->session;
        if(UserRoot::findOne(['User_id'=>$session['__id']])){
            $session['admin'] = true;
        }
    }
}
