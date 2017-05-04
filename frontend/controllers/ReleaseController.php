<?php


namespace frontend\controllers;

use backend\models\FullName;
use backend\models\Release;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use Yii;


class ReleaseController extends AppController
{
    // Задаём вывод по умолчанию Навигационной панели
    public $layout = 'release';

    public function actionIndex(){
        // Проверим запись в сессии и в базе данных на наличие просмотра ранее
        $view = $this->getLastView();
        //
        $request = Yii::$app->request;
        // возвращает все параметры
        $params = $request->url;

        $id = $request->get('id');
        $season = $request->get('season');
        $release = $this->getSerialsSeason($id, $season);
        $model = $this->findModel($id);
        $this->setMeta($model->release_name_ru . ' (' . $model->release_name_en . ') сезон '.$season, 'keywords', $model->release_description);
        return $this->render('index', [
            'id' => $id,
            'season' => $season,
            'release' => $release,
            'poster' => $this->findPoster($id),
            'model' => $model,
            'serials' => $this->getSerials(),
            'recommendations' => $this->getRecommendation(),
        ]);
    }

    public function actionView($id)
    {
        // Проверим запись в сессии и в базе данных на наличие просмотра ранее
        $view = $this->getLastView();
        //
        $request = Yii::$app->request;
        // возвращает все параметры
        $params = $request->url;
        // На случай прямого захода объявим переменную
        $last_view = [];
        if ( $view ):
            if ( $view != $params ):
                $id = $request->get('id');
                $last_view = explode('/', $view);
                if ( $last_view[2] == $id ):
                    $last_view = $view;
                endif;
//                Yii::$app->session->setFlash(
//                    'success',
//                    'Записанный результат '.$view
//                );
            else:
//                Yii::$app->session->setFlash(
//                    'success',
//                    'Результат поиска '.$view
//                );
            endif;
        else:
            //Yii::$app->session->set('view', $params);
//            Yii::$app->session->setFlash(
//                'error',
//                ''
//            );
        endif;

        $poster = 'https://static.lostfilm.tv/Images/174/Posters/poster.jpg';
        $model = $this->findModel($id);
        $this->setMeta($model->release_name_ru . ' (' . $model->release_name_en . ') ', 'keywords', $model->release_description);
        return $this->render('view', [
            'poster' => $this->findPoster($id),
            'model' => $model,
            'last_view' => $last_view,
            'serials' => $this->getSerials(),
            'recommendations' => $this->getRecommendation(),
        ]);

    }

    protected function getLastView()
    {
        $view = Yii::$app->session->get('view');
        return $view;
    }

    protected function getSerials()
    {
        $query = FullName::find()
            ->select(['id', 'release_totalseasons', 'release_name_ru'])
            ->where(['release_show' => 1])
            ->orderBy('id')->all();
        return $query;
    }
    protected function getSerialsSeason($id = null, $season = null)
    {
        $query = Release::find()
            ->select(['episode_title', 'episode_season', 'episode_season_number', 'episode_runtime', 'episode_url'])
            ->where(['release_id' => $id, 'episode_season' => $season, 'episode_laguage' => 'ru-RU'])
            ->orderBy(['episode_season_number' => SORT_ASC])->all();
            return $query;
    }

    protected function getRecommendation($n = 4)
    {

        $serials = $this->getSerials();

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

    /**
     * Finds the FullName model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FullName the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ( ($model = FullName::findOne($id)) !== null ) {
            return $model;
        } else {

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $alias
     * @return string
     */
    protected function findAlias($alias)
    {
        if ( ($model = FullName::findOne($release_lostfilm_alias)) !== null ) {
            return $model;
        } else {

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPoster($id)
    {
        $dir = '/Users/guatra/Projects/siteFree-ip_tv/frontend/web/images/serials/' . $id . '/Posters';
        $filename = '/Users/guatra/Projects/siteFree-ip_tv/frontend/web/images/serials/' . $id . '/Posters/poster.jpg';
        //$files = FileHelper::findFiles($dir, [
        //   'only' => ['*.jpg', 'sensitive' => false]
        //   ]);

        if ( !$filename ) {

            $poster = Url::to('@web/images/serials/' . $id . '/Posters/poster.jpg', true);
            return $poster;

        } else {

            $poster = Url::to(['@lostfilm/Images/' . $id . '/Posters/poster.jpg'], 'https');
            return $poster;
        }
        //$poster = 'https://static.lostfilm.tv/Images/' .$id. '/Posters/poster.jpg';

    }
}