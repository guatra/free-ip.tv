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
                    <div class="col-xs-2 col-md-2">
                        <?=Html::img('@web/images/tv/one.jpg', [ 'class' => 'img-responsive']) ?>
                        <?=Html::img('@web/images/tv/ntv.jpg', [ 'class' => 'img-responsive']) ?>
                    </div>

                    <div class="col-xs-10 col-md-8">

                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">


                            <iframe class="embed-responsive-item" allowfullscreen="allowfullscreen" src="https://stream.1tv.ru/embed" scrolling="no" frameborder="no" style="background-color: rgb(0, 0, 0); background-position: initial initial; background-repeat: initial initial;">

                            </iframe>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-md-12">
                        <p><h6>В телепрограмме указано московское время.</h6></p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <td class="hidden-xs">111</td>
                                    <td>112</td>
                                    <td>113</td>
                                </tr>
                                <tr>
                                    <th class="hidden-xs">121</th>
                                    <th>122</th>
                                    <th>123</th>
                                </tr>
                                <tr>
                                    <td class="hidden-xs">111</td>
                                    <td>112</td>
                                    <td>113</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</div>

