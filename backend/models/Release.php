<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "release".
 *
 * @property integer $id
 * @property integer $release_id
 * @property string $episode_article_key
 * @property string $episode_url
 * @property string $episode_laguage
 * @property string $episode_title
 * @property integer $episode_season
 * @property integer $episode_season_number
 * @property integer $episode_views
 * @property integer $episode_released
 * @property integer $episode_rated
 * @property string $episode_runtime
 * @property string $episode_genre
 * @property string $episode_director
 * @property string $episode_writer
 * @property string $episode_actors
 * @property string $episode_plot
 * @property string $type
 *
 * @property FullName $release
 */
class Release extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'release';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['release_id', 'episode_season', 'episode_season_number', 'episode_views', 'episode_released', 'episode_rated'], 'integer'],
            [['episode_plot'], 'string'],
            [['episode_article_key', 'episode_laguage', 'episode_runtime', 'episode_genre', 'episode_director', 'episode_writer', 'episode_actors', 'type'], 'string', 'max' => 255],
            [['episode_url', 'episode_title'], 'string', 'max' => 1024],
            [['episode_article_key'], 'unique'],
            [['release_id'], 'exist', 'skipOnError' => true, 'targetClass' => FullName::className(), 'targetAttribute' => ['release_id' => 'id']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'release_id' => Yii::t('app', 'RELEASE_ID'),
            'episode_article_key' => Yii::t('app', 'EPISODE_ARTICLE_KEY'),
            'episode_url' => Yii::t('app', 'EPISODE_URL'),
            'episode_laguage' => Yii::t('app', 'EPISODE_LANGUAGE'),
            'episode_title' => Yii::t('app', 'EPISODE_NAME'),
            'episode_season' => Yii::t('app', 'EPISODE_SEASON'),
            'episode_season_number' => Yii::t('app', 'EPISODE_SEASON_NUMBER'),
            'episode_views' => Yii::t('app', 'EPISODE_VIEWS'),
            'episode_released' => Yii::t('app', 'EPISODE_RELEASED'),
            'episode_rated' => Yii::t('app', 'EPISODE_RATED'),
            'episode_runtime' => Yii::t('app', 'EPISODE_RUNTIME'),
            'episode_genre' => Yii::t('app', 'EPISODE_GENRE'),
            'episode_director' => Yii::t('app', 'EPISODE_DIRECTOR'),
            'episode_writer' => Yii::t('app', 'EPISODE_WRITER'),
            'episode_actors' => Yii::t('app', 'EPISODE_ACTORS'),
            'episode_plot' => Yii::t('app', 'EPISODE_PLOT'),
            'type' => Yii::t('app', 'TYPE'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelease()
    {
        return $this->hasOne(FullName::className(), ['id' => 'release_id']);
    }
}
