<?php
/**
 * Created by PhpStorm.
 * User: guatra
 * Date: 23.06.17
 * Time: 1:48
 */
use wbraganca\videojs\VideoJsWidget;
$url = $trailer;
?>
<div>
<!--    --><?//=debug($trailer)?>
</div>
<?= VideoJsWidget::widget([
    'options' => [
        'class' => 'video-js vjs-fluid videojs-sublime-skin',
        'poster' => "http://video-js.zencoder.com/oceans-clip.png",
        'width' => '640',
        'height' => '264',
        'controls' => true,
    ],
    'jsOptions' => [
        'preload' => 'auto',
    ],
    'tags' => [
        'source' => [
            ['src' => $url, 'type' => 'video/mp4'],
//            ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],

        ],
        'track' => [
            ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'en', 'label' => 'English']
        ]
    ]
]); ?>

