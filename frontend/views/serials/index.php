<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;
use yii\jui\Menu;

?>


<section>
    <header id="header">
        <a href="#" class="logo"><strong>ПРивет</strong> юзер series</a>
        <ul class="icons">
            <li><a href="#" class="icon fa-vk"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
        </ul>
    </header>
    <?php foreach ($serials as $serialsItem): ?>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
            <div class="image">

                <a class="" href="<?=Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$serialsItem->id])?>">

                    <?php echo Html::img(Url::to(['@lostfilm/Images/'.$serialsItem->id.'/Posters/image.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
                    <?php //echo Html::img(Yii::$app->urlManager->createUrl(['/images/serials/'.$serialsItem->id.'/front.jpg']), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
                </a>

            </div>
        </div>
    <?php endforeach; ?>
</section>
