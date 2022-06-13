<?php

namespace app\models\product;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\product\ProductParamsGenesis;

/**
 * ProductParamsGenesisSearch represents the model behind the search form of `app\models\product\ProductParamsGenesis`.
 */
class ProductParamsGenesisSearch extends ProductParamsGenesis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['Id', 'integer'],
            ['label', 'string', 'max'=>255],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ProductParamsGenesis::find();

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
            'Id' => $this->Id,
            'label' => $this->label,
        ]);

        return $dataProvider;
    }
}
