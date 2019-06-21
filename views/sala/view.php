<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sala */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Salas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sala-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Nova Sala', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Atualizar ' . $model->nome, ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir ' . $model->nome, ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja deletar esta sala?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'qtde_cadeiras',
            [
                'label' => 'Possui Computador?',
                'value' => function($model)
                {
                    if($model->computador)
                    {
                        return 'Sim';
                    }
                    return 'Não';
                }   
            ],
            [
                'label' => 'Possui Projetor?',
                'value' => function($model)
                {
                    if ($model->projetor) 
                    {
                        return 'Sim';
                    }
                    return 'Não';
                }
            ],
            [
            'label' => 'Possui Sistema de Videoconferência?',
            'value' => function($model) {
                if ($model->videoconferencia) {
                    return 'Sim';
                }
                return 'Não';
            }
        ],
    ],
    ]) ?>

</div>
