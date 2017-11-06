<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\SerialsAppAsset;
use common\widgets\Alert;
use frontend\models\Release;

SerialsAppAsset::register($this);

$session = Yii::$app->session;
$session['language'] == '' ? $session['language'] = Yii::$app->language : $lang = $session['language'];
$lang = $session['language'];

$three_end_releases = Release::find()
    ->select(['id','release_id','episode_title', 'episode_season', 'episode_season_number', 'episode_plot', 'episode_article_key'])
    ->where(['episode_language' => 'ru-RU', 'type' => 'episode'])
    ->limit(3)
    ->orderBy(['episode_released' => SORT_DESC])->all();
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
</head>
<body class="lstfml">
<?php $this->beginBody() ?>

<div id="wrapper">
    <div id="main">
        <?= $content ?>
    </div>
    <!-- Sidebar -->
    <div id="sidebar">
        <div class="inner">

            <!-- Search -->
            <section id="search" class="alt">
                <form method="post" action="#">
                    <input type="text" name="query" id="query" placeholder="Search" />
                </form>
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
                            <li><a href="#">Авторизуйтесь1</a></li>
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
            <section>
                <header class="major">
                    <h2>Новинки</h2>
                </header>
                <div class="mini-posts">
                    <?php foreach ($three_end_releases as $element): ?>
                    <article>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/search/hash', 'q' => $element->episode_article_key]) ?>" class="image">
                            <?php echo Html::img(Url::to(['/uploads/Images/'.$element->release_id.'/Posters/poster.jpg'], true), ['alt' => $element->episode_title, 'itemprop' => 'image']); ?>
                        </a>
                        <h3><?php echo $element->episode_title ?></h3>
                    </article>
                    <?php endforeach; ?>
                    <article>
                        <a href="#" class="image"><img src="https://static.lostfilm.tv/Images/143/Posters/poster.jpg" alt="" /></a>
                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
                    </article>
                    <article>
                        <a href="#" class="image"><img src="https://static.lostfilm.tv/Images/134/Posters/poster.jpg" alt="" /></a>
                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
                    </article>
                </div>
                <ul class="actions">
                    <li><a href="#" class="button">More</a></li>
                </ul>
            </section>

            <!-- Footer -->
            <footer id="footer">
                <p class="copyright"><?= Yii::$app->name ?>  <?= Yii::$app->version ?></p>
                <p class="copyright"><?= date('d-m-Y H:i:s', time()) ?></p>
            </footer>

        </div>
    </div>
</div>
<!--<section class="nav-bottom">-->
<!--    --><?php
//    NavBar::begin([
//        'brandLabel' => 'free-ip.tv',
//        'brandUrl' => Yii::$app->urlManager->createUrl(['/site/index']),
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-bottom',
//        ],
//    ]);
//    $menuItems = [
//        //['label' => 'Home', 'url' => ['/site/index']],
//        //['label' => 'Serials', 'url' => ['/series/index']],
//    ];
//    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//    } else {
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
//    }
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => $menuItems,
//    ]);
//    NavBar::end();
//    ?>
<!--</section>-->
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
