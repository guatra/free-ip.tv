<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FullNameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="full-name-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'release_name_ru') ?>

    <?= $form->field($model, 'release_name_en') ?>

    <?= $form->field($model, 'release_totalseasons') ?>

    <?= $form->field($model, 'release_status') ?>

    <?php // echo $form->field($model, 'release_show') ?>

    <?php // echo $form->field($model, 'release_year') ?>

    <?php // echo $form->field($model, 'release_description') ?>

    <?php // echo $form->field($model, 'release_released') ?>

    <?php // echo $form->field($model, 'release_genre') ?>

    <?php // echo $form->field($model, 'release_director') ?>

    <?php // echo $form->field($model, 'release_actors') ?>

    <?php // echo $form->field($model, 'release_plot') ?>

    <?php // echo $form->field($model, 'release_language') ?>

    <?php // echo $form->field($model, 'release_country') ?>

    <?php // echo $form->field($model, 'release_awards') ?>

    <?php // echo $form->field($model, 'release_metascore') ?>

    <?php // echo $form->field($model, 'release_imdbrating') ?>

    <?php // echo $form->field($model, 'release_imdbvotes') ?>

    <?php // echo $form->field($model, 'release_imdbid') ?>

    <?php // echo $form->field($model, 'release_type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
