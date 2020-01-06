<?php
namespace app\controllers;

use app\models\site\RegisterForm;
use app\models\site\SiteForm;
use app\models\site\SiteService;
use Yii;

/**
 * Site controller
 */
class SiteController extends Controller
{

    protected function accessAllow() {
        // 登录页和错误页，无需登录也可以访问
        return ['login', 'error', 'signup', 'exist-name'];
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
        $form = new SiteForm();
        if (!$form->apiLoadPost()) {
            return $this->jsonError($form->getError());
        } else {
            $service = new SiteService();
            $result = $service->login($form);
            if (!$result) {
                return $this->jsonError($service->getError());
            }
            return $this->jsonSuccess('登入成功', $result);
        }

    }

    public function actionRegister(){
        $form = new RegisterForm();
        if (!$form->apiLoadPost()) {
            return $this->jsonError($form->getError());
        } else {
            $service = new SiteService();
            $result = $service->create($form);
            if (!$result) {
                return $this->jsonError($service->getError());
            }
            return $this->jsonSuccess('注册成功', $result);
        }
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
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
