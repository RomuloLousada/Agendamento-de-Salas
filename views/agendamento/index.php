<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AgendamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agendamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agendamento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Agendamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_colaborador',
                'value' => 'colaborador.nome'
            ],
            [
                'attribute' => 'id_sala',
                'value' => 'sala.nome'
            ],
            [
                'attribute' => 'data_reserva',
                'format' => ['date', 'php:d-m-Y']
            ],
            'hora_inicial',
            'hora_final',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' =>
                [
                    'delete' => function($url, $model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id],
                        [
                            'class' => '',
                            'data' =>
                            [
                                'confirm' => 'Tem certeza que deseja deletar esse agendamento?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
