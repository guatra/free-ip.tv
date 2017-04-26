<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;

?>
<section class="nav-top">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('frontend', 'APP_SERIALS'),
        'brandUrl' => Yii::$app->urlManager->createUrl(['/serials/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        [
            'label' => 'Медиатека',
            'items' => '',
        ],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</section>

<div class="serials-index">

    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 sidebar-right">

            <div class="view">

                <div class="btn-toolbar center-block" role="toolbar">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default"><?= Icon::show('th')?></span></button>
                        <button type="button" class="btn btn-default"><?= Icon::show('align-justify')?></button>
                    </div>
                </div>

            </div>

            <div class="sort">
                <h5>Медиатека</h5>

                <details open>
                    <summary>скрыть</summary>
                    <ul class="list-group">
                        <li class="list-group-item"><?= Yii::t('frontend', 'Последние добавления') ?></li>
                        <li class="list-group-item"><?= Yii::t('frontend', 'APP_SERIALS') ?></li>
                        <li class="list-group-item"><?= Yii::t('frontend', 'Выпуски') ?></li>
                        <li class="list-group-item"><?= Yii::t('frontend', 'Жанры') ?></li>
                    </ul>
                </details>

            </div>
            <div class="favorits">
                <h5>Избранные сериалы</h5>
                <details open>
                    <summary>скрыть</summary>
                    <ul class="list-group">
                        <li class="list-group-item"><?= Yii::t('frontend', 'Последние добавления') ?></li>
                        <li class="list-group-item"><?= Yii::t('frontend', 'APP_SERIALS') ?></li>
                        <li class="list-group-item"><?= Yii::t('frontend', 'Выпуски') ?></li>
                        <li class="list-group-item"><?= Yii::t('frontend', 'Жанры') ?></li>
                    </ul>
                </details>
            </div>
            <div class="playlist" id="main-left-side">
                <h5>Все плейлисты</h5>
                <details open>
                    <summary>скрыть</summary>
                    <div class="btn-group-vertical">
                        <button type="button" class="btn btn-default">
                            <a class="text-block" style="cursor:pointer" href="/series/134">
                                <?php echo Html::img(Url::to(['@lostfilm/Images/134/Posters/icon.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'thumb'])?>

                                <div class="body">
                                    <div class="title-ru">Ходячие мертвецы</div>
                                    <div class="title-en">The Walking Dead</div>
                                </div>
                            </a>
                        </button>

                        <button type="button" class="btn btn-default">
                            <a class="text-block" style="cursor:pointer" href="/series/The_100">
                                <?php echo Html::img(Url::to(['@lostfilm/Images/207/Posters/icon.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'thumb'])?>

                                <div class="body">
                                    <div class="title-ru">Сотня</div>
                                    <div class="title-en">The 100</div>
                                </div>
                            </a>
                        </button>
                    </div>
                </details>
            </div>





        </div>

        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10" style="background-color: snow">

                <div class="row">

                    <?php foreach ($serials as $serialsItem): ?>
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="image">

                            <a class="" href="<?=Yii::$app->urlManager->createUrl(['/serials/view', 'id' =>$serialsItem->id])?>">

                                <?php echo Html::img(Url::to(['@lostfilm/Images/'.$serialsItem->id.'/Posters/image.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
                                <?php //echo Html::img(Yii::$app->urlManager->createUrl(['/images/serials/'.$serialsItem->id.'/front.jpg']), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
                            </a>

                        </div>
                        </div>
                    <?php endforeach; ?>
                </div>

        </div>

    </div>

</div>
<section class="nav-bottom">
    <?php
    NavBar::begin([
        'brandLabel' => 'free-ip.tv',
        'brandUrl' => Yii::$app->urlManager->createUrl(['/site/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-bottom',
        ],
    ]);
    $menuItems = [
        //['label' => 'Home', 'url' => ['/site/index']],
        //['label' => 'Serials', 'url' => ['/serials/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</section>