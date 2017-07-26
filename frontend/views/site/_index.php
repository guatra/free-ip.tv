<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\icons\Icon;

$this->title = Yii::$app->name;

?>
<div class="site-index">

    <div class="body-content container-fluid">

        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="background-color: #00b3ee;">

                <div class="view">
                    <h3>Блок избранное </h3>
                </div>

                <div class="row">
                    <?= Icon::show('home') ?>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">Показывать как сетка</div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">Показывать как список</div>
                </div>
                <div class="sort">
                    <h3>Медиатека</h3>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <ul>
                                <ul>
                                    <li class="item_1"></li>
                                    <li class="item_2"></li>
                                    <li class="item_3"></li>
                                    <li class="item_4"></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" style="background-color: #777777">
                <div class="row">
                    <div class="col-lg-6">
                        <h2><?= Yii::t('frontend', 'APP_MOVIES') ?></h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                    </div>
                    <div class="col-lg-6">
                        <h2><?= Yii::t('frontend', 'APP_SERIALS') ?></h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>

                        <p><?= Html::a(Yii::t('app', 'VIEW'), ['/series/index'], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),

                                ],
                            ]) ?></p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
