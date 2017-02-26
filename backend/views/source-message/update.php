<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SourceMessage */

$this->title = Yii::t('backend', 'SOURCE_MESSAGE_UPDATE') .' : '. $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'SOURCE_MESSAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'SOURCE_MESSAGE_UPDATE');
?>
<div class="source-message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
