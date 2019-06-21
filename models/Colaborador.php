<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "colaborador".
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $telefone
 */
class Colaborador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colaborador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'email'], 'required', 'message' => 'Campo de preenchimento obrigatório.'],
            [['nome'], 'string', 'max' => 256, 'message' => 'Nome muito extenso.'],
            [['email'], 'email', 'message' => 'Endereço de email inválido.'],
            [['email'], 'string', 'max' => 128, 'message' => 'Email muito extenso.'],
            [['telefone'], 'validarTelefone'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function validarTelefone()
    {
        $telefone = $this->telefone;
        if(strpos($telefone, '_') == true)
        {
            $this->addError('telefone', 'Preencha completamente o telefone ou deixe em branco.');
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'telefone' => 'Telefone',
        ];
    }
    
    public function getAgendamento()
    {
        return $this->hasMany(Agendamento::className(), ['id_colaborador' => 'id']);
    }
}
