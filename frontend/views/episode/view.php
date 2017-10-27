<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use wbraganca\videojs\VideoJsWidget;
use kartik\icons\Icon;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Tabs;
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
        $i == $season ? $isItemActive = ['active' => 1] : $isItemActive = [];
        $menuItemsInSide[] =
            [
                'label' => Yii::t('frontend', 'APP_SEASON').' '.$i,
                'url' => ['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => 1],
               //'linkOptions' => [],
                $isItemActive
            ];
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

                <?php $image = Url::to(['@web/uploads/Images/'.$model->id.'/Posters/poster.jpg'],true); ?>
                <?php $image = Url::to(["@web/uploads/Images/".$model->id."/Posters/e_".$season."_".$episode.".jpg"],true); ?>
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
    <div class="container" itemscope itemtype="http://schema.org/TVEpisode">
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
            <span itemprop="name"><?= $query_episode->episode_title ?></span>
        </h1>
        <div class="episode-description" itemprop="description">
            <p>
                <?php if ($query_episode->episode_plot == NULL): ?>
                    <?php echo Yii::t('frontend', 'APP_NO_DESCRIPTION_OF_THE_SERIES')?>
                <?php else: ?>
            <div  oncontextmenu="return false;" style="user-select: none;-moz-user-select: none;-webkit-user-select: none">
                <?= $query_episode->episode_plot ?>
            </div>
            <?php endif; ?>
            </p>
        </div>
    </div>
</section>
<div class="breadcrumbs-container hidden-xs">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a(Yii::t('frontend', 'APP_SERIES'), ['/series/index'], ['class' => 'user-series']) ?></li>
            <li><?= Html::a($model->release_name_ru, Yii::$app->urlManager->createUrl(['/release/view', 'id' => $id]), ['class' => '']) ?></li>
            <li><?= Html::a(Yii::t('frontend', 'APP_SEASON').' '.$season, Yii::$app->urlManager->createUrl(['/release/index', 'id' => $id, 'season' => $season ]), ['class' => '']) ?></li>
            <li class="active"><?=Yii::t('frontend', 'APP_SEASON_SERIES').' '.$episode ?></li>
            <li class="active"><?=$query_episode->episode_title ?></li>
        </ul>
    </div>
</div>
<div class="breadcrumbs-container hidden-md hidden-sm hidden-lg">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a(Yii::t('frontend', 'APP_SEASON').' '.$season, Yii::$app->urlManager->createUrl(['/release/index', 'id' => $id, 'season' => $season ]), ['class' => '']) ?></li>
            <li class="active"><?=Yii::t('frontend', 'APP_SEASON_SERIES').' '.$episode ?></li>
        </ul>
    </div>
</div>
<div class="block-change" style="height: 50px"></div>
<section class="cast-container">
    <div class="container">
    <div class="row links">
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified">
                <li class="active"><a href="#series" data-toggle="pill"><?=Yii::t('frontend', 'APP_ALL_SEASON_SERIES').' '.$season; ?> сезона</a></li>
                <li><a href="#cast" data-toggle="pill"><?=Yii::t('frontend', 'APP_CAST') ?></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="series">
                    <div class="block-change" style="height: 50px"></div>
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
                <div class="tab-pane fade" id="cast">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <ul class="nav nav-pills nav-stacked ">
                                <div class="block-change" style="height: 50px"></div>
                                <li class="active"><a href="#home" data-toggle="pill"><?=Yii::t('frontend', 'APP_Все') ?></a></li>
                                <li><a href="#actors" data-toggle="pill"><?=Yii::t('frontend', 'APP_Актеры') ?></a></li>
                                <li><a href="#director" data-toggle="pill"><?=Yii::t('frontend', 'APP_Режиссеры') ?></a></li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                <div class="row">
                                    <h1>Home</h1>
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
                                <div class="tab-pane fade" id="actors">
                                <div class="row">
                                    <h1>Actors</h1>
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
                                <div class="tab-pane fade" id="director">
                                <div class="row">
                                    <h1>Director</h1>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="content">-->
<!--                        <div class="left-side-block">-->
<!--                            <div class="header">выбрать профессию:</div>-->
<!--                            <div class="menu-body">-->
<!--                                <div class="item active" onclick="goTo('/series/Dirk_Gentlys_Holistic_Detective_Agency/season_2/episode_1/cast',false)">Все</div>-->
<!--                                <div class="item " onclick="goTo('/series/Dirk_Gentlys_Holistic_Detective_Agency/season_2/episode_1/cast/type_1',false)">Актеры</div>-->
<!--                                <div class="item " onclick="goTo('/series/Dirk_Gentlys_Holistic_Detective_Agency/season_2/episode_1/cast/type_2',false)">Режиссеры</div>-->
<!--                                <div class="item " onclick="goTo('/series/Dirk_Gentlys_Holistic_Detective_Agency/season_2/episode_1/cast/type_3',false)">Продюсеры</div>-->
<!--                                <div class="item " onclick="goTo('/series/Dirk_Gentlys_Holistic_Detective_Agency/season_2/episode_1/cast/type_4',false)">Сценаристы</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="center-block margin-left">-->
<!--                            <div class="text-block persons">-->
<!--                                <div class="body">-->
<!--                                    <div style="margin-top:-10px;"></div>-->
<!--                                    <div class="hor-breaker dashed"></div>-->
<!--                                    <div class="header-simple">Актеры</div>-->
<!--                                    <a href="/persons/Dustin_Milligan" class="row">-->
<!--                                        <img src="//static.lostfilm.tv/Names/1/3/4/t13459.jpg" class="aload thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Дастин Миллиган</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Dustin Milligan</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Сержант Хьюго Фрикин</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Sgt. Hugo Friedkin</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Elijah_Wood" class="row">-->
<!--                                        <img src="//static.lostfilm.tv/Names/4/8/4/t48436.jpg" class="aload thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Элайджа Вуд</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Elijah Wood</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Тодд Бротцман</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Todd</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Samuel_Barnett" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/7/2/2/t72258.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Сэмюэл Барнетт</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Samuel Barnett</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Дирк Джентли</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Dirk Gently</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id77835" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/7/7/8/t77835.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Джейд Эшете</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Jade Eshete</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Фара Блэк</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Farah Black</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Hannah_Marks" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/8/1/0/t8109.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Ханна Маркс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Hannah Marks</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Аманда Бротцман</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Amanda Brotzman</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/John_Stewart" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/8/7/1/t8713.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Джон Стюарт</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">John Stewart</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Боб Боретон</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Bob Boreton</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Osric_Chau" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/3/8/8/t38821.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Осрик Чау</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Osric Chau</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Фогель</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Vogel</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Aleks_Paunovic" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/1/9/8/t198.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Алекс Паунович</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Aleks Paunovic</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Вайгар Оук</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Wygar Oak</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Zak_Santiago" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/3/9/6/t396.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Зак Сантьяго</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Zak Santiago</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Кросс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Cross</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Mpho_Koaho" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/4/5/0/t45036.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Мфо Коахо</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Mpho Koaho</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Кен</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Ken</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Lee_Majdoub" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/2/5/7/t25725.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Ли Мадждуб</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Lee Majdoub</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Сайлас Дэнгдамор</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Silas Dengdamor</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id77834" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/7/7/8/t77834.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Фиона Дуриф</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Fiona Dourif</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Барт Кёрлиш</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Bart Curlish</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Alan_Tudyk" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/4/1/0/t4102.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Алан Тьюдик</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Alan Tudyk</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Mr. Priest /               Austin Priest</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Mr. Priest /               Austin Priest</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Viv_Leacock" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/2/5/5/t25591.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Вив Ликок</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Viv Leacock</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Гриппс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Gripps</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Michael_Eklund" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/7/4/3/t7435.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Майкл Эклунд</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Michael Eklund</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Мартин</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Martin</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/John_Hannah" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/1/5/2/t15275.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Джон Ханна</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">John Hannah</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Маг</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Mage</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Alexia_Fast" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/7/6/0/t7602.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Алексия Фаст</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Alexia Fast</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Mona Wilder</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Mona Wilder</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Amitai_Marmorstein" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/1/6/8/t16841.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Амитай Мэрморштейн</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Amitai Marmorstein</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Помощник лейтенанта</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Lieutenant Assistent</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Amanda_Walsh" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/8/0/8/t8089.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Аманда Уолш</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Amanda Walsh</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Susie Boreton</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Susie Boreton</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id59403" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/5/9/4/t59403.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Нимиш Парех</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Neemish Parekh</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Telecommunications Worker</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Telecommunications Worker</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id89851" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/8/9/8/t89851.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Иззи Стил</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Izzy Steel</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Помощник шерифа Тина Тэветино</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Tina Tevetino /               Deputy Tevetino</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id68889" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/6/8/8/t68889.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Тайлер Лабин</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Tyler Labine</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Шериф Шерлок Хоббс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Sherlock Hobbs /               Sheriff Hobbs</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Jared_AgerFoster" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Джаред Аджер-Фостер</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Jared Ager-Foster</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Scott Boreton</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Scott Boreton</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id90349" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/9/0/3/t90349.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Иззи Штиль</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Izzie Steele</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Тина Тэветино</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Tina Tevetino</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id77837" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/7/7/8/t77837.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Бентли</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Bentley</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Корги Рапунцель</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Rapunzel the Corgi</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id66074" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Роберт Корнесс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Robert Corness</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Проект Молох</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Project Moloch</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Sean_Campbell" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/8/6/4/t8648.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Шон Кэмпбелл</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Sean Campbell</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Дэн Сэмюэлс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Dan Samuels</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Jesse_Lipscombe" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Джесси Липскомб</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Jesse Lipscombe</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Эдди Блэк</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Eddie Black</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Daniel_Boileau" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/2/8/1/t281.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Дэниэл Бойло</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Daniel Boileau</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Охранник</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Security Guard</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Darcy_Hinds" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/4/4/2/t4424.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Дарси Хиндс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Darcy Hinds</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Dengdamor</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Dengdamor</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Christopher_Russell" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/6/9/5/t695.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Кристофер Расселл</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Christopher Russell</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Панто Трост</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">Panto Trost</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <div class="hor-breaker dashed"></div>-->
<!--                                    <div class="header-simple">Режиссеры</div>-->
<!--                                    <a href="/persons/Douglas_Mackinnon" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Дуглас Маккиннон</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Douglas Mackinnon</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Режиссер</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">director</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <div class="hor-breaker dashed"></div>-->
<!--                                    <div class="header-simple">Продюсеры</div>-->
<!--                                    <a href="/persons/id89645" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Зо Нири</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Zoe Neary</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">producers' assistant</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">producers' assistant</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id77843" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Рик Джейкобс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Rick Jacobs</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Продюсер</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">producer</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/Chris_Foss" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Крис Фосс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Chris Foss</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Продюсер</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">producer</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <div class="hor-breaker dashed"></div>-->
<!--                                    <div class="header-simple">Сценаристы</div>-->
<!--                                    <a href="/persons/id90498" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Сайнид Дэли</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Sinead Daly</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Сценарист</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">writers</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id78506" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="thumb">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Молли Нуссбаум</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Molly Nussbaum</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Сценарист</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">writers</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id77839" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/7/7/8/t77839.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Макс Лэндис</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Max Landis</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Сценарист</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">writers</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                    <a href="/persons/id77838" class="row">-->
<!--                                        <img src="/vision/no-photo_thumb.jpg" class="aload thumb" autoload="//static.lostfilm.tv/Names/7/7/8/t77838.jpg">-->
<!--                                        <div class="body">-->
<!--                                            <div class="name-ru">Дуглас Адамс</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="name-en">Douglas Adams</div>-->
<!--                                        </div>-->
<!--                                        <div class="role-pane">-->
<!--                                            <div class="role-ru">Сценарист</div>-->
<!--                                            <div class="clr"></div>-->
<!--                                            <div class="role-en">writers</div>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                    <div class="clr"></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!--            --><?php
//            echo Tabs::widget([
//                'items' => [
//                    [
//                    'label' => Yii::t('frontend', 'APP_ALL_SEASON_SERIES').' '.$season.' сезона',
//                    'content' => 'Anim pariatur cliche...',
//                    'active' => true
//                    ],
//                    [
//                    'label' => Yii::t('frontend', 'APP_CAST'),
//                    'content' => 'Anim pariatur clicheghkjgkdfdkkkgkf.',
//                    'headerOptions' => [],
//                    'options' => ['id' => 'ca', 'itemprop' => 'name'],
//                    ],
//                ],
//            ]);
//            ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->





