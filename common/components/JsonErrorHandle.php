<?php
/**
 * @author: liuchg
 *
 */

namespace common\components;


use Yii;
use yii\base\UserException;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\Response;

class JsonErrorHandle extends \yii\web\ErrorHandler
{
    protected function renderException($exception)
    {
        if (Yii::$app->has('response')) {
            $response = Yii::$app->getResponse();
            // reset parameters of response to avoid interference with partially created response data
            // in case the error occurred while sending the response.
            $response->isSent = false;
            $response->stream = null;
            $response->data = null;
            $response->content = null;
        } else {
            $response = new Response();
        }
        $response->setStatusCode(200);
        $response->format = Response::FORMAT_JSON;
        $code = 2000;
        if ($exception instanceof ForbiddenHttpException) {
            $code = 5000;
            $message = $exception->getMessage();

        }else if ($exception instanceof HttpException || $exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            if (YII_ENV == 'dev') {
                $message = $exception->getMessage();
            } else {
                $message = \Yii::t('yii', 'An internal server error occurred.');
            }
        }
        $data = [
            'code'	 => $code,
            'message'=> $message,
            'data'	 => [],
        ];

        $response->data = $data;

        $response->send();
    }
}
