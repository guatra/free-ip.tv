<?php

namespace frontend\controllers;

use backend\models\FullName;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use Yii;


class SerialsController extends AppController
{
	// Задаём вывод по умолчанию Навигацонной панели
	public $layout = 'serials';

    public function actionIndex()
    {
        $query = FullName::find()->where(['release_show' => 1]);

        $serials = $query->orderBy(['release_status' => SORT_DESC, 'release_name_ru' => SORT_ASC])->all();
        $this->setMeta(Yii::$app->name . ' | ' .Yii::t('frontend', 'APP_SERIALS'));
        return $this->render('index', [
            'serials' => $serials,
        ]);
    }

    public function actionView($id)
    {
        $query = FullName::find()
        ->select(['id','release_totalseasons', 'release_name_ru'])
        ->where(['release_show' => 1]);
        $serials = $query->orderBy('id')->all();

        // Случайный выбор секции рекомендованные сериалов для просмотра по умолчанию 4
        foreach ($serials as $serial) 
            {
                $array_recommendations[]= $serial->id;
            }

            $n = 4;
            $input = $array_recommendations;
            $rand_keys = array_rand($input, $n);
        for ($i=0; $i < $n ; $i++) 
        { 
            $recommendations[] = $input[$rand_keys[$i]]; 
        }  
        //$poster = 'https://static.lostfilm.tv/Images/174/Posters/poster.jpg';
        $model = $this->findModel($id);
        $this->setMeta($model->release_name_ru . ' (' . $model->release_name_en . ') ', 'keywords', $model->release_description);
        return $this->render('view', [
            'poster' => $this->findPoster($id),
            'model' => $model,
            'serials' => $serials,
            'recommendations' => $recommendations,
        ]);
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
            return $model;
        } else {
 
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPoster($id)
    {   
        $dir = '/Users/guatra/Projects/siteFree-ip_tv/frontend/web/images/serials/' .$id. '/Posters';
        $filename = '/Users/guatra/Projects/siteFree-ip_tv/frontend/web/images/serials/' .$id. '/Posters/poster.jpg';
       //$files = FileHelper::findFiles($dir, [
         //   'only' => ['*.jpg', 'sensitive' => false] 
         //   ]);

            if (!$filename) {

                $poster = Url::to('@web/images/serials/' .$id. '/Posters/poster.jpg' , true);
                return $poster;

            } else {

                $poster = Url::to(['@lostfilm/Images/'.$id.'/Posters/poster.jpg'],'https');
                return $poster;
            }
        //$poster = 'https://static.lostfilm.tv/Images/' .$id. '/Posters/poster.jpg';
        
    }
   
}
