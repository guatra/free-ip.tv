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
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <?=Html::img('@web/images/tv/one.jpg', [ 'class' => 'img-responsiv']) ?>
                    </div>

                    <div class="col-xs-10 col-md-8">

                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">


                            <iframe class="embed-responsive-item" allowfullscreen="allowfullscreen" src="https://stream.1tv.ru/embed" scrolling="no" frameborder="no" style="background-color: rgb(0, 0, 0); background-position: initial initial; background-repeat: initial initial;">

                            </iframe>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        teleprogramm
                    </div>
                </div>
            </div>

        </section>

    </div>
</div>

