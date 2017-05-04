<?php


namespace frontend\assets;

use frontend\assets\AppAsset;

class SiteAppAsset extends AppAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
        'css/font-awesome.min.css',
    ];
    public $js = [
        '/js/ie/html5shiv.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::EVENT_END_BODY];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}