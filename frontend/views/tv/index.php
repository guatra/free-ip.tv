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
                <div class="col-xs-12">
                    <?php debug($data) ?>
                </div>
            </div>
        </section>
        <section>

            <div class="row">
                 <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                     <?php for ($i=1; $i <= $data['count']; $i++):?>

                         <?= Html::a(Html::img('@web/images/tv/'.$data['image'][$i].'.jpg'), Yii::$app->urlManager->createUrl(['/tv/'.$data['menu'][$i]]), ['class' => $data['image']]) ?>

                     <?php endfor; ?>
                 </div>

            </div>
    </section>

    </div>
</div>

