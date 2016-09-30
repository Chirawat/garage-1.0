<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Viecle;

/**
 * ViecleSearch represents the model behind the search form about `app\models\Viecle`.
 */
class ViecleSearch extends Viecle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VID', 'model_year', 'CC', 'seat'], 'integer'],
            [['viecle_type', 'plate_no', 'serial', 'viecle_name', 'model', 'body_code', 'machine_code', 'body_type', 'weight'], 'safe'],
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
        $query = Viecle::find();

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
            'VID' => $this->VID,
            'model_year' => $this->model_year,
            'CC' => $this->CC,
            'seat' => $this->seat,
        ]);

        $query->andFilterWhere(['like', 'viecle_type', $this->viecle_type])
            ->andFilterWhere(['like', 'plate_no', $this->plate_no])
            ->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'viecle_name', $this->viecle_name])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'body_code', $this->body_code])
            ->andFilterWhere(['like', 'machine_code', $this->machine_code])
            ->andFilterWhere(['like', 'body_type', $this->body_type])
            ->andFilterWhere(['like', 'weight', $this->weight]);

        return $dataProvider;
    }
}
