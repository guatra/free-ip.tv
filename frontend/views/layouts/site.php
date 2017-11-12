<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\SiteAppAsset;
use yii\helpers\Url;
use frontend\models\SearchForm;
use kartik\typeahead\Typeahead;


SiteAppAsset::register($this);

$session = Yii::$app->session;
$session['language'] == '' ? $session['language'] = Yii::$app->language : $lang = $session['language'];
$lang = $session['language'];

$model = new SearchForm();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--[if lte IE 8]><script src="/js/ie/html5shiv.js"></script><![endif]-->
    <?php $this->head() ?>
    <!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
    <link rel="shortcut icon" href="/images/ico/favicon.ico">
    <link rel="apple-touch-icon" href="<?= Url::to('@web/touch-icons/apple-touch-icon-iphone-60x60.png', true); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= Url::to('@web/touch-icons/apple-touch-icon-ipad-retina-152x152.png', true); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png">
</head>
<body>
<?php $this->beginBody() ?>
<!-- Wrapper -->
<div id="wrapper">

   <?= $content ?>
    <!-- Sidebar -->
    <div id="sidebar">
        <div class="inner">

            <!-- Search -->
            <section id="search" class="alt">
            <?= Html::beginForm(['site/search'], 'get', ['enctype' => 'multipart/form-data']) ?>
            <?= Html::input('text', 'q','',['placeholder' => 'Search']) ?>
            <?= Html::endForm() ?>
            </section>

            <!-- Menu -->

            <nav id="menu">

                <?= Html::tag('header', Html::tag('h2' , Yii::t('frontend', 'APP_USER_MENU')), ['class' => 'major']) ?>
                <ul>
                    <li><?= Html::a(Yii::t('frontend', 'APP_TV_CHANNELS'), ['/tv/index'], ['class' => 'tv']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'APP_MOVIES'), ['/movies/index'], ['class' => 'user-moview']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'APP_SERIES'), ['/series/index'], ['class' => 'user-series']) ?></li>
                    <li>
                        <?= Html::tag('span', Yii::t('frontend', 'APP_USER_PLAYLIST'), ['class' => 'opener']) ?>
                        <ul>
                            <li><a href="#">Авторизуйтесь</a></li>
                        </ul>
                    </li>
                    <li><?= Html::a(Yii::t('frontend', 'APP_RSS'), ['/site/rss'], ['class' => 'user-series']) ?></li>
                    <li>
                        <?= Html::tag('span', Yii::t('frontend', 'APP_CHANNELS'), ['class' => 'opener']) ?>
                        <ul>
                            <li><?= Html::a(Yii::t('frontend', 'APP_CHANNELS_LOSTFILM-TV'), ['/series/index'], ['class' => 'user-series']) ?></li>
                            <li><?= Html::a(Yii::t('frontend', 'APP_RSS'), ['/site/rss'], ['class' => 'user-series']) ?></li>
                        </ul>
                    </li>
                </ul>


            </nav>
            <!-- Section -->
<!--            <section>-->
<!--                <header class="major">-->
<!--                    <h2>Новинки</h2>-->
<!--                </header>-->
<!---->
<!--                <div class="mini-posts">-->
<!--                    <article>-->
<!--                        <a href="#" class="image"><img src="https://static.lostfilm.tv/Images/174/Posters/poster.jpg" alt="" /></a>-->
<!--                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>-->
<!--                    </article>-->
<!--                    <article>-->
<!--                        <a href="#" class="image"><img src="https://static.lostfilm.tv/Images/143/Posters/poster.jpg" alt="" /></a>-->
<!--                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>-->
<!--                    </article>-->
<!--                    <article>-->
<!--                        <a href="#" class="image"><img src="https://static.lostfilm.tv/Images/134/Posters/poster.jpg" alt="" /></a>-->
<!--                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>-->
<!--                    </article>-->
<!--                </div>-->
<!--                <ul class="actions">-->
<!--                    <li><a href="#" class="button">More</a></li>-->
<!--                </ul>-->
<!--            </section>-->
<section>
    <header class="major">
        <h2><?= Yii::t('frontend', 'APP_NOTIFICATIONS')?></h2>
    </header>
</section>
                    <!-- Footer -->
            <footer id="footer">
                <p class="copyright"><?= Yii::$app->name ?>  <?= Yii::$app->version ?></p>
                <p class="copyright"><?= date('d-m-Y H:i:s', time()) ?></p>
            </footer>

        </div>
    </div>
</div>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?146"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 69978139, {tooltipButtonText: "Есть вопрос?"});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/35854435" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>