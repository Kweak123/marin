<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatalogPhoto;

/**
 * CatalogPhotoSearch represents the model behind the search form of `app\models\CatalogPhoto`.
 */
class CatalogPhotoSearch extends CatalogPhoto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'category_id'], 'integer'],
            [['photo'], 'safe'],
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
        if(isset($_GET['id'])){
            $query = CatalogPhoto::find(['category_id' => $_GET['id']]);
        }
        else {
            $query = CatalogPhoto::find();
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
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}
