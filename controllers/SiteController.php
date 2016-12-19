<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\User;
use app\models\AccountForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
            ],
        ];
    }

    /**
     * @inheritdoc
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
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Register action
     * 
     * @return string
     */
	public function actionRegister()
	{
	    $model = new RegisterForm();
	    if ($model->load(Yii::$app->request->post())) {
	        if ($user = $model->register()) {
	           // $login = new SiteLoginForm();             
	            if(Yii::$app->getUser()->login($user)) {
	                return $this->goHome();
	            }
	            else
	            {
	                var_dump($user);
	            }
	        }
	    }
		
	    return $this->render('register', ['model' => $model]);
	}
    
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    
    public function actionSendemail(){
    	$mail= Yii::$app->mailer->compose(); //加载模板这样写：$mail= Yii::$app->mailer->compose('moban',['key'=>'value']);
    	$mail->setTo('651174785@qq.com'); //要发送给那个人的邮箱
    	$mail->setSubject("邮件主题"); //邮件主题
    	$mail->setTextBody('测试text'); //发布纯文字文本
    	//$mail->setHtmlBody("hellow,world"); //发送的消息内容
    	var_dump($mail->send());exit;
    }
    
    public function actionAccount(){
    	$model= new AccountForm();
    	$model->getAccountInfo();
	    if ($model->load(Yii::$app->request->post())) {
	    	$model->avatar = $_POST['avatar'];
			$upload = new UploadedFile();
	    	if($model->update()){
	    		return $this->render('account');
	    	}
	    }
	    
    	return $this->render('account', ['model' => $model]);
    }
}
