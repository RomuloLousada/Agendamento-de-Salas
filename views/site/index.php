<?php

/* @var $this yii\web\View */

$this->title = 'Sistema de Agendamentos';
use yii\helpers\Url;

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Sistema de Agendamento de Salas</h1>

        <p class="lead">Utilize o menu superior para navegar entre as páginas de cadastro de colaboradores, salas e agendamentos.</p>
        <p class="lead">Também é possível utilizar os botões abaixo para direcionar para as respectivas páginas.</p>

        <!--<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Colaboradores</h2>

                <p>Tela responsável pela criação e atualização dos colaboradores.</p>

                <?php
                    echo '<p><a class="btn btn-default" href="'.Url::to('index.php?r=colaborador').'">Gerenciar Colaboradores &raquo;</a></p>';
                ?>
            </div>
            <div class="col-lg-4">
                <h2>Salas</h2>

                <p>Tela responsável pela criação e atualização das salas.</p>
                
                <?php
                    echo '<p><a class="btn btn-default" href="' . Url::to('index.php?r=sala') . '">Gerenciar Salas &raquo;</a></p>';
                ?>
            </div>
            <div class="col-lg-4">
                <h2>Agendamentos</h2>

                <p>Tela responsável pela criação e atualização dos agendamentos.</p>
                
                <?php
                    echo '<p><a class="btn btn-default" href="' . Url::to('index.php?r=agendamento') . '">Gerenciar Agendamentos &raquo;</a></p>';
                ?>
            </div>
        </div>

    </div>
</div>
