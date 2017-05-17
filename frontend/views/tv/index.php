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

                    <?= Html::a(Html::img('@web/images/tv/one.jpg'), '/tv/one', ['class' => 'one']) ?>
                </header>
                <header class="major">

                    <?= Html::a(Html::img('@web/images/tv/ntv.jpg'), '/tv/ntv', ['class' => 'ntv']) ?>
                </header>

            </div>
    </section>

    </div>
</div>

