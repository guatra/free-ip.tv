<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\imagine\Image;
use yii\helpers\Html;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
?>

<?//= debug($data)?>
<?php
$n = 145;
//$url = Url::to(['@lostfilm/Images/'.$n.'/Posters/image.jpg'],'https');
//Image::thumbnail($url, 120, 120)
//    ->save(Yii::getAlias('@runtime/thumb-test-image.jpg'), ['quality' => 50]);
//    ->save(Yii::getAlias('http://localhost/free-ip.tv/web/images/series/'.$n.'/thumbnail.jpg', true), ['quality' => 50]);
?>

<?//=Html::img(Url::to(['@lostfilm/Images/'.$n.'/Posters/shmoster_s7.jpg'],'https'), ['alt' =>'Обложка', 'itemprop' => 'image', 'class' => 'img-responsive'])?>
<?php
$url = Url::to(['@lostfilm/Images/'.$n.'/Posters/shmoster_s7.jpg'],'https');
//Image::crop($url, 120, 120)
//<? Image::crop(Yii::getAlias('@webroot/img/text-photo.jpg'))
//->save(Yii::getAlias('@runtime/crop-photo.jpg'), ['quality' => 80]);
$image = yii\imagine\Image::getImagine();
$newImage = $image->open($url);

//$newImage->effects()->blur(3);

$newImage->save(Yii::getAlias('@runtime/test-photo.jpg'), ['quality' => 80]);
?>