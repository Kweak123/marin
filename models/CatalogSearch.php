<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Catalog;

/**
 * CatalogSearch represents the model behind the search form of `app\models\Catalog`.
 */
class CatalogSearch extends Catalog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'price'], 'integer'],
            [['label', 'photo_directory', 'photo_preview'], 'safe'],
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
        if(isset($_GET['lvl'])){
            $query = Catalog::find()
                ->leftJoin('catalog_level_assoc', 'catalog.id = catalog_level_assoc.catalog_id')
                ->where(['catalog_level_assoc.level_id'=>$_GET['lvl']]);
        }
        else {
            $query = Catalog::find();
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
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'photo_directory', $this->photo_directory])
            ->andFilterWhere(['like', 'photo_preview', $this->photo_preview]);

        return $dataProvider;
    }
}
