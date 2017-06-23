<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\bootstrap\Carousel;
use yii\helpers\Url;
?>
<div id="main">
    <div class="inner">

        <!-- Header -->
        <header id="header">
            <a href="#" class="logo"><strong>ПРивет</strong> юзер</a>
            <ul class="icons">
                <li>
                    <?= Html::a(Icon::show('vk', ['class' => 'icon'], Icon::FA), 'https://vk.com/freeiptv', ['class' => 'icon fa vk']) ?>
                </li>
            </ul>
        </header>

        <section>
            <div class="box alt">
                <div class="row">
                    <?php foreach ($movies as $moviesItem): ?>
                        <div class="2u 12u$(medium)">
                            <div class="box">
                    <span class="image fit">
                        <a class="" href="<?=Yii::$app->urlManager->createUrl(['/movies/view', 'id' =>$moviesItem->id])?>">
                            <?=Html::img(Url::to($moviesItem->release_preview_image, true), ['alt' => $moviesItem->release_name_ru])?>
                        </a>
                    </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Break -->
                </div>
            </div>
        </section>

    </div>
</div>