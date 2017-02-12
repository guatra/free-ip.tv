<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FullNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Full Names');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="full-name-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Full Name'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'release_name_ru',
            'release_name_en',
            'release_totalseasons',
            'release_status',
            // 'release_show',
            // 'release_year',
            // 'release_description',
            // 'release_released',
            // 'release_genre',
            // 'release_director',
            // 'release_actors',
            // 'release_plot',
            // 'release_language',
            // 'release_country',
            // 'release_awards',
            // 'release_metascore',
            // 'release_imdbrating',
            // 'release_imdbvotes',
            // 'release_imdbid',
            // 'release_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
