<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\FullName */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Full Names'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="full-name-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'release_name_ru',
            'release_name_en',
            'release_totalseasons',
            'release_status',
            'release_show',
            'release_year',
            'release_description',
            'release_released',
            'release_genre',
            'release_director',
            'release_actors',
            'release_plot',
            'release_language',
            'release_country',
            'release_awards',
            'release_metascore',
            'release_imdbrating',
            'release_imdbvotes',
            'release_imdbid',
            'release_type',
        ],
    ]) ?>

</div>
