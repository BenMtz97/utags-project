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
 * @property integer $country
 * @property string $birth
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $token
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
            [['username', 'password', 'name','lastname','email','phone', 'birth','country'], 'required'],
            [['username', 'password'], 'string', 'max' => 60],
            ['password','match', 'pattern' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{6,60}$/",
                'message' => "Password must contain min 6 chars and max 20 chars, at least one uppercase letter, at least one lowercase letter, at least one number and at least one of special character ( !@#$%^&*_=+- )"],
//            [['email'], 'email'],
//            ['email','unique','className' => 'User', 'attributeName' => 'email', 'message' => 'The email already in use'],
//            ['username', 'unique', 'className' => 'User', 'attributeName' => 'username', 'message' => 'The username already in use']
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
            'country'  => 'Country',
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

    /**
     * Finds user by token
     *
     * @param  string      $token
     * @return static|null
     */
    public static function findByToken($token)
    {
        return static::findOne(['token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = static::findOne(['username' => $username]);
        if(!$user){
            $user = self::findByEmail($username);
        }
        return $user;
    }

    /**
     * Finds user by Email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
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

    /** EXTENSION MOVIE **/

    public static function register($data){
        $data = $data['User'];
        if(self::findByEmail($data['email'])){
            return ['result' => false, 'msg' => 'This email is already in use'];
        }
        elseif(self::findByUsername($data['username'])){
            return ['result' => false, 'msg' => 'This username is already in use'];
        }
        $security_instance = new Security();
        $user = new User();
        $user->username = $data['username'];
        $user->phone = $data['phone'];
        $user->password = $security_instance->generatePasswordHash($data['password']);
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->birth = $data['birth'];
        $user->country  = $data['country'];
        $user->status = 0;
        $user->token = $security_instance->generateRandomString();
        try{
            if($user->save())
                return ['result' => true, 'token' => $user->token, 'email' => $user->email];
            return ['result' => false, 'msg' => 'Nel no jala'];
        }
        catch (Exception $e){
            return ['result' => false, 'msg' => 'Unknown error. Contact support.'];
        }
    }

    public static function verify($token){
        $user = User::findByToken($token);
        if($user != null){
            $security_instance = new Security();
            $user->status = 1;
            $user->token = $security_instance->generateRandomString();
            $user->save();
            return ['result' => true, 'msg' => 'Verified account!!'];
        }
        else{
            return ['result' => false, 'msg' => 'Token expired'];
        }
    }

}