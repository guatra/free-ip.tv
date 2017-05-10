<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;

?>


<div class="inner">
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
    <section>
        <div class="box alt">
            <div class="row">
                <?php foreach ($serials as $serialsItem): ?>
                <div class="3u 12u$(medium)">
                    <span class="image fit">
                        <a class="" href="<?=Yii::$app->urlManager->createUrl(['/release/view', 'id' =>$serialsItem->id])?>">
                            <?php echo Html::img(Url::to(['@lostfilm/Images/'.$serialsItem->id.'/Posters/image.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
                        </a>
                    </span>
                </div>
                <?php endforeach; ?>
                <!-- Break -->
            </div>
        </div>
    </section>

</div>
