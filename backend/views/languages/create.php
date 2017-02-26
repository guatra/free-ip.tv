<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Languages */

$this->title = Yii::t('backend', 'Create Languages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="languages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
