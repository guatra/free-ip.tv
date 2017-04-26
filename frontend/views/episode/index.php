<?php
use wbraganca\videojs\VideoJsWidget;
?>


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
            ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],
            ['src' => 'http://vjs.zencdn.net/v/oceans.webm', 'type' => 'video/webm']
        ],
        'track' => [
            ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'en', 'label' => 'English']
        ]
    ]
]); ?>