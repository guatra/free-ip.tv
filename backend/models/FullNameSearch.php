<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FullName;

/**
 * FullNameSearch represents the model behind the search form about `backend\models\FullName`.
 */
class FullNameSearch extends FullName
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'release_status', 'release_show'], 'integer'],
            [['release_name_ru', 'release_name_en', 'release_totalseasons', 'release_year', 'release_description', 'release_released', 'release_genre', 'release_director', 'release_actors', 'release_plot', 'release_language', 'release_country', 'release_awards', 'release_metascore', 'release_imdbrating', 'release_imdbvotes', 'release_imdbid', 'release_type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FullName::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'release_status' => $this->release_status,
            'release_show' => $this->release_show,
        ]);

        $query->andFilterWhere(['like', 'release_name_ru', $this->release_name_ru])
            ->andFilterWhere(['like', 'release_name_en', $this->release_name_en])
            ->andFilterWhere(['like', 'release_totalseasons', $this->release_totalseasons])
            ->andFilterWhere(['like', 'release_year', $this->release_year])
            ->andFilterWhere(['like', 'release_description', $this->release_description])
            ->andFilterWhere(['like', 'release_released', $this->release_released])
            ->andFilterWhere(['like', 'release_genre', $this->release_genre])
            ->andFilterWhere(['like', 'release_director', $this->release_director])
            ->andFilterWhere(['like', 'release_actors', $this->release_actors])
            ->andFilterWhere(['like', 'release_plot', $this->release_plot])
            ->andFilterWhere(['like', 'release_language', $this->release_language])
            ->andFilterWhere(['like', 'release_country', $this->release_country])
            ->andFilterWhere(['like', 'release_awards', $this->release_awards])
            ->andFilterWhere(['like', 'release_metascore', $this->release_metascore])
            ->andFilterWhere(['like', 'release_imdbrating', $this->release_imdbrating])
            ->andFilterWhere(['like', 'release_imdbvotes', $this->release_imdbvotes])
            ->andFilterWhere(['like', 'release_imdbid', $this->release_imdbid])
            ->andFilterWhere(['like', 'release_type', $this->release_type]);

        return $dataProvider;
    }
}
