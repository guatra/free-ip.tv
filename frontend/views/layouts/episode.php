<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\EpisodeAppAsset;
use common\widgets\Alert;

EpisodeAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
    <link rel="shortcut icon" href="/images/ico/favicon.ico">
    <link rel="apple-touch-icon" href="<?= Url::to('@web/touch-icons/apple-touch-icon-iphone-60x60.png', true); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= Url::to('@web/touch-icons/apple-touch-icon-ipad-retina-152x152.png', true); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-7942507468904926",
            enable_page_level_ads: true
        });
    </script>
</head>
<body>
<?php $this->beginBody() ?>

        <?= Alert::widget() ?>
        <?= $content ?>

<footer class="footer">
    <!-- VK Widget -->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?146"></script>
    <div id="vk_community_messages"></div>
    <script type="text/javascript">
        VK.Widgets.CommunityMessages("vk_community_messages", 69978139, {tooltipButtonText: "Есть вопрос?"});
    </script>

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
        $menuItemsInSide[] = ['label' => Yii::t('frontend', 'APP_MOVIES'), 'url' => ['/movies/index']];
        $menuItemsInSide[] = ['label' => Yii::t('frontend', 'APP_SERIES'), 'url' => ['/series/index'], 'active' => 1];
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] =
            [
                    'label' => Yii::t('frontend', 'APP_USER_MENU'),
                    'items' => $menuItemsInSide,
            ];
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
</footer>

<noscript><div><img src="https://mc.yandex.ru/watch/35854435" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

