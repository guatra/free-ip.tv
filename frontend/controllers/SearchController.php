<?php

namespace frontend\controllers;

use Yii;
use frontend\models\FullName;
use frontend\models\Release;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;


class SearchController extends AppController
{
    /**
     *  Attempt dataprovaider
     */
    public function actionData(){

        $g  = Yii::$app->getRequest()->getQueryParam('data');
        $query = FullName::find()->where(['like', 'release_name_ru', $q])->all();
        $data = ['q' => $q, 'query' => $query];
        return $this->render('data',[
            'data' => $data
        ]);
    }

    /**
     *  Attempt dataprovaider
     */
    public function actionHash(){
        $episode_article_key = '_0jKajcAuuYE8_NyLrrU-nLvW1CJp1oS';
        $q  = Yii::$app->getRequest()->getQueryParam('q');
        $episode_article_key = $q;
        $query = Release::find()->where(['like', 'episode_article_key', $episode_article_key])->one();
        $id = $query->release_id;
        $season = $query->episode_season;
        $episode = $query->episode_season_number;
        $url = "['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode]";
        $data = ['q' => $episode_article_key, 'query' => $query, 'id' => $id ];
        return $this->redirect(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode]);
        return $this->render('data',[
            'data' => $data
        ]);
    }
}