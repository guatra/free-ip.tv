<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FullName */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="full-name-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'release_name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_totalseasons')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_status')->textInput() ?>

    <?= $form->field($model, 'release_show')->textInput() ?>

    <?= $form->field($model, 'release_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_released')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_genre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_director')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_actors')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_plot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_awards')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_metascore')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_imdbrating')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_imdbvotes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_imdbid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
