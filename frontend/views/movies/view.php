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
<?= VideoJsWidget::widget([
    'options' => [
        'class' => 'video-js vjs-fluid videojs-sublime-skin',
        'poster' => "http://video-js.zencoder.com/oceans-clip.png",
        'width' => '640',
        'height' => '264',
        'autoplay' => true,
        'controls' => true,
    ],
    'jsOptions' => [
        'preload' => 'auto',
    ],
    'tags' => [
        'source' => [
            ['src' => Url::to($url , true), 'type' => 'video/mp4']
//            ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],
//            ['src' => 'http://vjs.zencdn.net/v/oceans.webm', 'type' => 'video/webm']
        ],
        'track' => [
            ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'en', 'label' => 'English']
        ]
    ]
]); ?>
<?php
//NavBar::begin([
//    'brandLabel' =>  $model->release_name_ru,
//    'brandUrl' => Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$model->id]),
//    'options' => [
//        'class' => 'navbar navbar-inverse navbar-fixed-top',
//    ],
//]);
//for ($i=1; $i <= $model->release_totalseasons ; $i++) {
//    $menuItemsInSide[] = ['label' => 'Сезон '.$i, 'url' => ['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => 1], 'linkOptions' => []];
//}
//$menuItems = [
//    [
//        'label' => 'Сезоны',
//        'items' => $menuItemsInSide,
//    ],
//];
//
//echo Nav::widget([
//    'options' => ['class' => 'navbar-nav navbar-right'],
//    'items' => $menuItems,
//]);
//NavBar::end();
//?>
<!---->
<!--<section class="video-container">-->
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-xs-12">-->
<!---->
<!--                --><?//= VideoJsWidget::widget([
//                    'options' => [
//                        'class' => 'video-js vjs-fluid videojs-sublime-skin',
//                        'poster' => '',
//                        'width' => 'auto',
//                        'height' => 'auto',
//                        'autoplay' => true,
//                        'controls' => true,
//                    ],
//                    'jsOptions' => [
//                        'preload' => 'auto',
//                    ],
//                    'tags' => [
//                        'source' => [
//                            //$url
//                            ['src' => Url::to($url , true), 'type' => 'video/mp4'],
//
////            ['src' => Url::to($query_episode->episode_url , true), 'type' => 'video/mp4'],
////            ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],
////            ['src' => 'http://vjs.zencdn.net/v/oceans.webm', 'type' => 'video/webm']
//                        ],
//                        'track' => [
//                            ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'en', 'label' => 'English'],
//                            ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'ru', 'label' => 'Russian']
//                        ]
//                    ]
//                ]); ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->