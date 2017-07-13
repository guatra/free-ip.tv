<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\widgets\LinkPager;
use yii\bootstrap\Nav;
use yii\widgets\Pjax;
use yii\bootstrap\NavBar;
use yii\widgets\ListView;
use frontend\components\HelloWidget;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<section class="nav-top">
<?php
NavBar::begin([
    'brandLabel' =>  Yii::t('frontend', 'APP_MOVIES'),
    'brandUrl' => Yii::$app->urlManager->createUrl(['/movies/index']),
    'options' => [
        'class' => 'navbar navbar-inverse navbar-fixed-top',
    ],
]);
$menuItemsInSide[] = ['label' => Yii::t('frontend', 'APP_MOVIES'), 'url' => ['/movies/index']];
//$menuItemsInSide[] = ['label' => 'Поиск', 'url' => ['/episode/view', 'id' => 1, 'season' => 1, 'episode' => 1], 'linkOptions' => []];
$menuItems = [
    [
        'label' => 'Сезоны',
        'items' => $menuItemsInSide,
//        'items' => $menuItems,
    ],
];

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
//        [
//                'label' => Yii::t('frontend', 'APP_MOVIES'), 'url' => ['/movies/index'],
//                'items' =>
//                    ['label' => Yii::t('frontend', 'APP_MOVIES'), 'url' => ['/movies/index']],
//                    ['label' => Yii::t('frontend', 'APP_MOVIES'), 'url' => ['/movies/index']],
//        ],
        [
            'label' => Yii::t('frontend', 'APP_USER_MENU'),
            'items' => [
                '<li class="dropdown-header"></li>',
                ['label' => Yii::t('frontend', 'APP_MOVIES'), 'url' => ['/movies/index']],
                '<li class="divider"></li>',
                ['label' => Yii::t('frontend', 'APP_SERIALS'), 'url' => ['/serials/index']],
            ],
        ],
    ],
//    'options' => ['class' => 'navbar-nav'],
]);
NavBar::end();
?>
</section>
<section class="movies">
    <div class="container">
    <div class="jumbotron">
        <main role="main">
            <article>
                <!-- Header -->
                <header id="header">
                    <a href="#" class="logo"><strong><?= HelloWidget::widget() ?></strong>
                    </a>
                    <ul class="icons">
                        <li>
                            <?= Html::a(Icon::show('vk', ['class' => 'icon'], Icon::FA), 'https://vk.com/freeiptv', ['class' => 'icon fa vk']) ?>
                        </li>
                    </ul>
                </header>
                <section>
                    <div class="container-fluid">
                        <div class="row">

                            <?php Pjax::begin(); ?>

                            <?php echo ListView::widget([
                                'dataProvider' => $movies,
//                                'itemView' => '_view',
                                'itemView' => function ($model, $key, $index, $widget){
                                    return $this->render('_view', [
                                        'model' => $model,
                                        'key' => $key,
                                        'index' => $index,
                                        'widget' => $widget,
                                    ]);
                                },
                                'viewParams' => [
                                    'fullView' => true,
                                    'context' => 'main-page',
                                ],
                                'options' => [
                                    'tag' => 'div',
                                    'class' => 'list-wrapper',
                                    'id' => 'list-wrapper',
                                ],
                                'layout' => "{pager}\n{items}\n{pager}",
                                //                        'layout' => "{pager}\n{items}\n{sorter}\n{pager}",
                                'pager' => [
                                    'firstPageLabel' => 'first',
                                    'lastPageLabel' => 'last',
                                    'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
                                    'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
                                    'maxButtonCount' => 3,

                                    // Customzing options for pager container tag
                                    'options' => [
                                        'tag' => 'div',
                                        'class' => 'pager-wrapper pagination',
                                        'id' => 'pager-container',
                                    ],

                                    //                            // Customzing CSS class for pager link
                                    //                            'linkOptions' => ['class' => 'link'],
                                    //                            'activePageCssClass' => 'active',
                                    //                            'disabledPageCssClass' => 'disable',
                                    //
                                    //                            // Customzing CSS class for navigating link
                                    //                            'prevPageCssClass' => 'mypre',
                                    //                            'nextPageCssClass' => 'mynext',
                                    //                            'firstPageCssClass' => 'myfirst',
                                    //                            'lastPageCssClass' => 'mylast',
                                ],

                            ]); ?>

                            <?php Pjax::end(); ?>



                        </div>
                    </div>
                </section>
                <hr>

            </article>
        </main>
    </div>
</div>
</section>
<section class="recommend">
    <div class="recommendation">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3>Обратите внимание на эти сериалы</h3>
                </div>
            </div>
            <div class="row">
                <?php foreach ($recommendations as $recommendation):?>
                    <?php foreach ($series as $serie): ?>
                        <?php if ($serie->id == $recommendation): ?>
                            <div class="col-sm-6 col-md-3 episode" itemscope="" itemtype="http://schema.org/TVSeries">
                                <a href="<?=Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$serie->id])?>" title="<?php echo $serie->release_name_ru;?> смотреть онлайн" itemprop="url">
                                    <div class="thumbnail">
                                        <?=Html::img(Url::to(['@lostfilm/Images/'.$serie->id.'/Posters/shmoster_s'.$serie->release_totalseasons.'.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
                                        <div class="content">
                                            <div class="title" itemprop="name"><?php echo $serie->release_name_ru;?></div>
                                            <div class="subtitle">
                                                <meta itemprop="numberOfSeasons" content="<?php echo $serie->release_totalseasons;?>">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif;?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>