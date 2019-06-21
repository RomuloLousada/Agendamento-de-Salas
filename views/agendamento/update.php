<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Agendamento */

$this->title = 'Atualizar Agendamento: ' . $modelSala[0]['sala'] . ' - ' . $model->hora_inicial . 'h às ' . $model->hora_final . 'h';
$this->params['breadcrumbs'][] = ['label' => 'Agendamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelSala[0]['sala'], 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="agendamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
