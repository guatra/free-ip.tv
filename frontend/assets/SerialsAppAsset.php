<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SerialsAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//'css/episode.css',
//'css/resize_player.css',
//'css/videojs-sublime-skin.css',
        'css/font-awesome.min.css',
        '/css/serials.css',
    ];
    public $js = [
//'js/resize_player.js',
    ];
    public $jsOptions = [
//'position' => \yii\web\View::POS_END,
    ];
    public $depends = [
//'yii\web\YiiAsset',
//'yii\bootstrap\BootstrapAsset',
    ];
}