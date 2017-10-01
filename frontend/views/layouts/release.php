<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use frontend\assets\ReleaseAppAsset;
use common\widgets\Alert;

ReleaseAppAsset::register($this);

$session = Yii::$app->session;
$session['language'] == '' ? $session['language'] = Yii::$app->language : $lang = $session['language'];
$lang = $session['language'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="series">
<?php $this->beginBody() ?>

<div class="wrap">

    <div class="container-fluid">

        <?= Alert::widget() ?>
        <?= $content ?>

    </div>
</div>
<section class="nav-bottom">
    <?php
    NavBar::begin([
        'brandLabel' => 'free-ip.tv',
        'brandUrl' => Yii::$app->urlManager->createUrl(['/site/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-bottom',
        ],
    ]);
    $menuItems = [
        //['label' => 'Home', 'url' => ['/site/index']],
        //['label' => 'Serials', 'url' => ['/series/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</section>
<noscript><div><img src="https://mc.yandex.ru/watch/35854435" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
