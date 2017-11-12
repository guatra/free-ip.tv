<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MoviesAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/preloder.css',
        'css/videojs-sublime-skin.css',
        'css/font-awesome.min.css',
        'css/movies.css',
    ];
    public $js = [
        'js/preloader.js',
        //'js/resize_player.js',
        '/js/google.js',
        '/js/yandex.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}