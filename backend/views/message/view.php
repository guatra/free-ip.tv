<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Message */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'MESSAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'SOURCE_MESSAGE_BACK'), ['/source-message/view', 'id' => $model->id, 'language' => Yii::$app->language], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('backend', 'MESSAGE_UPDATE'), ['update', 'id' => $model->id, 'language' => $model->language], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'MESSAGE_DELETE'), ['delete', 'id' => $model->id, 'language' => $model->language], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'language',
            'translation:ntext',
        ],
    ]) ?>

</div>
