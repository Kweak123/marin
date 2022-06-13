<?php

namespace app\models\product;

use app\models\product\ProductParamsLib;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * ProductParamsSearch represents the model behind the search form of `app\models\product\ProductParamsLib`.
 */
class ProductParamsSearch extends ProductParamsLib
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'genesis'], 'integer'],
            [['params'], 'safe'],
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
        $query = ProductParamsLib::find();

        if($query != null) {
            $query = ProductParamsLib::find()
                ->leftJoin(
                    'product_params_genesis',
                    'product_params_genesis.Id = product_params_lib.genesis'
                );
        }

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
            'genesis' => $this->genesis,
        ]);

        $query->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}
