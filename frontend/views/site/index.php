<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\bootstrap\Carousel;
use yii\helpers\Url;


?>
<!-- Main -->
<div id="main">
    <div class="inner">

        <!-- Header -->
        <header id="header">
            <a href="#" class="logo"><strong>ПРивет</strong> юзер</a>
            <ul class="icons">
                <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
                <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
            </ul>
        </header>

        <!-- Banner -->
<!--        <section id="banner">-->
<!--            <div class="content">-->
<!--                <header>-->
<!--                    <h1>Hi, I’m Editorial<br />-->
<!--                        by HTML5 UP</h1>-->
<!--                    <p>A free and fully responsive site template</p>-->
<!--                </header>-->
<!--                <p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. Pellentesque sapien ac quam. Lorem ipsum dolor sit nullam.</p>-->
<!--                <ul class="actions">-->
<!--                    <li><a href="#" class="button big">Learn More</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <span class="image object">-->
<!--										<img src="images/pic10.jpg" alt="" />-->
<!--									</span>-->
<!--        </section>-->
<!--        <section>-->
<!---->
<!--        </section>-->
        <!-- Section -->
<!--        <section>-->
<!--            <header class="major">-->
<!--                <h2>Erat lacinia</h2>-->
<!--            </header>-->
<!--            <div class="features">-->
<!--                <article>-->
<!--                    <span class="icon fa-diamond"></span>-->
<!--                    <div class="content">-->
<!--                        <h3>Portitor ullamcorper</h3>-->
<!--                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>-->
<!--                    </div>-->
<!--                </article>-->
<!--                <article>-->
<!--                    <span class="icon fa-paper-plane"></span>-->
<!--                    <div class="content">-->
<!--                        <h3>Sapien veroeros</h3>-->
<!--                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>-->
<!--                    </div>-->
<!--                </article>-->
<!--                <article>-->
<!--                    <span class="icon fa-rocket"></span>-->
<!--                    <div class="content">-->
<!--                        <h3>Quam lorem ipsum</h3>-->
<!--                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>-->
<!--                    </div>-->
<!--                </article>-->
<!--                <article>-->
<!--                    <span class="icon fa-signal"></span>-->
<!--                    <div class="content">-->
<!--                        <h3>Sed magna finibus</h3>-->
<!--                        <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>-->
<!--                    </div>-->
<!--                </article>-->
<!--            </div>-->
<!--        </section>-->

        <!-- Section -->
<!--<section>-->
<!--    <iframe width='720' height='404' id=video frameborder='no' src='//pik-tv.com/online/' allowfulscreen></iframe>-->
<!--</section>-->
        <section>
            <header class="major">
                <h2>Последние новинки</h2>
            </header>
            <div class="posts">

                <?php foreach ($data as $element): ?>
                <article>

                    <a href="#" class="image">
                    <?php echo Html::img(Url::to(['@lostfilm/Images/'.$element->release_id.'/Posters/poster.jpg'],'https'), ['alt' => $element->episode_title, 'itemprop' => 'image']); ?>
                    </a>
                    <h3><?php echo $element->episode_title ?></h3>
                    <p><?php echo $element->episode_plot ?></p>
                    <ul class="actions">
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $element->release_id, 'season' => $element->episode_season, 'episode' => $element->episode_season_number]) ?>" itemprop="url" class="button">Больше</a

                        </li>
                        <!--                            <a href="--><?//=Yii::$app->urlManager->createUrl(['/headler/index', 'url_code' => $element->episode_article_key])?><!--" class="button">Больше</a>-->
                    </ul>
                </article>
                <?php endforeach; ?>
            </div>
        </section>

    </div>
</div>

