<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property integer $id
 * @property string $language
 * @property string $local
 * @property string $name
 * @property integer $default
 * @property integer $date_create
 * @property integer $date_update
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'local', 'name', 'date_create', 'date_update'], 'required'],
            [['default', 'date_create', 'date_update'], 'integer'],
            [['language', 'local', 'name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'language' => Yii::t('backend', 'Language'),
            'local' => Yii::t('backend', 'Local'),
            'name' => Yii::t('backend', 'Name'),
            'default' => Yii::t('backend', 'Default'),
            'date_create' => Yii::t('backend', 'Date Create'),
            'date_update' => Yii::t('backend', 'Date Update'),
        ];
    }
}
