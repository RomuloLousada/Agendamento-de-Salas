<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agendamento;

/**
 * AgendamentoSearch represents the model behind the search form of `app\models\Agendamento`.
 */
class AgendamentoSearch extends Agendamento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id_colaborador', 'id_sala', 'data_reserva', 'hora_inicial', 'hora_final'], 'safe'],
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
        $query = Agendamento::find();

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

        $query->joinWith('colaborador');
        $query->joinWith('sala');
        
        $dataProvider->setSort([
            'attributes' => 
            [
                'id_colaborador' => 
                [
                    'asc' => ['colaborador.nome' => SORT_ASC],
                    'desc' => ['colaborador.nome' => SORT_DESC],
                ],
                'id_sala' => 
                [
                    'asc' => ['sala.nome' => SORT_ASC],
                    'desc' => ['sala.nome' => SORT_DESC],
                ]
            ]
        ]);
        
        if($this->data_reserva != '')
        {
            $data = date('Y-m-d', strtotime($this->data_reserva));
        }
        else
        {
            $data = '';
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'data_reserva' => $data,
            'hora_inicial' => $this->hora_inicial,
            'hora_final' => $this->hora_final,
        ]);
        
        $query->andFilterWhere(['like', 'colaborador.nome', $this->id_colaborador,])
            ->andFilterWhere(['like', 'sala.nome', $this->id_sala]);

        return $dataProvider;
    }
}
