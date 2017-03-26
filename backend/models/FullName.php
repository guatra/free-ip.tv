<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "full_name".
 *
 * @property integer $id
 * @property string $release_name_ru
 * @property string $release_name_en
 * @property string $release_totalseasons
 * @property integer $release_status
 * @property integer $release_show
 * @property string $release_year
 * @property string $release_description
 * @property string $release_released
 * @property string $release_genre
 * @property string $release_director
 * @property string $release_actors
 * @property string $release_plot
 * @property string $release_language
 * @property string $release_country
 * @property string $release_awards
 * @property string $release_metascore
 * @property string $release_imdbrating
 * @property string $release_imdbvotes
 * @property string $release_imdbid
 * @property string $release_type
 *
 * @property Release[] $releases
 */
class FullName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'full_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['release_name_ru', 'release_name_en'], 'required'],
            [['release_status', 'release_show'], 'integer'],
            [['release_year'], 'safe'],
            [['release_plot'], 'string'],
            [['release_name_ru', 'release_name_en', 'release_totalseasons', 'release_description', 'release_released', 'release_genre', 'release_director', 'release_actors', 'release_language', 'release_country', 'release_awards', 'release_metascore', 'release_imdbrating', 'release_imdbvotes', 'release_imdbid', 'release_type'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'release_name_ru' => Yii::t('app', 'Название на русском'),
            'release_name_en' => Yii::t('app', 'Оригинальное название по стандарту OMDB'),
            'release_totalseasons' => Yii::t('app', 'Количество сезонов'),
            'release_status' => Yii::t('app', 'Статус съёмки'),
            'release_show' => Yii::t('app', 'Показывать на главной странице'),
            'release_year' => Yii::t('app', 'Release Year'),
            'release_description' => Yii::t('app', 'Release Description'),
            'release_released' => Yii::t('app', 'Release Released'),
            'release_genre' => Yii::t('app', 'Release Genre'),
            'release_director' => Yii::t('app', 'Release Director'),
            'release_actors' => Yii::t('app', 'Release Actors'),
            'release_plot' => Yii::t('app', 'Release Plot'),
            'release_language' => Yii::t('app', 'Release Language'),
            'release_country' => Yii::t('app', 'Release Country'),
            'release_awards' => Yii::t('app', 'Release Awards'),
            'release_metascore' => Yii::t('app', 'Release Metascore'),
            'release_imdbrating' => Yii::t('app', 'Release Imdbrating'),
            'release_imdbvotes' => Yii::t('app', 'Release Imdbvotes'),
            'release_imdbid' => Yii::t('app', 'Release Imdbid'),
            'release_type' => Yii::t('app', 'Release Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReleases()
    {
        return $this->hasMany(Release::className(), ['release_id' => 'id']);
    }
}
