<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sala".
 *
 * @property int $id
 * @property string $nome
 * @property int $qtde_cadeiras
 * @property int $computador
 * @property int $projetor
 * @property int $videoconferencia
 */
class Sala extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sala';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'qtde_cadeiras', 'computador', 'projetor', 'videoconferencia'], 'required', 'message' => 'Campo de preenchimento obrigatório.'],
            [['qtde_cadeiras', 'computador', 'projetor', 'videoconferencia'], 'integer', 'message' => 'Selecione uma Sala.'],
            [['nome'], 'string', 'max' => 128],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['nome', 'qtde_cadeiras', 'computador', 'projetor', 'videoconferencia'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'qtde_cadeiras' => 'Qtde Cadeiras',
            'computador' => 'Computador',
            'projetor' => 'Projetor',
            'videoconferencia' => 'Videoconferencia',
        ];
    }
    
    public function getAgendamento() {
        return $this->hasMany(Agendamento::className(), ['id_sala' => 'id']);
    }
}
