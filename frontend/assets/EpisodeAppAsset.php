<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class EpisodeAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/video-js.min.css',
        'css/videojs-sublime-skin.css',
        'css/release.css',
        'css/font-awesome.min.css',
    ];
    public $js = [
        '/js/videojs-ie8.min.js',
        '/js/video.min.js',
        '/js/videojs_5.vast.vpaid.min.js',
        '/js/google.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
