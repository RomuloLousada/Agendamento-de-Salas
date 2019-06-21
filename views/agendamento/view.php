<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Agendamento */

$this->title = 'Agendamento - '.$modelSalaColaborador[0]['sala'];
$this->params['breadcrumbs'][] = ['label' => 'Agendamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="agendamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Novo Agendamento', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja deletar este agendamento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Colaborador',
                'value' => $modelSalaColaborador[0]['colaborador'],
            ],
            [
                'label' => 'Sala',
                'value' => $modelSalaColaborador[0]['sala'],
            ],
            [
                'label' => 'Data da Reserva',
                'value' => date('d-m-Y', strtotime($model->data_reserva)),
            ],
            'hora_inicial',
            'hora_final',
        ],
    ]) ?>
</div>
