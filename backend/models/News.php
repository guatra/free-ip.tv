<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $author
 * @property string $description
 * @property string $keywords
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $type
 * @property integer $series_id
 * @property integer $season_id
 * @property integer $episode_id
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at', 'series_id', 'season_id', 'episode_id'], 'integer'],
            [['title', 'author', 'description', 'keywords', 'type'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'image' => Yii::t('app', 'Image'),
            'author' => Yii::t('app', 'Author'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'type' => Yii::t('app', 'Type'),
            'series_id' => Yii::t('app', 'Series ID'),
            'season_id' => Yii::t('app', 'Season ID'),
            'episode_id' => Yii::t('app', 'Episode ID'),
        ];
    }
}