<?php

namespace frontend\controllers;

use frontend\models\Release;
use frontend\models\FullName;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\controllers\AppController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class MoviesController extends AppController
{
    public $layout = 'movies';

    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup'],
//                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    public function actionData()
    {
        return $this->render('data');
    }

    public function actionIndex()
    {
        // выполняем запрос
        $query = FullName::find()->where(['release_show' => 1, 'release_type' => 'movies']);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24,
            ],
            'sort' => [
                'defaultOrder' => [
//                    'created_at' => SORT_DESC,
                    'release_released' => SORT_DESC,
                ]
            ],
        ]);
//        // returns an array of Movies objects
//        //$movies = $provider->getModels();
//        // делаем копию выборки
//        $countQuery = clone $query;
//        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        // Передаем данные в представление
        return $this->render('index', [
            'movies' => $provider,
//            'pages' => $pages,
            'series' => $this->getSeries(),
            'recommendations' => $this->getRecommendation(),
        ]);
    }

    public function actionView($id)
    {
        $model_movie = FullName::find()
            ->where(['release_type' => 'movies', 'id' => $id])
            ->one();
        // if ($data){$data->updateCounters(['release_totalseasons' => 1]);}
        $trailer = $model_movie['release_trailer'];
        $img = $model_movie['release_preview_image'];
        if (!$trailer) {
            $trailer = 'http://kp.cdn.yandex.net/840152/kinopoisk.ru-Rogue-One_-A-Star-Wars-Story-315981.mp4';
        }
        $movie = Release::find()
            ->where(['release_id' => $id])
            ->one();
        $url = $this->getUrl($movie['episode_url']);
//        $url = $trailer;
        $data = ['movie' => $movie, 'url' => $url, 'trailer' => $trailer, 'img' => $img];
        $this->setMeta($movie->episode_title." ".Yii::$app->name, "", "");
        return $this->render('view', ['data' => $data]);
//        return $this->render('data', ['data' => $data]);
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

    protected function getSeries()
    {
        $query = FullName::find()
            ->select(['id', 'release_totalseasons', 'release_name_ru'])
            ->where(['release_show' => 1, 'release_type' => 'series'])
            ->orderBy('id')->all();
        return $query;
    }

    protected function getRecommendation($n = 4)
    {

        $serials = $this->getSeries();

        // Случайный выбор секции рекомендованные сериалов для просмотра по умолчанию 4
        foreach ($serials as $serial) {
            $array_recommendations[] = $serial->id;
        }

        $input = $array_recommendations;
        $rand_keys = array_rand($input, $n);
        for ($i = 0; $i < $n; $i++) {
            $recommendations[] = $input[$rand_keys[$i]];
        }
        return $recommendations;
    }
}
