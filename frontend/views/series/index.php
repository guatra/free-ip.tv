<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use frontend\components\HelloWidget;

?>


<div class="inner">
    <header id="header">
        <a href="#" class="logo"><strong><?= HelloWidget::widget() ?></strong></a>
        <ul class="icons">
            <li>
                <?= Html::a(Icon::show('vk', ['class' => 'icon'], Icon::FA), 'https://vk.com/freeiptv', ['class' => 'icon fa vk']) ?>
            </li>
        </ul>
    </header>
    <section>
        <div class="box alt">
            <div class="row">
                <?php foreach ($series as $seriesItem): ?>
                <div class="3u 12u$(medium)">
                    <span class="image fit">
                        <a class="" href="<?=Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$seriesItem->id])?>">
                            <?php echo Html::img(Url::to(['@web/uploads/Images/'.$seriesItem->id.'/Posters/poster.jpg'],true), ['alt' =>$seriesItem->release_name_ru, 'itemprop' => 'image', 'class' => 'img-responsive'])?>
                        </a>
                    </span>
                </div>
                <?php endforeach; ?>
                <!-- Break -->
            </div>
        </div>
    </section>

</div>
