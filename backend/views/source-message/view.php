<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\SourceMessage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'SOURCE_MESSAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'SOURCE_MESSAGE_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'SOURCE_MESSAGE_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?> 
        <?= Html::a(Yii::t('backend', 'MESSAGE_CREATE'), ['message/create', 'id' => $model->id, 'language' => Yii::$app->language], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category',
            'message:ntext',
        ],
    ]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'language',
            'translation:ntext',

            [   
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update}{link}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = Yii::$app->getUrlManager()->createUrl(['message/view','id'=>$model->id, 'language' => $model->language]);
                        return Html::a('<span class="glyphicon glyphicon-file"></span>', $url, [
                                        'title' => Yii::t('backend', 'MESSAGE_VIEW'),
                                ]);
                    },
                    'update' => function ($url, $model) {
                        $url = Yii::$app->getUrlManager()->createUrl(['message/update','id'=>$model->id, 'language' => $model->language]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('backend', 'MESSAGE_UPDATE'),
                                ]);
                    }
                ],
            ],
        ],
    ]); ?>

    

    
</pre>
</div>
