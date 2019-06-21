<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgendamentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agendamento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_colaborador') ?>

    <?= $form->field($model, 'id_sala') ?>

    <?= $form->field($model, 'data_reserva') ?>

    <?= $form->field($model, 'hora_inicial') ?>

    <?php // echo $form->field($model, 'hora_final') ?>

    <?php // echo $form->field($model, 'computador') ?>

    <?php // echo $form->field($model, 'projetor') ?>

    <?php // echo $form->field($model, 'videoconferencia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
