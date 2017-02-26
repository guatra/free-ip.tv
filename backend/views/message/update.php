<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Message */

$this->title = Yii::t('backend', 'MESSAGE_UPDATE') . Yii::t('backend', ' {modelClass}: ', [
    'modelClass' => 'Message',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'MESSAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'MESSAGE_UPDATE');
?>
<div class="message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
