<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AccountForm extends Model
{
	public $avatar;
    public $username;
    public $signature;
    public $email;
    public $password;
	public $repassword;
	public $verifycode;
    private $_user = false;


    /**
     * @return array the validation rules.
     */
	public function rules()
	{
		return [
		            ['username', 'filter', 'filter' => 'trim'],
		            ['username', 'required'],
		            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
		            ['username', 'string', 'min' => 6, 'max' => 16],
		            ['username', 'match','pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u','message'=>'用户名由字母，汉字，数字，下划线组成，且不能以数字和下划线开头。'],
		            
					['signature', 'filter', 'filter' => 'trim'],
					['signature', 'required'],
					['signature', 'string', 'max' => 200],
				
		            ['email', 'filter', 'filter' => 'trim'],
		            ['email', 'required'],
		            ['email', 'email'],
		            ['email', 'string', 'max' => 100],
		            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
		
		            /* [['password','repassword'], 'required'],
		            [['password','repassword'], 'string', 'min' => 6],
		            ['repassword', 'compare', 'compareAttribute' => 'password','message'=>'两次输入的密码不一致！'],
					//['verifyCode', 'captcha', 'captchaAction'=>'site/captcha'], captchaAction默认值为site/captcha
					['verifycode', 'captcha'], */
		        ];
		
	}
	
	//注意这个方法里user表的字段
	public function update()
	{
	    if ($this->validate()) {
	        $user = new User();
	        $account = $user->findIdentity(Yii::$app->user->identity->id);
	        $account->username = $this->username;
	        $account->signature = $this->signature;
	        $account->email = $this->email;
	        $account->update_time = time();
	        if ($account->save()) {
	            return $user; 
	        }
	    }
	
	    return null;
	}
	
	public function getAccountInfo(){
		$this->username = Yii::$app->user->identity->username;
		$this->signature = Yii::$app->user->identity->signature;
		$this->email = Yii::$app->user->identity->email;
	}
	
}

