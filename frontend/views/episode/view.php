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
        $menuItemsInSide[] = ['label' => 'Сезон '.$i, 'url' => ['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => 1], 'linkOptions' => []];
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
            <div class="col-xs-12 col-sm-8 col-md-8">

                <?php $image = Url::to(['@lostfilm/Images/'.$model->id.'/Posters/poster.jpg'],'https'); ?>
                <div class="container" style="background-image: url(<?= $image ?>) center no-reapet">
                    <?php
                    if ($query_episode->episode_url)
                        $url_episode = ['src' => Url::to($query_episode->episode_url , true), 'type' => 'video/mp4'];
                    else
                        $url_episode =  ['src' => Url::to($trailer->release_trailer , true), 'type' => 'video/mp4'];
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
                            'track' => [
                                ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'en', 'label' => 'English'],
                                ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'ru', 'label' => 'Russian']
                            ]
                        ]
                    ]); ?>
                </div>




            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">

                <div class="row">
                    <button>1</button>
                    <button>2</button>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row links">
            <div class="col-xs-6 text-center">
                <?php if ($episode == 1): ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => 1])?>">
                        ← Предыдущая серия
                    </a>
                <?php else: ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode-1])?>">
                        ← Предыдущая серия
                    </a>
                <?php endif ?>
            </div>
            <div class="col-xs-6 text-center">
                <?php if ($episode == 10 ): ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode])?>">
                        Следующая серия →
                    </a>
                <?php else: ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode+1])?>">Следующая серия →
                    </a>
                <?php endif ?>
            </div>
        </div>
        <h1 class="serial-title">
            <?= $model->release_name_ru ?> <span itemprop="partOfSeason"><?= $season ?></span> сезон
            <span itemprop="episodeNumber"><?= $episode ?></span> серия
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
            <li><a href="<?=Yii::$app->urlManager->createUrl(['/series/index'])?>">TV SHOWS</a></li>
            <li><a href="<?=Yii::$app->urlManager->createUrl(['/release/index', 'id' => $id])?>"><?= $model->release_name_ru ?></a></li>
            <li><a href="<?=Yii::$app->urlManager->createUrl(['/release/index', 'id' => $id, 'season' => $season ])?>">Сезон <?= $season ?></a></li>
            <li class="active">Серия <?= $episode ?></li>
        </ul>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Все серии <?php echo $season; ?> сезона</h3>
        </div>
    </div>
    <div class="row">
        <?php foreach ($release as $releaseItem): ?>
            <div class="col-sm-6 col-md-4 episode <?php if($releaseItem->episode_season == $season AND $releaseItem->episode_season_number == $episode){echo 'active';}?>">
                <a href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $releaseItem->episode_season_number ])?>">
                    <div class="thumbnail">
                        <img src="https://static.lostfilm.tv/Images/<?php echo $id; ?>/Posters/e_<?php echo $releaseItem->episode_season; ?>_<?php echo $releaseItem->episode_season_number; ?>.jpg" alt="">
                        <div class="content">
                            <div class="title">
                                Сезон <?php echo $releaseItem->episode_season; ?>,
                                Серия <?php echo $releaseItem->episode_season_number; ?> </div>
                            <div class="subtitle">
                                <?php echo $releaseItem->episode_title; ?></div>
                        </div>
                        <div class="duration"><?php echo $releaseItem->episode_runtime; ?> мин</div>
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






