<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;

?>


<div class="inner">
    <header id="header">
        <a href="#" class="logo"><strong>ПРивет</strong> юзер series</a>
        <ul class="icons">
            <li>
                <?= Html::a(Icon::show('vk', ['class' => 'icon'], Icon::FA), 'https://vk.com/freeiptv', ['class' => 'icon fa vk']) ?>
            </li>
        </ul>
    </header>
    <section>
        <div class="box alt">
            <div class="row">
                <?php foreach ($series as $serialsItem): ?>
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
