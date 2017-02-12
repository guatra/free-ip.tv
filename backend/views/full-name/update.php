<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FullName */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Full Name',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Full Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="full-name-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
