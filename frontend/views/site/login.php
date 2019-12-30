<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登入';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form','layout' => 'horizontal']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    如果你忘记密码你可以： <?= Html::a('重置密码', ['site/request-password-reset']) ?>.
                    <br>
                    使用新的验证邮箱 <?= Html::a('重新绑定', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::button('登入', ['id' => 'login','class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script>

(function ($) {

    $('#login').click(function(){
        var form = $(this).parents('form')[0];
        var $form = $(form);
        var url = form.action;

        console.log($form.serializeArray());
        //$form.yiiActiveForm('submitForm');
        console.log($form)
    })
})(window.jQuery)
</script>
