<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\bootstrap\Carousel;
use yii\helpers\Url;


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
            <header class="major">
                <h2>НТВ</h2>
            </header>
            <div style="position: relative; width: 100%; height: 100%;">
                <video controls poster="//img2.ntv.ru/live/live.jpg?_1494845966" src="//mob3-ntv.cdnvideo.ru/ntv/airstream0011/playlist.m3u8?e=1495450765&amp;md5=U2Lm1WXB8aOPm6clob2Ehg" style="width: 100%; height: 100%;">
                </video>
            </div>
        </section>

    </div>
</div>

