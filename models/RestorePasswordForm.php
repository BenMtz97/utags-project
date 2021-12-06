<?php

namespace app\models;

use Yii;
use yii\base\Security;

class RestorePasswordForm extends \yii\base\Model
{
    public $password;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['password'], 'required'],
            ['password','match', 'pattern' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{6,60}$/",
                'message' => "Password must contain min 6 chars and max 20 chars, at least one uppercase letter, at least one lowercase letter, at least one number and at least one of special character ( !@#$%^&*_=+- )"],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Password'
        ];
    }

    public function restorePassword($token, $data){
        $data = $data['RestorePasswordForm'];
        if ($this->validate()) {
            $user = $this->getUser($token);
            if($user != null) {
                $security_instance = new Security();
                $user->password = $security_instance->generatePasswordHash($data['password']);
                $user->token = $security_instance->generateRandomString();
                $user->save();
                Yii::$app->getSession()->setFlash('success', "The password has been restored. Try to login again.");
                return true;
            }
            else{
                Yii::$app->getSession()->setFlash('error', 'Username or email does not exists in our system');
                return false;
            }
        }
        return false;
    }


    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser($token)
    {
        if ($this->_user === false) {
            $this->_user = User::findByToken($token);
        }
        return $this->_user;
    }

}