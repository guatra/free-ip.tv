<?php

namespace frontend\controllers;

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
        $trailer = $data['release_trailer'];
        if (!$trailer) {
            $trailer = 'http://kp.cdn.yandex.net/840152/kinopoisk.ru-Rogue-One_-A-Star-Wars-Story-315981.mp4';
        }


        $this->setMeta(Yii::$app->name);
        return $this->render('view', ['data' => $data,'trailer' => $trailer]);
    }

}
