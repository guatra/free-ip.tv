<?php

namespace frontend\models;

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
 * @property string $release_description
 * @property integer $release_released
 * @property string $release_channel
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
 * @property string $release_trailer
 * @property integer $release_lostfilmid
 * @property string $release_lostfilmrating
 * @property integer $release_lostfilmvotes
 * @property string $release_lostfilm_alias
 * @property integer $release_zona_mobi_id
 * @property string $release_zona_mobi_rating
 * @property integer $release_zona_mobi_votes
 * @property string $release_zona_mobi_alias
 * @property string $release_preview_image
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
            [['release_status', 'release_show', 'release_released', 'release_lostfilmid', 'release_lostfilmvotes', 'release_zona_mobi_id', 'release_zona_mobi_votes'], 'integer'],
            [['release_plot'], 'string'],
            [['release_name_ru', 'release_name_en', 'release_totalseasons', 'release_description', 'release_genre', 'release_director', 'release_actors', 'release_language', 'release_country', 'release_awards', 'release_metascore', 'release_imdbrating', 'release_imdbvotes', 'release_imdbid', 'release_type', 'release_trailer', 'release_preview_image'], 'string', 'max' => 1024],
            [['release_channel', 'release_lostfilm_alias', 'release_zona_mobi_alias'], 'string', 'max' => 255],
            [['release_lostfilmrating', 'release_zona_mobi_rating'], 'string', 'max' => 10],
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
            'release_description' => Yii::t('app', 'Release Description'),
            'release_released' => Yii::t('app', 'Release Released'),
            'release_channel' => Yii::t('app', 'Release Channel'),
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
            'release_trailer' => Yii::t('app', 'Release Trailer'),
            'release_lostfilmid' => Yii::t('app', 'Release Lostfilmid'),
            'release_lostfilmrating' => Yii::t('app', 'Release Lostfilmrating'),
            'release_lostfilmvotes' => Yii::t('app', 'Release Lostfilmvotes'),
            'release_lostfilm_alias' => Yii::t('app', 'Release Lostfilm Alias'),
            'release_zona_mobi_id' => Yii::t('app', 'Release Zona Mobi ID'),
            'release_zona_mobi_rating' => Yii::t('app', 'Release Zona Mobi Rating'),
            'release_zona_mobi_votes' => Yii::t('app', 'Release Zona Mobi Votes'),
            'release_zona_mobi_alias' => Yii::t('app', 'Release Zona Mobi Alias'),
            'release_preview_image' => Yii::t('app', 'Release Preview Image'),
        ];
    }
}
