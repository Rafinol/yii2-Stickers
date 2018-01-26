<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use Longman\TelegramBot;

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

    public function actionTest()
    {

        Yii::$app->telegram->sendMessage([
            'chat_id' => 165666400,
            'text' => 'this is test',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>"refresh",'callback_data'=> time()]
                    ]
                ]
            ]),
        ] );
    }

    public function actionSet()
    {
        $bot_api_key  = '464600459:AAHwZtlB9YJDAoC3L9hlb0n7_iETIi6n1nc';
        $bot_username = 'persticker_bot';
        $hook_url = 'https://alistorm.ru/stickers/site/hook';
        try {
            // Create Telegram API object
            $telegram = new TelegramBot\Telegram($bot_api_key, $bot_username);

            // Set webhook
            $result = $telegram->setWebhook($hook_url);
            if ($result->isOk()) {
                echo $result->getDescription();
            }
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            // log telegram errors
            // echo $e->getMessage();
        }
    }

    public function actionHook()
    {
        $bot_api_key  = '464600459:AAHwZtlB9YJDAoC3L9hlb0n7_iETIi6n1nc';
        $bot_username = 'persticker_bot';

        try {
            // Create Telegram API object
            $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

            // Handle telegram webhook request
            $telegram->handle();
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            // Silence is golden!
            // log telegram errors
            // echo $e->getMessage();
        }
    }


}
