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
    <h1>movies/view</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>


<?= VideoJsWidget::widget([
    'options' => [
        'class' => 'video-js vjs-fluid vjs-big-play-centered',
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
            ['src' => Url::to($url , true), 'type' => 'video/mp4']
//            ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],
//            ['src' => 'http://vjs.zencdn.net/v/oceans.webm', 'type' => 'video/webm']
        ],
        'track' => [
            ['kind' => 'captions', 'src' => 'http://localhost:8888/track/12.Monkeys.s01e01.XviD.DD5.1.LostFilm.srt', 'srclang' => 'ru', 'label' => 'Русский']
        ]
    ]
]); ?>