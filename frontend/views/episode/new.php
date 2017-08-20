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
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php $image = Url::to(['@lostfilm/Images/'.$model->id.'/Posters/poster.jpg'],'https'); ?>

                <div class="embed-responsive embed-responsive-16by9 video-js-responsive-container vjs-hd">
                    <div poster=<?= $image ?> preload="none" class="video-js vjs-sublime-skin vjs-paused vjs-controls-enabled vjs-workinghover vjs-user-inactive" id="player" role="region" aria-label="video player" tabindex="-1" style="outline: none;">
                        <video id="player_html5_api" class="vjs-tech" preload="none" poster=<?= $image ?>>
                            <source src="https://silicon-valley-online.ru/balancer/v/eb41fc3919977bdee391b54419dd39ea/5f4efcd3-bebf-4a49-ab83-4258d30cb329.480.mp4" type="video/mp4">
                            <p class="vjs-no-js">
                                Для просмотра этого видео, пожалуйста, включите JavaScript или обновите свой
                                браузер.
                            </p>
                        </video><div></div><div class="vjs-black-poster"></div><div class="vjs-poster" tabindex="-1" style="background-image: url(<?= $image ?>);"></div><div class="vjs-text-track-display vjs-hidden" aria-live="assertive" aria-atomic="true"></div><div class="vjs-loading-spinner" dir="ltr"></div><button class="vjs-big-play-button" type="button" aria-live="polite" title="Play Video"><span class="vjs-control-text">Play Video</span></button><div class="vjs-control-bar" dir="ltr" role="group"><button class="vjs-play-control vjs-control vjs-button " type="button" aria-live="polite" title="Play"><span class="vjs-control-text">Play</span></button><div class="vjs-volume-menu-button vjs-menu-button vjs-menu-button-inline vjs-control vjs-button vjs-volume-menu-button-horizontal vjs-vol-3" tabindex="0" role="button" aria-live="polite" title="Mute"><div class="vjs-menu"><div class="vjs-menu-content"><div tabindex="0" class="vjs-volume-bar vjs-slider-bar vjs-slider vjs-slider-horizontal" role="slider" aria-valuenow="100.00" aria-valuemin="0" aria-valuemax="100" aria-label="volume level" aria-valuetext="100.00%"><div class="vjs-volume-level"><span class="vjs-control-text"></span></div></div></div></div><span class="vjs-control-text">Mute</span></div><div class="vjs-current-time vjs-time-control vjs-control"><div class="vjs-current-time-display" aria-live="off"><span class="vjs-control-text">Current Time </span>0:00</div></div><div class="vjs-time-control vjs-time-divider"><div><span>/</span></div></div><div class="vjs-duration vjs-time-control vjs-control"><div class="vjs-duration-display" aria-live="off"><span class="vjs-control-text">Duration Time</span> 0:00</div></div><div class="vjs-progress-control vjs-control"><div tabindex="0" class="vjs-progress-holder vjs-slider vjs-slider-horizontal" role="slider" aria-valuenow="NaN" aria-valuemin="0" aria-valuemax="100" aria-label="progress bar" aria-valuetext="0:00"><div class="vjs-load-progress"><span class="vjs-control-text"><span>Loaded</span>: 0%</span></div><div class="vjs-mouse-display" data-current-time="0:00" style="left: 0px;"></div><div class="vjs-play-progress vjs-slider-bar" data-current-time="0:00"><span class="vjs-control-text"><span>Progress</span>: 0%</span></div></div></div><div class="vjs-live-control vjs-control vjs-hidden"><div class="vjs-live-display" aria-live="off"><span class="vjs-control-text">Stream Type</span>LIVE</div></div><div class="vjs-remaining-time vjs-time-control vjs-control"><div class="vjs-remaining-time-display" aria-live="off"><span class="vjs-control-text">Remaining Time</span> -0:00</div></div><div class="vjs-custom-control-spacer vjs-spacer ">&nbsp;</div><div class="vjs-playback-rate vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden" tabindex="0" role="menuitem" aria-live="polite" title="Playback Rate" aria-expanded="false" aria-haspopup="true"><div class="vjs-menu" role="presentation"><ul class="vjs-menu-content" role="menu"></ul></div><span class="vjs-control-text">Playback Rate</span><div class="vjs-playback-rate-value">1</div></div><div class="vjs-chapters-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden" tabindex="0" role="menuitem" aria-live="polite" title="Chapters" aria-expanded="false" aria-haspopup="true" aria-label="Chapters Menu"><div class="vjs-menu" role="presentation"><ul class="vjs-menu-content" role="menu"><li class="vjs-menu-title" tabindex="-1">Chapters</li></ul></div><span class="vjs-control-text">Chapters</span></div><div class="vjs-descriptions-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden" tabindex="0" role="menuitem" aria-live="polite" title="Descriptions" aria-expanded="false" aria-haspopup="true" aria-label="Descriptions Menu"><div class="vjs-menu" role="presentation"><ul class="vjs-menu-content" role="menu"><li class="vjs-menu-item vjs-selected" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-checked="true" title=", selected">descriptions off<span class="vjs-control-text">, selected</span></li></ul></div><span class="vjs-control-text">Descriptions</span></div><div class="vjs-subtitles-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden" tabindex="0" role="menuitem" aria-live="polite" title="Subtitles" aria-expanded="false" aria-haspopup="true" aria-label="Subtitles Menu"><div class="vjs-menu" role="presentation"><ul class="vjs-menu-content" role="menu"><li class="vjs-menu-item vjs-selected" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-checked="true" title=", selected">subtitles off<span class="vjs-control-text">, selected</span></li></ul></div><span class="vjs-control-text">Subtitles</span></div><div class="vjs-captions-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden" tabindex="0" role="menuitem" aria-live="polite" title="Captions" aria-expanded="false" aria-haspopup="true" aria-label="Captions Menu"><div class="vjs-menu" role="presentation"><ul class="vjs-menu-content" role="menu"><li class="vjs-menu-item vjs-selected" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-checked="true" title=", selected">captions off<span class="vjs-control-text">, selected</span></li></ul></div><span class="vjs-control-text">Captions</span></div><div class="vjs-audio-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden" tabindex="0" role="menuitem" aria-live="polite" title="Audio Track" aria-expanded="false" aria-haspopup="true" aria-label="Audio Menu"><div class="vjs-menu" role="presentation"><ul class="vjs-menu-content" role="menu"></ul></div><span class="vjs-control-text">Audio Track</span></div><button class="vjs-fullscreen-control vjs-control vjs-button " type="button" aria-live="polite" title="Fullscreen"><span class="vjs-control-text">Fullscreen</span></button></div><div class="vjs-error-display vjs-modal-dialog vjs-hidden " tabindex="-1" aria-describedby="player_component_340_description" aria-hidden="true" aria-label="Modal Window" role="dialog"><p class="vjs-modal-dialog-description vjs-offscreen" id="player_component_340_description">This is a modal window.</p><div class="vjs-modal-dialog-content" role="document"></div></div><div class="vjs-caption-settings vjs-modal-overlay vjs-hidden" tabindex="-1" role="dialog" aria-labelledby="TTsettingsDialogLabel-player_component_345" aria-describedby="TTsettingsDialogDescription-player_component_345">
                            <div role="document">
                                <div role="heading" aria-level="1" id="TTsettingsDialogLabel-player_component_345" class="vjs-control-text">Captions Settings Dialog</div>
                                <div id="TTsettingsDialogDescription-player_component_345" class="vjs-control-text">Beginning of dialog window. Escape will cancel and close the window.</div>
                                <div class="vjs-tracksettings">
                                    <div class="vjs-tracksettings-colors">
                                        <fieldset class="vjs-fg-color vjs-tracksetting">
                                            <legend>Text</legend>
                                            <label class="vjs-label" for="captions-foreground-color-player_component_345">Color</label>
                                            <select id="captions-foreground-color-player_component_345">
                                                <option value="#FFF" selected="">White</option>
                                                <option value="#000">Black</option>
                                                <option value="#F00">Red</option>
                                                <option value="#0F0">Green</option>
                                                <option value="#00F">Blue</option>
                                                <option value="#FF0">Yellow</option>
                                                <option value="#F0F">Magenta</option>
                                                <option value="#0FF">Cyan</option>
                                            </select>
                                            <span class="vjs-text-opacity vjs-opacity">
              <label class="vjs-label" for="captions-foreground-opacity-player_component_345">Transparency</label>
              <select id="captions-foreground-opacity-player_component_345">
                <option value="1" selected="">Opaque</option>
                <option value="0.5">Semi-Opaque</option>
              </select>
            </span>
                                        </fieldset>
                                        <fieldset class="vjs-bg-color vjs-tracksetting">
                                            <legend>Background</legend>
                                            <label class="vjs-label" for="captions-background-color-player_component_345">Color</label>
                                            <select id="captions-background-color-player_component_345">
                                                <option value="#000" selected="">Black</option>
                                                <option value="#FFF">White</option>
                                                <option value="#F00">Red</option>
                                                <option value="#0F0">Green</option>
                                                <option value="#00F">Blue</option>
                                                <option value="#FF0">Yellow</option>
                                                <option value="#F0F">Magenta</option>
                                                <option value="#0FF">Cyan</option>
                                            </select>
                                            <span class="vjs-bg-opacity vjs-opacity">
              <label class="vjs-label" for="captions-background-opacity-player_component_345">Transparency</label>
              <select id="captions-background-opacity-player_component_345">
                <option value="1" selected="">Opaque</option>
                <option value="0.5">Semi-Transparent</option>
                <option value="0">Transparent</option>
              </select>
            </span>
                                        </fieldset>
                                        <fieldset class="window-color vjs-tracksetting">
                                            <legend>Window</legend>
                                            <label class="vjs-label" for="captions-window-color-player_component_345">Color</label>
                                            <select id="captions-window-color-player_component_345">
                                                <option value="#000" selected="">Black</option>
                                                <option value="#FFF">White</option>
                                                <option value="#F00">Red</option>
                                                <option value="#0F0">Green</option>
                                                <option value="#00F">Blue</option>
                                                <option value="#FF0">Yellow</option>
                                                <option value="#F0F">Magenta</option>
                                                <option value="#0FF">Cyan</option>
                                            </select>
                                            <span class="vjs-window-opacity vjs-opacity">
              <label class="vjs-label" for="captions-window-opacity-player_component_345">Transparency</label>
              <select id="captions-window-opacity-player_component_345">
                <option value="0" selected="">Transparent</option>
                <option value="0.5">Semi-Transparent</option>
                <option value="1">Opaque</option>
              </select>
            </span>
                                        </fieldset>
                                    </div> <!-- vjs-tracksettings-colors -->
                                    <div class="vjs-tracksettings-font">
                                        <div class="vjs-font-percent vjs-tracksetting">
                                            <label class="vjs-label" for="captions-font-size-player_component_345">Font Size</label>
                                            <select id="captions-font-size-player_component_345">
                                                <option value="0.50">50%</option>
                                                <option value="0.75">75%</option>
                                                <option value="1.00" selected="">100%</option>
                                                <option value="1.25">125%</option>
                                                <option value="1.50">150%</option>
                                                <option value="1.75">175%</option>
                                                <option value="2.00">200%</option>
                                                <option value="3.00">300%</option>
                                                <option value="4.00">400%</option>
                                            </select>
                                        </div>
                                        <div class="vjs-edge-style vjs-tracksetting">
                                            <label class="vjs-label" for="captions-edge-style-player_component_345">Text Edge Style</label>
                                            <select id="captions-edge-style-player_component_345">
                                                <option value="none" selected="">None</option>
                                                <option value="raised">Raised</option>
                                                <option value="depressed">Depressed</option>
                                                <option value="uniform">Uniform</option>
                                                <option value="dropshadow">Dropshadow</option>
                                            </select>
                                        </div>
                                        <div class="vjs-font-family vjs-tracksetting">
                                            <label class="vjs-label" for="captions-font-family-player_component_345">Font Family</label>
                                            <select id="captions-font-family-player_component_345">
                                                <option value="proportionalSansSerif" selected="">Proportional Sans-Serif</option>
                                                <option value="monospaceSansSerif">Monospace Sans-Serif</option>
                                                <option value="proportionalSerif">Proportional Serif</option>
                                                <option value="monospaceSerif">Monospace Serif</option>
                                                <option value="casual">Casual</option>
                                                <option value="script">Script</option>
                                                <option value="small-caps">Small Caps</option>
                                            </select>
                                        </div>
                                    </div> <!-- vjs-tracksettings-font -->
                                    <div class="vjs-tracksettings-controls">
                                        <button class="vjs-default-button">Defaults</button>
                                        <button class="vjs-done-button">Done</button>
                                    </div>
                                </div> <!-- vjs-tracksettings -->
                            </div> <!--  role="document" -->
                        </div></div>
                    <div id="blocked-warning">
                        <div class="row">
                            <img class="col-xs-3 hidden-xs img-responsive" src="/img/blocked_logo.png" alt="">
                            <div class="col-xs-12 col-md-9 col-sm-9">
                                <h4>В вашем браузере обнаружен блокировщик рекламы</h4>
                                <p>Мы просим вас поставить наш сайт в исключение блокировщика, так как
                                    именно благодаря рекламе мы продолжаем поддерживать работу
                                    сайта.<br>Не забудьте <a href="/season/4/episode/7">обновить
                                        страницу</a>.</p>
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
                <a class="btn disabled" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => 1])?>">
                    ← Предыдущая серия
                </a>
                <?php elseif ( $episode == 1 AND 1 < $season ): ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season - 1, 'episode' => $last_season])?>">
                        ← Предыдущий сезон
                    </a>
                <?php elseif ($episode == 1): ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => 1])?>">
                        ← Предыдущая серия
                    </a>
                <?php else: ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode - 1])?>">
                        ← Предыдущая серия
                    </a>
                <?php endif ?>
            </div>
            <div class="col-xs-6 text-center">
                <?php if ($episode == $release_count AND $season == $release_full->release_totalseasons): ?>
                    <a class="btn disabled" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season + 1, 'episode' => $episode])?>">
                        Следующий сезон →
                    </a>
                <?php elseif ($episode == $release_count): ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season + 1, 'episode' => 1])?>">
                        Следующий сезон →
                    </a>
                <?php else: ?>
                    <a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $id, 'season' => $season, 'episode' => $episode + 1])?>">
                        Следующая серия →
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






