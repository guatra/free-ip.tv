<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;

?>

<section class="nav-top">
<?php
    NavBar::begin([
        'brandLabel' => $model->release_name_ru,
        'brandUrl' => Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$model->id]),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    for ($i=1; $i <= $model->release_totalseasons ; $i++) {
    $menuItemsInSide[] = ['label' => 'Сезон '.$i, 'url' => ['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => 1]];
	}
    $menuItems = [
    		[
            'label' => 'Сезоны',
            'items' => $menuItemsInSide,
        	],
    	];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
?>
</section>

<section class="serial">
	   	<div itemscope="" itemtype="http://schema.org/TVSeries">
    		<div class="spoiler">
    			<div class="bg"></div>
    			<div class="bg" style="background-image: url(<?=$poster?>)"></div>
    			<div class="container">
    				<div class="row">
    					<h1>
    						Смотреть онлайн сериал<br>
    						<span class="name"><?=$model->release_name_ru?></span>
    					</h1>
                        <?php if(is_array($last_view)):?>
    					<a class="btn btn-default btn-lg" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $model->id, 'season' => '1', 'episode' => '1' ])?>">Начать просмотр</a>
                        <?php else: ?>
                            <br>
                            <h4 class="name">Вы остановились на N серии N сезона <?=$last_view?></h4>
                        <a class="btn btn-default btn-lg" href="<?=Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $model->id, 'season' => '1', 'episode' => '1' ])?>">Продолжить просмотр</a>
                        <?php endif; ?>
    				</div>
    			</div>
    		</div>
    		<div class="home">


    			<div class="container">
    				<div class="row">
    					<div class="col-md-3">
    						<?=Html::img(Url::to(['@web/uploads/Images/'.$model->id.'/Posters/shmoster_s'.$model->release_totalseasons.'.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>

    					</div>
    					<div class="col-md-9">
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <?=Yii::t('frontend', 'APP_ORIGINAL_NAME'); ?>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <?=$model->release_name_en?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <?=Yii::t('frontend', 'APP_SEASONS'); ?>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                            <?php
                                            for ($i=1; $i <= $model->release_totalseasons ; $i++) {
                                                echo Html::a($i.' сезон', ['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => '1' ], ['itemprop' => 'name']);

                                                if ($i < $model->release_totalseasons) {
                                                    echo ', ';
                                                }

                                            }
                                            ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <?=Yii::t('frontend', 'APP_YEAR_OF_ISSUE'); ?>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                            <?php echo date('Y', $model->release_released); ?>
                                </div>
                            </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <?=Yii::t('frontend', 'APP_GENRE'); ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                            <?=$model->release_genre?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <?=Yii::t('frontend', 'APP_DIRECTOR'); ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                            <?=$model->release_director?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <?=Yii::t('frontend', 'APP_CAST'); ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                            <?=$model->release_actors?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <?=Yii::t('frontend', 'APP_DESCRIPTION'); ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                            <?=$model->release_plot?>
                                        </div>
                                    </div>
    								<div class="row">
    									<div class="col-sm-6 rating">
    										<div class="pull-left">
                                                <?= Icon::show('imdb', ['class' => 'fa-3x'], Icon::FA) ?>

    										</div>
    										<div class="pull-left">
    											<div class="value"><?=$model->release_lostfilmrating?></div>
    										</div>
    									</div>
    									<div class="col-sm-6 rating">

    									</div>
    								</div>
    							</div>
    						</div>
    						<div class="row description" itemprop="about">
    							<div class="col-md-12">
    							
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="latest">
    					<div class="container">
    						<div class="row">
    							<div class="col-xs-6">
    								<h3>Сезоны Сериала</h3>
    							</div>
    						</div>
    						<div class="row">
    							<?php 
    									for ($i=1; $i <= $model->release_totalseasons ; $i++) { 
    										if (Html::img(Yii::$app->urlManager->createUrl(['/images/series/'.$model->id.'/'.$i.'.jpg'])) !== null):
    										echo '
    										<div class="col-xs-6 col-sm-6 col-md-3 episode" itemprop="containsSeason" itemscope="" itemtype="http://schema.org/TVEpisode">
    								<meta itemprop="containsSeason" content="'.$model->release_totalseasons.'">
    								<a href="'.Yii::$app->urlManager->createUrl(['/episode/view', 'id' => $model->id, 'season' => $i, 'episode' => '1']).'" itemprop="url">
    									<div class="thumbnail">';
    									// Вот в этом месте воруем у LOSTFILM.TV
    									echo Html::img(Url::to(['@lostfilm/Images/'.$model->id.'/Posters/shmoster_s'.$i.'.jpg'],'https'), ['alt' => $model->release_name_ru, 'itemprop' => 'image']);
    									echo '<div class="content">
    											<div class="title"></div>
    											<div class="subtitle" itemprop="name"></div>
    										  </div>
    												
    												<div class="play-button"></div>
    										  </div>
    										</a>
    									</div>';
    									else:

    									endif;
    									}
    								?>
    								
    						</div>
    					</div>
    				</div>
    			</div>
</section>
<section class="recommend">
<div class="recommendation">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3>Смотрите другие сериалы</h3>
            </div>
        </div>
        <div class="row">
		<?php foreach ($recommendations as $recommendation):?>    
			<?php foreach ($series as $serial): ?>
				<?php if ($serial->id == $recommendation): ?>									        
			<div class="col-sm-6 col-md-3 episode" itemscope="" itemtype="http://schema.org/TVSeries">
				<a href="<?=Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$serial->id])?>" title="<?php echo $serial->release_name_ru;?> смотреть онлайн" itemprop="url">
					<div class="thumbnail">
					<?=Html::img(Url::to(['@web/uploads/Images/'.$serial->id.'/Posters/shmoster_s'.$serial->release_totalseasons.'.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
						<div class="content">
							<div class="title" itemprop="name"><?php echo $serial->release_name_ru;?></div>
								<div class="subtitle">
									<meta itemprop="numberOfSeasons" content="<?php echo $serial->release_totalseasons;?>">
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
