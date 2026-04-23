<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Invoice;

/**
 * InvoiceSearch represents the model behind the search form of `app\models\Invoice`.
 */
class InvoiceSearch extends Invoice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_deposit', 'no', 'va_number', 'status', 'approved_by'], 'integer'],
            [['code', 'request_time', 'expired_time', 'no_reference', 'approved_date', 'created_at', 'updated_at', 'deleted_at', 'data_json'], 'safe'],
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

    public function getQuerySearch($params)
    {
        $query = Invoice::find();

        $this->load($params);

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_deposit' => $this->id_deposit,
            'no' => $this->no,
            'request_time' => $this->request_time,
            'expired_time' => $this->expired_time,
            'va_number' => $this->va_number,
            'status' => $this->status,
            'approved_by' => $this->approved_by,
            'approved_date' => $this->approved_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'no_reference', $this->no_reference])
            ->andFilterWhere(['like', 'data_json', $this->data_json]);

        return $query;
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
        $query = $this->getQuerySearch($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
