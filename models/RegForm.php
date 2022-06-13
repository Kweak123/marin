<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegForm extends Model
{
    public $login;
    public $email;
    public $password;
    public $password_repeat;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['login', 'email', 'password'], 'required', 'message'=>'Поле не заполнено'],
            [['login', 'email'], 'string', 'max' => 50],
            ['password', 'string', 'max'=>255 ],
            ['email', 'email'],
            //Проверка на уникальность логина
            ['login', 'unique', 'targetClass'=>User::class, 'targetAttribute' => 'login', 'message'=>'Логин не уникален'],
            //проверка на уникальность email
            ['email', 'unique', 'targetClass'=>User::class, 'targetAttribute' => 'email', 'message'=>'Email не уникален'],
            //сравнение паролей
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>'Пароли не совпадают'],
            ['password', 'string', 'min' => 6, 'max' => 20, 'tooShort' => 'Пароль должен содержать минимум 6 символов', 'tooLong' => 'Пароль не должен превышать 20 символов']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat'=>'Повторите пароль',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->login);
        }

        return $this->_user;
    }

    public function registration(){

        $create = new User();
        $create->createAuthKey();
        $create->login = $this->login;
        $create->email = $this->email;
        $create->setPasswordHash($this->password);

        $create->save();
    }
}
