<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Colaborador */

$this->title = 'Criar Colaborador';
$this->params['breadcrumbs'][] = ['label' => 'Colaboradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colaborador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
