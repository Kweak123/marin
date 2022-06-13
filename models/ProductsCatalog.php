<?php


namespace app\models;

use app\models\product\Product;
use app\models\product\ProductParamsLib;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;


/**
 * ProductCatalog represents the model behind the search form of `app\models\product\Product`.
 */
class ProductsCatalog extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discription'], 'string'],
            [['price'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255],
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

        if(count($params)!=0){
            $query = Product::find()
                ->leftJoin('product_params_assoc', 'product_params_assoc.Product_Id = product.Id');

            foreach ($params as $key=>$value) {
                if($key != 'view')
                    $query = $query->andWhere(['product_params_assoc.Param_Id' => $value]);
            }
        }
        elseif(!isset($params['params']) or $params['params'] === null) {
            $query = Product::find()
                ->leftJoin('product_params_assoc', 'product_params_assoc.Product_Id = product.Id');
        }

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
            'title' => $this->title,
            'discription' => $this->discription,
            'price' => $this->price,
            'photo' => $this->photo,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'discription', $this->discription])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'photo', $this->photo]);


        return $dataProvider;
    }

    public function Params()
    {

        $query = (new \yii\db\Query())
            ->select('*')
            ->from('product_params_genesis')
            ->join('left join', 'product_params_lib', 'product_params_lib.genesis = product_params_genesis.Id')
            ->all();

        return ArrayHelper::index($query, 'Id', 'genesis');
    }


    function setParams($get){
    }
}
