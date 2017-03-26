<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Languages;

/* @var $this yii\web\View */
/* @var $model backend\models\Languages */
/* @var $form ActiveForm */
?>
<div class="site-languages">

    <?php $form = ActiveForm::begin(); ?>

       
		<?= $form->field($model, 'language')->dropDownList(
    	ArrayHelper::map(Languages::find()->all(),'language','language'), 
    	['options' =>[ Yii::$app->language => ['Selected' => true]]]
    ) ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('frontend', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-languages -->
