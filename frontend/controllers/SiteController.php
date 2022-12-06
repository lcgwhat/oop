<?php
namespace app\controllers;


use app\algo\queue\QueueOnLinkedList;
use app\algo\stack\StackOnLinkedList;
use app\models\site\RegisterForm;
use app\models\site\SiteForm;
use app\models\site\SiteService;
use common\components\JWT;
use common\models\User;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\ValidationData;
use Yii;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function withoutAuthorization()
    {
        return [
            'login','index',''
        ];
    }
    const User = [
        'id' => 1,
        'user' => 'lili'
    ];
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
        /**
         * @var $jwt JWT
         */
        $jwt = Yii::$app->get('jwt');
        $user = 1;
        $oek = $jwt->encode($user);


        return $this->jsonSuccess('', [(string)$oek]);
    }

    public function actionParse(){
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6Ii1MRVhVdmRlcHoifQ.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjEiLCJhdWQiOiIiLCJqdGkiOiItTEVYVXZkZXB6IiwiaWF0IjoxNjY2MDYzOTM5LCJuYmYiOjE2NjYwNjM5MzksImV4cCI6MTY2NjA2NzUzOSwidXNlciI6eyJ1c2VyX25hbWUiOiJcdTZkNGJcdThiZDUiLCJ1c2VyX25vIjoiMDAxIn0sImNlc2hpIjoiXHU2ZDRiXHU4YmQ1XHU1YjU3XHU2YmI1In0.cMqfQMIQxkPRqYEu85gkVgk5uBMUcDAaWGPYGrvUFxY";
        $token = (new Parser())->parse($token);
        //数据校验
        $data = new ValidationData(); // 使用当前时间来校验数据
        if (!$token->validate($data)) {
            //数据校验失败
            return '数据校验失败';
        }
        //token校验
        $signer = new Sha256();//生成JWT时使用的加密方式
        if (!$token->verify($signer, new Key('jwt_secret'))) {
            //token校验失败
           return $this->jsonSuccess('token校验失败');
        }
        return $this->jsonSuccess('成功');
    }

    public function actionProfile(){
        $user = Yii::$app->user->identity;
        return  $this->jsonSuccess('',$user->getAttributes());
    }

    public function actionCss()
    {

        return $this->render('css');
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

    public function actionIsLogin(){
        return $this->jsonSuccess('已经登入',self::User);
    }
//    public function actionCaptcha(){
//        Captcha::className();
//    }

    public function stack() {
        $stack = new StackOnLinkedList();
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $stack->push(4);
        $stack->pop();
        $stack->printSelf();
    }

    public function queue() {
        $queue = new QueueOnLinkedList();
        $queue->enQueue(1);
        $queue->enQueue(1);
        $queue->enQueue(1);
        $queue->enQueue(1);
        $queue->printSelf();
    }
     function myFuc($v1,$v2){
        if ($v1==$v2) {
            return 'same';
        }
        return 'diff';
    }
    /**
     *
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin2()
    {
        $form = new SiteForm();

        if (Yii::$app->request->isGet) {
            return $this->render('login',['model'=>$form]);
        } else {
            $service = new SiteService();
            $result = $service->login($form);
            if (!$result) {
                return $this->jsonError($service->getError());
            }
            return $this->jsonSuccess('登入成功', $result);
        }

    }
    function randFloat($min=0, $max=1){
        return $min + mt_rand()/mt_getrandmax() * ($max-$min);
    }

    // 获取microtime
    function get_microtime(){
        list($usec, $sec) = explode(' ', microtime());
        return (float)$usec + (float)$sec;
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

    function trap(array $height)
    {
        $res = 0;
        $size = count($height);
        $left[0] = $height[0];
        for ($i = 1; $i < $size; $i++) {
            $left[$i] = max($left[$i - 1], $height[$i]);
        }
        $right[$size - 1] = $height[$size - 1];
        for ($i = $size - 2; $i >= 0; $i--) {
            $right[$i] = max($right[$i + 1], $height[$i]);
        }

        for ($i = 1; $i < $size - 1; $i++) {
            $res += min($left[$i], $right[$i]) - $height[$i];
        }
        echo '<div>';

        print_r($left);
        echo '</div>';
        print_r($right);
        return $res;
    }

    function blade($nums, $target) {
        $left = 0;
        $right = count($nums)-1;
        while($left<=$right){//注意条件界限
            $mid = intval(($left+$right)/2);//注意取整
            if($nums[$mid] == $target){
                //相关逻辑处理;
            }elseif($nums[$mid] > $target){//注意right向左偏移
                $right = $mid -1;
            }else{//注意left向右偏移
                $left = $mid+1;
            }
        }

        //相关值返回
        return 0;
    }

    public function trap2(array $height)
    {
        $res = 0;
        $size = count($height);
        for ($i=1; $i < $size-1; $i++) {
            $left = 0;
            for ($j=$i; $j >= 0; $j--){
                $left = max($left,$height[$j]);
            }

            $right = 0;
            for ($j = $i; $j < $size; $j++) {
                $right = max($right, $height[$j]);
            }

            $res += min($left,$right) - $height[$i];
        }

        return $res;
    }
}
