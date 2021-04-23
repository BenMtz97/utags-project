<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "tbl_user".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property integer $phone
 * @property string $birth
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $auth_key
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name','lastname','email','phone', 'birth'], 'required'],
            [['username', 'password'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'username' => 'Username',
            'password' => 'Password',
            'email'    => 'Email',
            'phone'    => 'Phone',
            'birth'    => 'Birthday',
            'name'     => 'Name',
            'lastname' => 'Lastname',
        ];
    }
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /* removed
        public static function findIdentityByAccessToken($token)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }
    */
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = static::findOne(['username' => $username]);
        if(! $user){
            $user = self::findByEmail($username);
        }
        return $user;
    }

    /**
     * Finds user by username
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return (password_verify(($password),$this->password));
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /** EXTENSION MOVIE **/

    public static function register($data){
        $data = $data['User'];
        $user = new User();
        $user->username = $data['username'];
        $user->phone = $data['phone'];
        $user->password = password_hash($data['password'],true);
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->birth = $data['birth'];
        $user->status = 1;
        try{
            $user->save();
            return true;
        }
        catch (Exception $e){
            return false;
        }

    }

}