<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ForgotPasswordForm extends Model
{
    public $user;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'user' => 'Username or Email'
        ];
    }

    public function sendEmail(){

        if ($this->validate()) {
            $user = $this->getUser();
            if($user != null) {
                Yii::$app->mail->compose('@app/mail/user/reset_password', ['token' => $user->token])
                    ->setFrom('noreply@utags.com')
                    ->setTo($user->email)
                    ->setSubject('Restablecimiento de contraseña')
                    ->send();
                Yii::$app->getSession()->setFlash('success', "We sent you an email with the instructions for reset your password.");
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
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->user);
        }

        return $this->_user;
    }
}