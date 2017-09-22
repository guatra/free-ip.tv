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

//$this->title = $model->release_name_ru .', Сезон '.$season .' Серия '.$episode.', '. $query_episode->episode_title;
?>
<section class="nav-top">
    <?php
    NavBar::begin([
        'brandLabel' =>  $model->release_name_ru,
        'brandUrl' => Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$model->id]),
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top',
        ],
    ]);
    for ($i=1; $i <= $model->release_totalseasons ; $i++) {
        $menuItemsInSide[] = ['label' => Yii::t('frontend', 'APP_SEASON').' '.$i, 'url' => ['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => 1], 'linkOptions' => []];
    }
    $menuItems = [
        [
            'label' => 'Сезоны',
            'items' => $menuItemsInSide,
        ],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</section>
<section class="video-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <?php $image = Url::to(['@lostfilm/Images/'.$model->id.'/Posters/poster.jpg'],'https'); ?>
                <div class="container" style="background-image: url(<?= $image ?>) center no-reapet">
                    <div class="embed-responsive embed-responsive-16by9 video-js-responsive-container vjs-hd">
                        <div poster=<?= $image ?> preload="none" class="video-js vjs-sublime-skin vjs-paused vjs-controls-enabled vjs-workinghover vjs-user-inactive" id="player" role="region" aria-label="video player" tabindex="-1" style="outline: none;">
                    <?php
                    if ($query_episode->episode_url)
                        $url_episode = ['src' => Url::to($query_episode->episode_url , true), 'type' => 'video/mp4'];
                    else
                        $url_episode =  ['src' => Url::to($release_full->release_trailer , true), 'type' => 'video/mp4'];
                    ?>
                    <?= VideoJsWidget::widget([
                        'options' => [
                            'class' => 'video-js vjs-fluid videojs-sublime-skin',
                            'poster' => $image,
                            'width' => 'auto',
                            'height' => 'auto',
                            'autoplay' => false,
                            'controls' => true,
                        ],
                        'jsOptions' => [
                            'preload' => 'auto',
                        ],
                        'tags' => [
                            'source' => [
                                $url_episode

                                //            ['src' => Url::to($query_episode->episode_url , true), 'type' => 'video/mp4'],
                                //            ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],
                                //            ['src' => 'http://vjs.zencdn.net/v/oceans.webm', 'type' => 'video/webm']
                            ],
//                            'track' => [
//                                ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'en', 'label' => 'English'],
//                                ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'ru', 'label' => 'Russian']
//                            ]
                        ]
                    ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row links">
            <div class="col-xs-6 text-center">
                <?php if ($episode == 1 AND $season == 1): ?>

                    <?= Html::a(Icon::show('long-arrow-left', ['class' => 'icon'], Icon::FA).' '.Yii::t('frontend', 'APP_PREVIOUS_SERIES'), Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => 1]), ['class' => 'btn disabled']) ?>


                <?php elseif ( $episode == 1 AND 1 < $season ): ?>

                    <?= Html::a(Icon::show('long-arrow-left', ['class' => 'icon'], Icon::FA).' '.Yii::t('frontend', 'APP_PREVIOUS_SEASON'), Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season - 1, 'episode' => $last_season]), ['class' => 'btn']) ?>

                <?php elseif ($episode == 1): ?>

                    <?= Html::a(Icon::show('long-arrow-left', ['class' => 'icon'], Icon::FA).' '.Yii::t('frontend', 'APP_PREVIOUS_SERIES'), Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => 1]), ['class' => 'btn']) ?>

                <?php else: ?>

                    <?= Html::a(Icon::show('long-arrow-left', ['class' => 'icon'], Icon::FA).' '.Yii::t('frontend', 'APP_PREVIOUS_SERIES'), Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode - 1]), ['class' => 'btn']) ?>

                <?php endif ?>
            </div>
            <div class="col-xs-6 text-center">
                <?php if ($episode == $release_count AND $season == $release_full->release_totalseasons): ?>

                    <?= Html::a(Yii::t('frontend', 'APP_NEXT_SEASON_END').' '.Icon::show('long-arrow-right', ['class' => 'icon'], Icon::FA), Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season + 1, 'episode' => $episode]), ['class' => 'btn disabled']) ?>

                <?php elseif ($episode == $release_count): ?>

                    <?= Html::a(Yii::t('frontend', 'APP_NEXT_SEASON').' '.Icon::show('long-arrow-right', ['class' => 'icon'], Icon::FA), Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season + 1, 'episode' => 1]), ['class' => 'btn']) ?>

                <?php else: ?>

                    <?= Html::a(Yii::t('frontend', 'APP_NEXT_SERIES').' '.Icon::show('long-arrow-right', ['class' => 'icon'], Icon::FA), Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode + 1]), ['class' => 'btn']) ?>

                <?php endif ?>
            </div>
        </div>
        <h1 class="serial-title">
            <?= $model->release_name_ru ?> <span itemprop="partOfSeason"><?= $season ?></span> <?=Yii::t('frontend', 'APP_SEASON')?>
            <span itemprop="episodeNumber"><?= $episode ?></span> <?= Yii::t('frontend', 'APP_SEASON_SERIES')?>
            <br><?= $query_episode->episode_title?>
        </h1>
        <div class="episode-description" itemprop="description">
            <p>
                <?php if ($query_episode->episode_plot == NULL): ?>
                    <?php echo Yii::t('app', 'Нет описания серии')?>
                <?php else: ?>
            <div  oncontextmenu="return false;" style="user-select: none;-moz-user-select: none;-webkit-user-select: none">
                <?= $query_episode->episode_plot ?>
            </div>
            <?php endif; ?>
            </p>
        </div>
    </div>
