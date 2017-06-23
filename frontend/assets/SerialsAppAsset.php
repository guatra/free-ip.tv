<?php

namespace frontend\assets;

use frontend\assets\AppAsset;

/**
 * Main frontend application asset bundle.
 */
class SerialsAppAsset extends AppAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/series.css',
    ];
    public $js = [
        '/js/jquery.min.js',
        '/js/skel.min.js',
        '/js/util.js',
        '/js/ie/respond.min.js',
        '/js/main.js',
        '/js/google.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}