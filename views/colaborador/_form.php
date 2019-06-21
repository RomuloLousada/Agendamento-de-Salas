<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Colaborador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colaborador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
        $form->field($model, 'nome')->textInput(['maxlength' => true])->label('Nome *') 
    ?>

    <?= $form->field($model, 'email')->widget(\yii\widgets\MaskedInput::className(), [
            'clientOptions' => ['alias' => 'email'],
        ])->label('E-mail *') ?>

    <?=
        $form->field($model, 'telefone')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
        ])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
