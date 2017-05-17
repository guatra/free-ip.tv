<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\bootstrap\Carousel;
use yii\helpers\Url;

$poster="//img2.ntv.ru/live/live.jpg?_1495009218";
$src="//mob3-ntv.cdnvideo.ru/ntv/airstream0011/playlist.m3u8?e=1495614013&amp;md5=DtEJ_U546dcadyfr6ac3Og";
?>
<!-- Main -->
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

            <div class="row">
                <header class="major">
                    <?=Html::img('@web/images/tv/ntv.jpg', ['height' => 120, 'width' => 120]) ?>
                </header>

                <div class="u8 12u$(small)">
                    <video controls poster=<?= $poster ?> src= <?= $src ?> style="width: 100%; height: 100%;">
                    </video>
                </div>
                <div class="u4 12u$(small)">
                    teleprogramm
                </div>
            </div>
        </section>

    </div>
</div>

