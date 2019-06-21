<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Sala', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nome',
            'qtde_cadeiras',
            [
                'label' => 'Possui Computador?',
                'attribute' => 'computador',
                'filter' => ['0' => 'Não', '1' => 'Sim'],
                'filterInputOptions' => ['prompt' => 'Todos', 'class' => 'form-control', 'id' => null],
                'value' => function($dataProvider)
                {
                    if ($dataProvider->computador)
                    {
                        return 'Sim';
                    }
                    return 'Não';
                },
            ],
            [
                'label' => 'Possui Projetor?',
                'attribute' => 'projetor',
                'filter' => ['0' => 'Não', '1' => 'Sim'],
                'filterInputOptions' => ['prompt' => 'Todos', 'class' => 'form-control', 'id' => null],
                'value' => function($dataProvider) {
                    if ($dataProvider->projetor) {
                        return 'Sim';
                    }
                    return 'Não';
                },
            ],
            [
                'label' => 'Possui Sistema de Videoconferência?',
                'attribute' => 'videoconferencia',
                'filter' => ['0' => 'Não', '1' => 'Sim'],
                'filterInputOptions' => ['prompt' => 'Todos', 'class' => 'form-control', 'id' => null],
                'value' => function($dataProvider) {
                    if ($dataProvider->videoconferencia) {
                        return 'Sim';
                    }
                    return 'Não';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=> 
                [
                    'delete' => function($url, $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], 
                        [
                            'class' => '',
                            'data' => 
                            [
                                'confirm' => 'Tem certeza que deseja deletar essa sala?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
