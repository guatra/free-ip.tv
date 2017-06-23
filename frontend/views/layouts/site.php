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


SiteAppAsset::register($this);

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
    <!--[if lte IE 8]><script src="/js/ie/html5shiv.js"></script><![endif]-->
    <?php $this->head() ?>
    <!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
    <link rel="shortcut icon" href="/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
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
                <form method="post" action="#">
                    <input type="text" name="query" id="query" placeholder="Search" />
                </form>
            </section>

            <!-- Menu -->

            <nav id="menu">

                <?= Html::tag('header', Html::tag('h2' , 'APP_USER_MENU'), ['class' => 'major']) ?>
                <ul>
                    <li>
                        <?= Html::tag('span', Yii::t('frontend', 'APP_TV_CHANNELS'), ['class' => 'opener']) ?>
                        <ul>
                            <li><?= Html::a(Yii::t('frontend', 'APP_TV'), ['/tv/index'], ['class' => 'tv-ntv']) ?></li>
                        </ul>
                    </li>
                    <li><?= Html::a(Yii::t('frontend', 'APP_MOVIES'), ['/movies/index'], ['class' => 'user-moview']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'APP_SERIALS'), ['/serials/index'], ['class' => 'user-serials']) ?></li>

                    <li>
                        <?= Html::tag('span', Yii::t('frontend', 'APP_USER_PLAYLIST'), ['class' => 'opener']) ?>
                        <ul>
                            <li><a href="#">Авторизуйтесь</a></li>
                        </ul>
                    </li>
                    <li>
                        <?= Html::tag('span', Yii::t('frontend', 'APP_CHANNELS'), ['class' => 'opener']) ?>
                        <ul>
                            <li><?= Html::a(Yii::t('frontend', 'APP_CHANNELS_LOSTFILM-TV'), ['/serials/index'], ['class' => 'user-serials']) ?></li>
                            <li><?= Html::a(Yii::t('frontend', 'APP_RSS'), ['/site/rss'], ['class' => 'user-serials']) ?></li>
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
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter35854435 = new Ya.Metrika({
                    id:35854435,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/35854435" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>