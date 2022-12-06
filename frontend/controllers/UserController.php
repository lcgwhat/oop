<?php

namespace app\controllers;

use app\models\user\LoginForm;
use app\models\user\LoginService;
use app\models\user\RegisterForm;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends \app\controllers\Controller
{
    public function accessAllow()
    {
        return ['login', 'register'];
    }

    public function actionLogin(){
       $form = new LoginForm();
       $form->loadPost("");
       if (!$form->validate()) {
           return $this->jsonError($form->getError());
       }
       $service = new LoginService();
       $load = $service->login($form);
       if ($load === false) {
           return $this->jsonError($service->getError());
       }

       return $this->jsonSuccess('', ['jwt' => $load]);
   }

    public function actionRegister(){
        $form = new RegisterForm();
        $form->loadPost("");
        if (!$form->validate()) {
            return $this->jsonError($form->getError());
        }
        $service = new LoginService();
        $load = $service->register($form);
        if ($load === false) {
            return $this->jsonError($service->getError());
        }

        return $this->jsonSuccess('',[]);
    }
}
