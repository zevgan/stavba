<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Faktury;

/**
 * FakturySearch represents the model behind the search form of `app\models\Faktury`.
 */
class FakturySearch extends Faktury
{

    /**
     * @inheritdoc
     */

    public $detail_platby;

    public $zpusob_platby;
    public $platce;
    public $spolecnost;
    // public detail_id;
    public $detaily;
    public $detaily_ids;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['zpusob_platby', 'each', 'rule' => ['integer']],
            ['platce', 'each', 'rule' => ['integer']],
            ['spolecnost', 'each', 'rule' => ['integer']],
            ['detaily', 'each', 'rule' => ['integer']],
            [['detaily_ids'], 'each', 'rule' => ['integer']],


            [['datum_zp', 'zpusob_platby', 'datum_platby', 'poznamka', 'detaily',  'detaily_ids', 'spolecnost', 'platce'], 'safe'],
            [['bez_dph', 'dph', 'vc_dph'], 'number'],
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
//


        $query = Faktury::find();

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
            'bez_dph' => $this->bez_dph,
            'dph' => $this->dph,
            'vc_dph' => $this->vc_dph,
        ]);


        if (!is_null($this->datum_zp) && $this->datum_zp!='') {
        if (strpos($this->datum_zp, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->datum_zp);
            $query->andFilterWhere(['between', 'datum_zp', date("Y-m-d", strtotime($start_date)), date("Y-m-d", strtotime($end_date))]);

        } else {
            $query->andFilterWhere([
                'datum_zp' => date("Y-m-d", strtotime($this->datum_zp))
                ]);
        }
        }

        if (!is_null($this->datum_platby) && $this->datum_platby!='') {
            if (strpos($this->datum_platby, ' - ') !== false ) {
                list($start_date, $end_date) = explode(' - ', $this->datum_platby);
                $query->andFilterWhere(['between', 'datum_platby', date("Y-m-d", strtotime($start_date)), date("Y-m-d", strtotime($end_date))]);

            } else {
                $query->andFilterWhere([
                    'datum_platby' => date("Y-m-d", strtotime($this->datum_platby))
                ]);
            }
        } else {
            $query->andFilterWhere(['between', 'datum_platby', date("Y-m-01"), date("Y-m-t")]);
        }


        $query->andFilterWhere(['like', 'poznamka', $this->poznamka]);
       // $query->andFilterWhere(['=', 'spolecnost', $this->spolecnost]);



            //$query->andFilterWhere(["in", "detail_platby", $this->detail_platby]);
            $query->andFilterWhere(["in", "zpusob_platby", $this->zpusob_platby]);
            $query->andFilterWhere(["in", "zpusob_platby", $this->zpusob_platby]);
            $query->andFilterWhere(["in", "platce", $this->platce]);
            $query->andFilterWhere(["in", "spolecnost", $this->spolecnost]);

       // die(var_export($params, true));
        if ($this->detaily_ids!='') {

            $query->innerJoinWith('detaily', true);
            $query->andFilterWhere(["in", "faktura_detail.detail", $this->detaily_ids]);
        }





      //
        return $dataProvider;
    }
}
