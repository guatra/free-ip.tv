<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FullName */

$this->title = Yii::t('app', 'Create Full Name');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Full Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="full-name-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
