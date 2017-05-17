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

            <div class="row">
                <header class="major">
                    <?=Html::img('@web/images/tv/one.jpg', ['height' => 120, 'width' => 120]) ?>
                </header>

                <div class="u8 12u$(small)">
                    <div class="b-tv-page-online-player js-online-player">
                        <iframe allowfullscreen="allowfullscreen" src="https://stream.1tv.ru/embed" scrolling="no" frameborder="no" style="width: 640px; height: 380px; background-color: rgb(0, 0, 0); background-position: initial initial; background-repeat: initial initial;">

                        </iframe>
                    </div>
                </div>
                <div class="u4 12u$(small)">
                    teleprogramm
                </div>
            </div>
        </section>

    </div>
</div>

