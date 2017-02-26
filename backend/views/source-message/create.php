<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SourceMessage */

$this->title = Yii::t('backend', 'SOURCE_MESSAGE_CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'SOURCE_MESSAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'message' => $message,
    ]) ?>

</div>
