<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\SourceMessage;
use backend\models\Languages;

/* @var $this yii\web\View */
/* @var $model backend\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'id')->dropDownList(
        ArrayHelper::map(SourceMessage::find()->all(),'id','message'), 
        ['prompt' => Yii::t('backend', 'Select'), $model->id ? : 'options' =>[ $model->id => ['Selected' => true]]]
    ) ?>

    <?= $form->field($model, 'language')->dropDownList(
    	ArrayHelper::map(Languages::find()->all(),'language','language'), 
    	['prompt' => Yii::t('backend', 'Select')]
    ) ?>

    <?= $form->field($model, 'translation')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
