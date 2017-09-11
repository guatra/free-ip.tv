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
                <li>
                    <?= Html::a(Icon::show('vk', ['class' => 'icon'], Icon::FA), 'https://vk.com/freeiptv', ['class' => 'icon fa vk']) ?>
                </li>
            </ul>
        </header>

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

                            <a href="<?= Yii::$app->urlManager->createUrl(['/news/view', 'hash' => $element->episode_article_key]) ?>" itemprop="url" class="button">Больше</a>

                        </li>
                    </ul>
                </article>
                <?php endforeach; ?>
            </div>
        </section>

    </div>
</div>

