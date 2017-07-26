<?php

namespace frontend\controllers;

use backend\models\FullName;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use Yii;


class SerialsController extends AppController
{
	// Задаём вывод по умолчанию Навигационной панели
	public $layout = 'series';

    public function actionIndex()
    {
        $query = FullName::find()->where(['release_show' => 1, 'release_type' => 'series']);

        $serials = $query->orderBy(['release_status' => SORT_DESC, 'release_name_ru' => SORT_ASC])->all();
        $this->setMeta(Yii::$app->name . ' | ' .Yii::t('frontend', 'APP_SERIALS'));
        return $this->render('index', [
            'series' => $serials,
        ]);
    }

//    public function actionView($id)
//    {
//        // Проверим запись в сессии и в базе данных на наличие просмотра ранее
//        $view = Yii::$app->session->get('view');
//        //
//        $request = Yii::$app->request;
//        // возвращает все параметры
//        $params = $request->url;
//        // На случай прямого захода объявим переменную
//        $last_view = [];
//        if ($view):
//            if ($view != $params):
//                $id = $request->get('id');
//                $last_view = explode('/', $view);
//                if ($last_view[2] == $id):
//                    $last_view = $view;
//                endif;
////                Yii::$app->session->setFlash(
////                    'success',
////                    'Записанный результат '.$view
////                );
//            else:
////                Yii::$app->session->setFlash(
////                    'success',
////                    'Результат поиска '.$view
////                );
//            endif;
//        else:
//            //Yii::$app->session->set('view', $params);
////            Yii::$app->session->setFlash(
////                'error',
////                ''
////            );
//        endif;
//
//        $query = FullName::find()
//        ->select(['id','release_totalseasons', 'release_name_ru'])
//        ->where(['release_show' => 1]);
//        $series = $query->orderBy('id')->all();
//
//        // Случайный выбор секции рекомендованные сериалов для просмотра по умолчанию 4
//        foreach ($series as $serial)
//            {
//                $array_recommendations[]= $serial->id;
//            }
//
//            $n = 4;
//            $input = $array_recommendations;
//            $rand_keys = array_rand($input, $n);
//        for ($i=0; $i < $n ; $i++)
//        {
//            $recommendations[] = $input[$rand_keys[$i]];
//        }
//        $poster = 'https://static.lostfilm.tv/Images/174/Posters/poster.jpg';
//        $model = $this->findModel($id);
//        $this->setMeta($model->release_name_ru . ' (' . $model->release_name_en . ') ', 'keywords', $model->release_description);
//        return $this->render('view', [
//            'poster' => $this->findPoster($id),
//            'model' => $model,
//            'last_view' => $last_view,
//            'series' => $series,
//            'recommendations' => $recommendations,
//        ]);
//
//    }

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
            return $model;
        } else {
 
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPoster($id)
    {   
        $dir = '/Users/guatra/Projects/siteFree-ip_tv/frontend/web/images/series/' .$id. '/Posters';
        $filename = '/Users/guatra/Projects/siteFree-ip_tv/frontend/web/images/series/' .$id. '/Posters/poster.jpg';
       //$files = FileHelper::findFiles($dir, [
         //   'only' => ['*.jpg', 'sensitive' => false] 
         //   ]);

            if (!$filename) {

                $poster = Url::to('@web/images/series/' .$id. '/Posters/poster.jpg' , true);
                return $poster;

            } else {

                $poster = Url::to(['@lostfilm/Images/'.$id.'/Posters/poster.jpg'],'https');
                return $poster;
            }
        //$poster = 'https://static.lostfilm.tv/Images/' .$id. '/Posters/poster.jpg';
        
    }
   
}
