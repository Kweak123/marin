<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "user".
 *
 * @property int $Id
 * @property string $login
 * @property string $email
 * @property int $password
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'email', 'password'], 'required'],
            [['password'], 'string', 'max'=>255],
            [['login', 'email'], 'string', 'max' => 50],
            [['login', 'email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByUsername($login)
    {
        return static::findOne(['login'=>$login]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
//        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPasswordHash($password){
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    function createAuthKey(){
        return Yii::$app->security->generateRandomString(12);
    }


    public static function isAdmin(){
        $session = Yii::$app->session;
        if($session['admin'] == true){
            return true;
        }
    }

}
