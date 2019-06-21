<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;

/**
 * This is the model class for table "agendamento".
 *
 * @property int $id
 * @property int $id_colaborador
 * @property int $id_sala
 * @property string $data_reserva
 * @property string $hora_inicial
 * @property string $hora_final
 */
class Agendamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agendamento';
    }

    public function behaviors() 
    {
        return 
        [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'data_reserva', // update 1 attribute 'created' OR multiple attribute ['created','updated']
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'data_reserva', // update 1 attribute 'created' OR multiple attribute ['created','updated']
                ],
                'value' => function ($event) {
                    return date('Y-m-d', strtotime($this->data_reserva));
                },
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_colaborador', 'id_sala', 'data_reserva', 'hora_inicial', 'hora_final'], 'required', 'message' => 'Campo de preenchimento obrigatório.'],
            [['id_colaborador', 'id_sala'], 'integer', 'message' => ''],
            [['data_reserva', 'hora_inicial', 'hora_final'], 'safe'],
            [['hora_inicial', 'hora_final'], 'validarHora'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function validarHora() 
    {
        $horaInicial = $this->hora_inicial;
        $horaFinal = $this->hora_final;

        if (strpos($horaInicial, '_') == true) 
        {
            $this->addError('hora_inicial', 'Preencha completamente o campo de hora inicial.');
        }
        
        if (strpos($horaFinal, '_') == true) 
        {
            $this->addError('hora_final', 'Preencha completamente o campo de hora final.');
        }
        
        if (strtotime($horaFinal) <= strtotime($horaInicial)) {
            $this->addError('hora_inicial', 'O valor da hora inicial é maior que a hora final.');
            $this->addError('hora_final', 'O valor da hora inicial é maior que a hora final.');
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_colaborador' => 'Colaborador',
            'id_sala' => 'Sala',
            'data_reserva' => 'Data Reserva',
            'hora_inicial' => 'Hora Inicial',
            'hora_final' => 'Hora Final',
        ];
    }
    
    public function getSala()
    {
        return $this->hasOne(Sala::className(), ['id' => 'id_sala']);
    }
    
    public function getColaborador()
    {
        return $this->hasOne(Colaborador::className(), ['id' => 'id_colaborador']);
    }
}
