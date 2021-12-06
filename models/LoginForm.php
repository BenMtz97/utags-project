<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
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

            if (!$user) {
                $this->addError($attribute, 'Username not exists.');
            }
            else{
                if($user->login_attempts < 2){
                    if(!$user->validatePassword($this->password)){
                        $user->login_attempts = $user->login_attempts+1;
                        $user->save();
                        $this->addError($attribute, 'Remaining login attempts before lock: '.(3-$user->login_attempts));
                    }
                }
                elseif($user->login_lock_date == null) {
                    $user->login_lock_date = date('Y-m-d H:i:s');
                    $user->save();
                    $this->addError($attribute, 'Your account has been locked, try it again in 5 min');
                }
                elseif($user->login_lock_date > date('Y-m-d H:i:s', strtotime('-5 minutes'))){
                    $this->addError($attribute, 'Your account has been locked, try it again in 5 min');
                }
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if($user->status == 0){
                Yii::$app->mail->compose('@app/mail/user/activate', ['token' => $user->token])
                    ->setFrom('register@utags.com')
                    ->setTo($user->email)
                    ->setSubject('Verificar correo')
                    ->send();
                Yii::$app->getSession()->setFlash('error', "Your email isn't verified please check your email.");
                return false;
            }
            if($user->status == 2){
                Yii::$app->getSession()->setFlash('error', "Your account has been disabled, please contact us for more information.");
                return false;
            }
            $user = $this->getUser();
            $user->login_lock_date = null;
            $user->login_attempts = 0;
            $user->save();

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
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
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}
