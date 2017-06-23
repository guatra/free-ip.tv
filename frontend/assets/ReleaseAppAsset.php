<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * Release frontend application asset bundle.
 */
class ReleaseAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/release.css',
        //'css/main.css',
        //'css/videojs-sublime-skin.css',
        '/css/font-awesome.min.css',

    ];
    public $js = [
//        '/js/jquery.min.js',
//        '/js/skel.min.js',
//        '/js/util.js',
//        '/js/ie/respond.min.js',
//        '/js/main.js',
        '/js/google.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $depends = [
//'yii\web\YiiAsset',
//'yii\bootstrap\BootstrapAsset',
    ];
}