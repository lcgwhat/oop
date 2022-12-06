<?php
namespace app\models;

use common\models\User;
use yii\db\Transaction;

class UserService
{
    public function add(array $attributions) {
        $transaction = new Transaction();
        $transaction->db = \Yii::$app->db;
        $transaction->level = Transaction::REPEATABLE_READ;
        $transaction->begin();
        $userModel = new User();
        $userModel->password_hash = \Yii::$app->security->generatePasswordHash('123456');
        $userModel->status = 1;
        $userModel->username = $attributions['userName'];
        if (!$userModel->save()) {
            $transaction->rollBack();
            return current($userModel->getErrors());
        }
        $transaction->commit();

        return true;
    }
}