</section>
<div class="breadcrumbs-container">
    <div class="container">
        <ul class="breadcrumb">
            <li class="hidden-xs"><?= Html::a(Yii::t('frontend', 'APP_SERIES'), ['/series/index'], ['class' => 'user-series']) ?></li>
            <li><?= Html::a($model->release_name_ru, Yii::$app->urlManager->createUrl(['/release/index', 'id' => $id]), ['class' => '']) ?></li>
            <li><?= Html::a(Yii::t('frontend', 'APP_SEASON').' '.$season, Yii::$app->urlManager->createUrl(['/release/index', 'id' => $id, 'season' => $season ]), ['class' => '']) ?></li>
            <li class="active"><?=Yii::t('frontend', 'APP_SEASON_SERIES').' '.$episode ?></li>
            <li class="hidden-xs active"><?=$query_episode->episode_title ?></li>
        </ul>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3><?=Yii::t('frontend', 'APP_ALL_SEASON_SERIES').' '.$season; ?> сезона</h3>
        </div>
    </div>
    <div class="row">
        <?php foreach ($release as $releaseItem): ?>
            <div class="col-sm-6 col-md-4 episode <?php if($releaseItem->episode_season == $season AND $releaseItem->episode_season_number == $episode){echo 'active';}?>">
                <a href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $releaseItem->episode_season_number ])?>">
                    <div class="thumbnail">
                        <img src=<?php echo URL::to(["@web/uploads/Images/".$id."/Posters/e_".$releaseItem->episode_season."_".$releaseItem->episode_season_number.".jpg"],true); ?> alt="">
                        <div class="content">
                            <div class="title">
                                <?= Yii::t('frontend', 'APP_SEASON') ?> <?= $releaseItem->episode_season; ?>,
                                <?= Yii::t('frontend', 'APP_SEASON_SERIES') ?> <?= $releaseItem->episode_season_number; ?> </div>
                            <div class="subtitle">
                                <?= $releaseItem->episode_title; ?></div>
                        </div>
                        <div class="duration"><?= $releaseItem->episode_runtime; ?> <?= Yii::t('frontend', 'APP_MIN') ?></div>
                        <div class="play-button"></div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</div>
</section>
<?php //foreach ($release as $releaseItem): ?>
<!--    --><?php //if ( $releaseItem->episode_season_number <=9 )
//    {
//        $i = '0'.$releaseItem->episode_season_number;
//    }else {
//    $i = $releaseItem->episode_season_number;}
//    ?>
<!--    --><?php //echo 'ln -s "/var/www/html/tv_show/'. $model->release_name_ru .'/' . $releaseItem->episode_season . '-' . $i . ' ' . $releaseItem->episode_title . '.mp4" /var/www/html/tv_show_all/' . $releaseItem->episode_url . '.mp4'; ?><!--<br>-->
<?php //endforeach ?>






