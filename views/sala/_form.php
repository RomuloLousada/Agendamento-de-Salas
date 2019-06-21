<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])->label('Nome *') ?>

    <?= $form->field($model, 'qtde_cadeiras')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '[9][9][9][9][9]',
    ])->label('Quantidade de Cadeiras *') ?>

    <?= $form->field($model, 'computador')->radioList([
            1 => 'Sim', 0 => 'Não'
        ])->label('Possui Computador? *');
    ?>

    <?= $form->field($model, 'projetor')->radioList([
            1 => 'Sim', 0 => 'Não'
        ])->label('Possui Projetor? *');
    ?>

    <?= $form->field($model, 'videoconferencia')->radioList([
            1 => 'Sim', 0 => 'Não'
        ])->label('Possui Sistema para Videoconferência? *');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
