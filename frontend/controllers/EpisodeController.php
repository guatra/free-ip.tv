<?php

namespace frontend\controllers;

use Yii;
use frontend\models\FullName;
use frontend\models\Release;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;

class EpisodeController extends AppController
{
	// Задаём вывод по умолчанию Навигацонной панели
	public $layout = 'episode';

	public function actionData()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $season = $request->get('season');
        $episode = $request->get('episode');
        $release = $this->findSeries($id, $season);
        //
        $data =['request' => $request, 'id' => $id, 'season' => $season, 'episode' => $episode, 'series' => $release];
        return $this->render('data', [
            'data' => $data
        ]);
    }
	
    public function actionIndex()
    {   
        $request = Yii::$app->request;

        // возвращает все параметры
        $params = $request->url;


        return $this->render('index', [
                'params' => $params,
            ]);
    }

    public function actionView()
    {   
        // Проверим запись в сессии и в базе данных на наличие просмотра ранее
        $view = Yii::$app->session->get('view');
        //Yii::$app->session->remove('view');
        $request = Yii::$app->request;
        // возвращает все параметры
        $params = $request->url;

        if ($view):
            if ($view != $params):
                Yii::$app->session->set('view', $params);
//                $view = Yii::$app->session->get('view');
//                Yii::$app->session->setFlash(
//                    'success',
//                    'Переписанный результат '.$view
//                );
            else:
//                Yii::$app->session->setFlash(
//                    'success',
//                    'Результат поиска '.$view
//                );
            endif;
        else:
            Yii::$app->session->set('view', $params);
//            Yii::$app->session->setFlash(
//                'error',
//                ''
//            );
        endif;


        $id = $request->get('id'); 
        $season = $request->get('season'); 
        $episode = $request->get('episode');
        $query = Release::find()
        ->select(['episode_title', 'episode_season', 'episode_season_number', 'episode_runtime', 'episode_url'])
        ->where(['release_id' => $id, 'episode_season' => $season, 'episode_language' => 'ru-RU']);
        $release = $query->orderBy(['episode_season_number' => SORT_ASC])->all();
        $release_trailer = FullName::findOne($id);
//            ->select(['release_trailer']);
        $query_episode = Release::findOne([
            'release_id' => $id,
            'episode_season' => $season,
            'episode_season_number' => $episode,
        ]);
        // ОТправляем пользователя в ошибку
//        if (!$query_episode) {
//            return $this->render('/release/index', [
//                //'params' => $params,
//            ]);
//        }
        //->where(['release_id' => $id, 'episode_season' => $season, 'episode_season_number' => $episode])->all();
        $userIP = Yii::$app->request->userIP;
        $model = $this->findModel($id);

        $this->setMeta(
            $model->release_name_ru .', Сезон '.$season .' Серия '.$episode.', '. $query_episode->episode_title,
            $model->release_name_ru .', Сезон '.$season .' Серия '.$episode.', '. $query_episode->episode_title,
            $model->release_name_ru .', Сезон '.$season .' Серия '.$episode.', '. $query_episode->episode_title
        );
        return $this->render('view', [
            'trailer' => $release_trailer,
            'model' => $model,
            'params' => $params,
            'id' => $id,
            'season' => $season,
            'episode' => $episode,
            'release' => $release,
            'query_episode' => $query_episode,
            'userIP' => $userIP,
        ]);
    }

    protected function findSeries($id = null, $season = null )
    {
        $query = Release::find()
            ->select(['episode_title', 'episode_season', 'episode_season_number', 'episode_runtime', 'episode_url'])
            ->where(['release_id' => $id, 'episode_season' => $season, 'episode_language' => 'ru-RU']);
        $series = $query->orderBy(['episode_season_number' => SORT_ASC])->all();
        if ( $series !== null ) {
            return $series;
        } else {

            throw new NotFoundHttpException('The requested page does not exist. Series not found!');
        }
    }
    /**
     * Finds the FullName model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FullName the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FullName::findOne($id)) !== null) {
                $request = Yii::$app->request;
                $season = $request->get('season'); 
                if ($season <= $model->release_totalseasons ) {
            return $model; }
                else { throw new NotFoundHttpException('The requested page does not exist.');}
        } else {
 
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


  
}
