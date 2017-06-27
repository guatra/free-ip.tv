<?php

namespace frontend\controllers;

use backend\models\Release;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\controllers\AppController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\FullName;

class MoviesController extends AppController
{
    public $layout = 'site';
//    public $layout = 'serials';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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

    public function actionIndex()
    {
        $query = FullName::find()->where(['release_type' => 'movies'])->all();
        $movies = $query;
        $this->setMeta(Yii::$app->name);
        return $this->render('index', ['movies' => $movies]);
    }

    public function actionView($id)
    {
        $data = FullName::find()
        ->where(['release_type' => 'movies', 'id' => $id])
        ->one();
        if ($data){$data->updateCounters(['release_totalseasons' => 1]);};
        $trailer = $data['release_trailer'];
        if (!$trailer) {
            $trailer = 'http://kp.cdn.yandex.net/840152/kinopoisk.ru-Rogue-One_-A-Star-Wars-Story-315981.mp4';
        }
        $movie = Release::find()
            ->where(['release_id' => $id])
            ->one();
        $url = $this->getUrl($movie['episode_url']);
//        $url = $trailer;

        $this->setMeta($movie->episode_title." ".Yii::$app->name, "", "");
        return $this->render('view', ['url' => $url ,'trailer' => $trailer]);
    }

    protected function getUrl($data_id = "1"){
        $client = new \yii\httpclient\Client(['baseUrl' => 'https://zona.mobi/ajax/video/'.$data_id]);
//        $client = new \yii\httpclient\Client(['baseUrl' => 'https://5.35.172.4/ajax/video/'.$data_id]);
        $response = $client->createRequest()
            ->setFormat(\yii\httpclient\Client::FORMAT_JSON)
            ->send();
        $responseData = $response->getData();
        //
        $url = $responseData['url'];
        //
        return $url;
    }
}
