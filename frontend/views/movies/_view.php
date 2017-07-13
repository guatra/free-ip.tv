<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>




    <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 episode item" data-key="<?=$model->id?>" itemscope="" itemtype="http://schema.org/TVSeries">
        <a href="<?=Yii::$app->urlManager->createUrl(['/movies/view', 'id' =>$model->id])?>" title="<?php echo $model->release_name_ru;?> смотреть онлайн" itemprop="url">
            <div class="thumbnail">
                <?=Html::img(Url::to($model->release_preview_image, true), ['class'=>'' , 'alt' => $model->release_name_ru])?>
                <div class="content">
                    <div class="title" itemprop="name"><?= Html::encode($model->release_name_ru) ?></div>
                    <div class="subtitle">
                        <meta itemprop="numberOfSeasons" content="">
                    </div>
                </div>
            </div>
        </a>
    </div>

<?php if (($index+1) % 4 == 0) : ?>
    <div class="clearfix visible-sm-block"></div>
<?php endif; ?>
<?php if (($index+1) % 6 == 0) : ?>
    <div class="clearfix visible-md-block visible-lg-block"></div>
<?php endif; ?>


