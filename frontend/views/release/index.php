<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;
// TODO Это будет страница с простым описанием по каждому из сезонов
?>

<section class="nav-top">
    <?php
    NavBar::begin([
        'brandLabel' => $model->release_name_ru,
        'brandUrl' => Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$model->id]),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    for ($i=1; $i <= $model->release_totalseasons ; $i++) {
        $menuItemsInSide[] = ['label' => 'Сезон '.$i, 'url' => ['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => 1]];
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
<section class="serial">
    <div itemscope="" itemtype="http://schema.org/TVSeries">
        <div class="spoiler">
            <div class="bg"></div>
            <div class="bg" style="background-image: url(<?=$poster?>)"></div>
            <div class="container">
                <div class="row">
                    <h1>
                        Смотреть онлайн сериал<br>
                        <span class="name"><?=$model->release_name_ru?></span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="home">

            <div class="container">
                <div class="row">
                    <div class="col-md-3 hidden-xs hidden-sm">
                        <?=Html::img(Url::to(['@lostfilm/Images/'.$model->id.'/Posters/shmoster_s'.$model->release_totalseasons.'.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>

                    </div>
                    <div class="col-md-9">
                        <table class="table table-responsive">
                            <tbody>
                            <tr>
                                <td>Оригинальное название</td>
                                <td itemprop="name"><?=$model->release_name_en?></td>
                            </tr>
                            <tr>
                                <td>Сезон</td>
                                <td itemprop="containsSeason" itemscope="" itemtype="http://schema.org/TVSeason">
                                    <?php echo Html::a($season.' сезон', ['/episode/view', 'id' => $model->id, 'season' => $season, 'episode' => '1' ], ['itemprop' => 'name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Год выпуска</td>
                                <td>
                                    <?php date('Y', $model->release_released); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Жанр</td>
                                <td itemprop="genre"><?=$model->release_genre?></td>
                            </tr>
                            <tr>
                                <td>Режиссёр</td>
                                <td itemprop="directors"><?=$model->release_director?></td>
                            </tr>
                            <tr>
                                <td>Актерский состав</td>
                                <td><?=$model->release_actors?></td>
                            </tr>
                            <tr>
                                <td>Описание</td>
                                <td><?=$model->release_plot?></td>
                            </tr>
                            </tbody></table>
                        <div class="row">
                            <div class="col-sm-6 rating kp">
                                <div class="pull-left">
                                    <?= Icon::show('imdb', ['class' => 'fa-3x'], Icon::FA) ?>

                                </div>
                                <div class="pull-left">
                                    <div class="value"><?=$model->release_lostfilmrating?></div>
                                </div>
                            </div>
                            <div class="col-sm-6 rating imdb">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row description" itemprop="about">
                    <div class="col-md-12">
                        <div class="breadcrumbs-container">
                            <div class="container">
                                <ul class="breadcrumb">
                                    <li><a href="<?=Yii::$app->urlManager->createUrl(['/series/index'])?>">TV SHOWS</a></li>
                                    <li><a href="<?=Yii::$app->urlManager->createUrl(['/release/index', 'id' => $id])?>"><?= $model->release_name_ru ?></a></li>
                                    <li class="active"><a href="<?=Yii::$app->urlManager->createUrl(['/release/index', 'id' => $id, 'season' => $season ])?>">Сезон <?= $season ?></a></li>
                                </ul> </div>
                        </div>
                    </div>
                </div>
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
                    <div class="col-sm-6 col-md-3 episode">
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
        <div class="latest">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <h3>Сезоны Сериала</h3>
                    </div>
                </div>
                <div class="row">
                    <?php
                    for ($i=1; $i <= $model->release_totalseasons ; $i++) {
                        if (Html::img(Yii::$app->urlManager->createUrl(['/images/series/'.$model->id.'/'.$i.'.jpg'])) !== null):
                            echo '
    										<div class="col-xs-6 col-sm-6 col-md-3 episode" itemprop="containsSeason" itemscope="" itemtype="http://schema.org/TVEpisode">
    								<meta itemprop="containsSeason" content="'.$model->release_totalseasons.'">
    								<a href="'.Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => '1']).'" itemprop="url">
    									<div class="thumbnail">';
                            // Вот в этом месте воруем у LOSTFILM.TV
                            echo Html::img(Url::to(['@lostfilm/Images/'.$model->id.'/Posters/shmoster_s'.$i.'.jpg'],'https'), ['alt' => $model->release_name_ru, 'itemprop' => 'image']);
                            echo '<div class="content">
    											<div class="title"></div>
    											<div class="subtitle" itemprop="name"></div>
    										  </div>
    												<div class="duration"></div>
    												<div class="play-button"></div>
    										  </div>
    										</a>
    									</div>';
                        else:

                        endif;
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>
<section></section>
<section class="recommend">
    <div class="recommendation">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3>Смотрите другие сериалы</h3>
                </div>
            </div>
            <div class="row">
                <?php foreach ($recommendations as $recommendation):?>
                    <?php foreach ($series as $serial): ?>
                        <?php if ($serial->id == $recommendation): ?>
                            <div class="col-sm-6 col-md-3 episode" itemscope="" itemtype="http://schema.org/TVSeries">
                                <a href="<?=Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$serial->id])?>" title="<?php echo $serial->release_name_ru;?> смотреть онлайн" itemprop="url">
                                    <div class="thumbnail">
                                        <?=Html::img(Url::to(['@lostfilm/Images/'.$serial->id.'/Posters/shmoster_s'.$serial->release_totalseasons.'.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
                                        <div class="content">
                                            <div class="title" itemprop="name"><?php echo $serial->release_name_ru;?></div>
                                            <div class="subtitle">
                                                <meta itemprop="numberOfSeasons" content="<?php echo $serial->release_totalseasons;?>">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif;?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>