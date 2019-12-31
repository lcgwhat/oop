<?php
namespace app\controllers;

use common\models\system\SignupForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{

    protected function accessAllow() {
        // 登录页和错误页，无需登录也可以访问
        return ['login', 'error', 'signup'];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $a = [
            [
                'name' => 'ali1' , 'time' => date('Y年m月d日', strtotime('-1day'))
            ],
            [
                'name' => 'ali2', 'time' => date('Y年m月d日', strtotime('-2day'))
            ],
            [
                'name' => 'ali3', 'time' => date('Y年m月d日',strtotime('-1day'))
            ],
            [
                'name' => 'ali4', 'time' => date('Y年m月d日',strtotime('-3day'))
            ]
        ];
        $a2= array_map(function(&$val){

            $val['name'] .=  '+++--';
            $s[$val['name']]= $val['time'];
            return $s;
        }, $a);
        $re = ArrayHelper::index($a, null,'time');


        $this->stdout("Hello?\n", Console::BOLD);
        die;
        return $this->render('index');
    }

    public function actionGetSmsCode(){
        $msg = [
            'code' => 200,
            'message' => '',
            'data' => []
        ];

        return $this->asJson($msg);
    }

    public function actionExistName(){
        $name = \Yii::$app->request->post('phone',100);
        if ($name == 101) {
            $message = [
                'code' => 100,
                'data' => [],
                'message' => '已存在'
            ];
        } else {
            $message = [
                'code' => 200,
                'data' => [],
                'message' => '已存在'
            ];
        }

        return $this->asJson($message);
    }

    public function actionRegister(){
        $msg = [
            'code' => 200,
            'data' => [],
            'msg' => 'xxx'
        ];
        return $this->asJson($msg);
    }
    public function actionGetCode(){
        echo Captcha::widget([
            'name' => 'captcha',
        ]);
    }
//    public function actionCaptcha(){
//        Captcha::className();
//    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
       if (\Yii::$app->request->isPost) {
           $message = [
               'code' => 200,
               'data' => []
           ];
           if (\Yii::$app->session->has('user')){


               $user = \Yii::$app->session->get('user');
               $user['isSession'] = true;
               $message['data'] = $user;
               return $this->asJson($message);
           }
           $user = [
               'id' => 101,
               'name' => '测试'
           ];
           $message['data'] = $message;
           \Yii::$app->session->set('user', $user);
           return $this->asJson($message);
       }
        $message = [
            'code' => 100,
            'data' => [
                'id' => 101,
                'name' => '测试'
            ]
        ];
        return $this->asJson($message);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            var_dump('dengru');die;
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
