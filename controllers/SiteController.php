<?php

namespace app\controllers;

use app\models\Cat_country;
use app\models\ForgotPasswordForm;
use app\models\RestorePasswordForm;
use app\models\User;
use dektrium\user\events\ResetPasswordEvent;
use dektrium\user\models\RegistrationForm;
use Yii;
use yii\base\BaseObject;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        Yii::$app->getUser()->setReturnUrl(Yii::$app->getUrlManager()->createAbsoluteUrl( '/'));

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $register = $model->register(Yii::$app->request->post());
            if($register['result']){
                try {
                    Yii::$app->mail->compose('@app/mail/user/activate', ['token' => $register['token']])
                        ->setFrom('register@utags.com')
                        ->setTo($register['email'])
                        ->setSubject('Bienvenido')
                        ->send();
                    Yii::$app->getSession()->setFlash('success', 'Tu usuario se registr?? con ??xito. Verifica tu email para continuar.');
                    return $this->redirect('login');
                }
                catch (\Exception $e){
                    var_dump($e);
                    exit();
                }
            }
            else{
                Yii::$app->getSession()->setFlash('error', $register['msg']);
            }
        }

        $mCountries = new Cat_country();
        $countries_result = $mCountries->getCountries();
        $countries = [];
        foreach ($countries_result as $country){
            $countries[$country['idcat_country']] = $country['name'];
        }
        return $this->render('register', [
            'model' => $model,
            'countries' => $countries
        ]);
    }

    public function actionVerify($token){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $result = User::verify($token);
        if($result['result']){
            $type = 'success';
        }
        else{
            $type = 'error';
        }
        Yii::$app->getSession()->setFlash($type, $result['msg']);
        return $this->redirect('login');
    }

    public function actionForgotPassword(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new ForgotPasswordForm();
        if ($model->load(Yii::$app->request->post())) {
            $result = $model->sendEmail(Yii::$app->request->post());
        }
        return $this->render('forgot-password',['model' => $model]);
    }

    public function actionReset($token){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::findByToken($token);
        if($user == null){
            Yii::$app->getSession()->setFlash('error', 'Token has been expired, try again');
            return $this->redirect('forgot-password');
        }
        $model = new RestorePasswordForm();
        if ($model->load(Yii::$app->request->post())) {
            $result = $model->restorePassword($token, Yii::$app->request->post());
            if($result){
                return $this->redirect('login');
            }
        }
        return $this->render('restore-password', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionMaps()
    {
        return $this->render('maps');
    }

    public function actionUsersAdmin()
    {
        if(Yii::$app->user->identity->type != 2){
            Yii::$app->session->addFlash('error', 'You don\'t have access to this resource.');
            return $this->goHome();
        }
        
        $mUsers = new User();
        $users = $mUsers->getAll();
        return $this->render('users-admin', ['users' => $users]);
    }

    public function actionDeleteUser($id){
        if(Yii::$app->user->identity->type != 2){
            Yii::$app->session->addFlash('error', 'You don\'t have access to this resource.');
            return $this->goHome();
        }
        try{
            User::findOne(['id' => $id])->delete();
            Yii::$app->session->addFlash('success', 'User deleted successfully');
        }catch(Exception $e){
            Yii::$app->session->addFlash('error', 'Unknown error occurred');
        }
        return $this->redirect('/site/users-admin');
    }
}
