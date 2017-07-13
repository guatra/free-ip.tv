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
?>

<?php
NavBar::begin([
    'brandLabel' =>  Yii::t('frontend', 'APP_MOVIES'),
    'brandUrl' => Yii::$app->urlManager->createUrl(['/movies/index']),
    'options' => [
        'class' => 'navbar navbar-inverse navbar-fixed-top',
    ],
]);
//for ($i=1; $i <= $model->release_totalseasons ; $i++) {
//    $menuItemsInSide[] = ['label' => 'Сезон '.$i, 'url' => ['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => 1], 'linkOptions' => []];
//}
$menuItemsInSide = ['label' => 'Поиск', 'url' => ['/episode/view', 'id' => 1, 'season' => 1, 'episode' => 1], 'linkOptions' => []];
$menuItems = [
    [
        'label' => 'Сезоны',
//        'items' => $menuItemsInSide,
        'items' => '',
    ],
];

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
    ],
//    'options' => ['class' => 'navbar-nav'],
]);
NavBar::end();
?>
<main role="main">
    <article>
        <!-- Header -->
        <header id="header">
            <a href="#" class="logo"><strong>data<?= HelloWidget::widget() ?></strong>
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
                        'itemView' => '_view',
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