<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use wbraganca\videojs\VideoJsWidget;
use kartik\icons\Icon;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\FileHelper;
?>
<section class="nav-top">
        <?php
        NavBar::begin([
            'brandLabel' =>  Yii::t('frontend', 'APP_MOVIES'),
            'brandUrl' => Yii::$app->urlManager->createUrl(['/movies/index']),
            'options' => [
                'class' => 'navbar navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItemsInSide[] = ['label' => Yii::t('frontend', 'APP_MOVIES'), 'url' => ['/movies/index']];
        $menuItems = [
            [
                'label' => 'Сезоны',
                'items' => $menuItemsInSide,
            ],
        ];

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                [
                    'label' => Yii::t('frontend', 'APP_USER_MENU'),
                    'items' => [
                        '<li class="dropdown-header"></li>',
                        ['label' => Yii::t('frontend', 'APP_MOVIES'), 'url' => ['/movies/index']],
                        '<li class="divider"></li>',
                        ['label' => Yii::t('frontend', 'APP_SERIALS'), 'url' => ['/series/index']],
                    ],
                ],
            ],
        ]);
        NavBar::end();
        ?>
    </section>
<section class="video-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="embed-responsive embed-responsive-16by9">
                    <?php
                    if ($data["url"])
                        $url = ['src' => Url::to($data["url"], true), 'type' => 'video/mp4'];
                    else
                        $url =  ['src' => Url::to($data["trailer"] , true), 'type' => 'video/mp4'];
                    ?>
                    <?= VideoJsWidget::widget([
                        'options' => [
                            'class' => 'embed-responsive-item video-js vjs-fluid vjs-big-play-centered',
                            'poster' => "http://video-js.zencoder.com/oceans-clip.png",
                            'width' => '640',
                            'height' => '264',
                            'autoplay' => false,
                            'controls' => true,
                        ],
                        'jsOptions' => [
                            'preload' => 'auto',
                        ],
                        'tags' => [
                            'source' => [
                                    $url
//                                ['src' => Url::to($data["url"] , true), 'type' => 'video/mp4']
//            ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],
//            ['src' => 'http://vjs.zencdn.net/v/oceans.webm', 'type' => 'video/webm']
                            ],
                            'track' => [
                                ['kind' => 'captions', 'src' => 'http://localhost:8888/track/12.Monkeys.s01e01.XviD.DD5.1.LostFilm.srt', 'srclang' => 'ru', 'label' => 'Русский']
                            ]
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="movie-title" >
            <?= $data["movie"]["episode_title"] ?>
        </h1>
        <div class="movie-description" itemprop="description">
            <p>
                <?php if ($data["movie"]["episode_plot"] == NULL): ?>
                    <?php echo Yii::t('app', 'Нет описания серии')?>
                <?php else: ?>
            <div oncontextmenu="return false;" style="user-select: none;-moz-user-select: none;-webkit-user-select: none">
                <?= $data["movie"]["episode_plot"] ?>
            </div>
            <?php endif; ?>
            </p>
        </div>
    </div>
</section>
<div class="breadcrumbs-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?=Yii::$app->urlManager->createUrl(['/movies/index'])?>"><?= Yii::t('frontend', 'APP_MOVIES')?></a></li>
             <li class="active"><?= $data["movie"]["episode_title"] ?></li>
        </ul>
    </div>
</div>
<a href="<?= $data["url"]?>"><?= $data["url"]?></a>