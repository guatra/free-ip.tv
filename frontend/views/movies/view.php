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
