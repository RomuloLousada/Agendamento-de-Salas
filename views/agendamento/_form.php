<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Colaborador;
use app\models\Sala;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Agendamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agendamento-form">

    <?php 
        $form = ActiveForm::begin(); 
        $modelSala = new Sala();
    ?>

    <?= $form->field($model, 'id_colaborador')->dropDownList(ArrayHelper::map(Colaborador::find()->orderBy('nome ASC')->all(), 'id', 'nome'), ['prompt' => 'Selecione um(a) Colaborador(a)'])->label('Colaborador *') ?>

    <?=
        $form->field($model, 'data_reserva')->widget(DatePicker::className(), [
            'name' => 'data_reserva',
            'options' => [
                'placeholder' => 'Selecione a data',
            ],
            'language' => 'pt-BR',
            'readonly' => true,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy',
                'startDate' => date('d-m-Y'),
                'todayHighlight' => true
            ],
            'pluginEvents' => [
                'changeDate' => 'function(dateText, inst) 
                {
                    $("select#agendamento-id_sala").html("<option>Realize a filtragem de sala acima.</option>");
                }'
            ]
        ])->label('Data da Reserva *')
    ?>
    
    <?= 
        $form->field($model, 'hora_inicial', 
        [
            'options' => 
            [
                'style' => 'float:left; margin-right:20px; width:45%;',
                'onchange' => '$("select#agendamento-id_sala").html("<option>Realize a filtragem de sala acima.</option>");'
                . 'var valorHoraIni = $("input#agendamento-hora_inicial").val();'
                . '$("input#agendamento-hora_inicial").val(valorHoraIni.replace(/_/g, "0"))',
            ]
        ])->widget(\yii\widgets\MaskedInput::className(), 
        [
            'mask' => 'h:m',
            'definitions' =>
            [
                'h' =>
                [
                    'cardinality' => 2,
                    'prevalidator' =>
                    [
                        ['validator' => '^([0-2])$', 'cardinality' => 1],
                        ['validator' => '^([0-9]|0[0-9]|1[0-9]|2[0-3])$', 'cardinality' => 2],
                    ],
                    'validator' => '^([0-9]|0[0-9]|1[0-9]|2[0-3])$'
                ],
                'm' =>
                [
                    'cardinality' => 2,
                    'prevalidator' =>
                    [
                        ['validator' => '^(0|[0-5])$', 'cardinality' => 1],
                        ['validator' => '^([0-5]?\d)$', 'cardinality' => 2],
                    ]
                ]
            ]
        ])->label('Hora Inicial *');
    ?>

    <?= 
        $form->field($model, 'hora_final', 
        [
            'options' => 
            [
                'style' => 'float:left; width:45%',
                'onchange' => '$("select#agendamento-id_sala").html("<option>Realize a filtragem de sala acima.</option>");'
                . 'var valorHoraFim = $("input#agendamento-hora_final").val();'
                . '$("input#agendamento-hora_final").val(valorHoraFim.replace(/_/g, "0"))',
            ]
        ])->widget(\yii\widgets\MaskedInput::className(), 
        [
            'mask' => 'h:m',
            'definitions' =>
            [
                'h' =>
                [
                    'cardinality' => 2,
                    'prevalidator' =>
                    [
                        ['validator' => '^([0-2])$', 'cardinality' => 1],
                        ['validator' => '^([0-9]|0[0-9]|1[0-9]|2[0-3])$', 'cardinality' => 2],
                    ],
                    'validator' => '^([0-9]|0[0-9]|1[0-9]|2[0-3])$'
                ],
                'm' =>
                [
                    'cardinality' => 2,
                    'prevalidator' =>
                    [
                        ['validator' => '^(0|[0-5])$', 'cardinality' => 1],
                        ['validator' => '^([0-5]?\d)$', 'cardinality' => 2],
                    ]
                ]
            ]
        ])->label('Hora Final *');
    ?>
    
     <?=
        $form->field($modelSala, 'qtde_cadeiras', ['enableClientValidation' => false, 'options' => ['style' => 'margin-right: 20px; width:45%']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '[9][9][9][9][9]',
        ])->label('Quantidade Mínima de Cadeiras');
    ?>
    
    <?php
    echo '<div class="form-group"> <label id="updateAgendamento" value="'.$model->id.'">Recursos da Sala</label><br>';
    echo '<label id="labelComputador" class = "checkbox-inline"><input type = "checkbox" value = "computador">Possui Computador</label>';
    echo '<label id="labelProjetor" class = "checkbox-inline"><input type = "checkbox" value = "projetor">Possui Projetor</label>';
    echo '<label id="labelVideoconferencia" class = "checkbox-inline"><input type = "checkbox" value = "videoconferencia">Possui Videoconferencia</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
    echo Html::a('Filtrar Salas', null, [
        'onclick' => '
                        var checkComputador = $("#labelComputador input").is(":checked");
                        checkComputador = checkComputador ? 1 : 0;
                        var checkProjetor = $("#labelProjetor input").is(":checked");
                        checkProjetor = checkProjetor ? 1 : 0;
                        var checkVideoconferencia = $("#labelVideoconferencia input").is(":checked");
                        checkVideoconferencia = checkVideoconferencia ? 1 : 0;
                        var numMinCadeiras = $("input#sala-qtde_cadeiras").val();
                        var data = $("input#agendamento-data_reserva").val();
                        var horaInicial = $("input#agendamento-hora_inicial").val();
                        var horaFinal = $("input#agendamento-hora_final").val();
                        var updateAgendamento = $("label#updateAgendamento").attr("value");
                        
                        checkHoraIni = horaInicial.replace(":", "");
                        checkHoraFim = horaFinal.replace(":", "");
                        
                        var dia  = data.split("-")[0];
                        var mes  = data.split("-")[1];
                        var ano  = data.split("-")[2];
                        
                        var dataFormatada = ano + "-" + ("0"+mes).slice(-2) + "-" + ("0"+dia).slice(-2);
                        var dataHoje = new Date();
                        var yyyy = dataHoje.getFullYear();
                        var mm = String(dataHoje.getMonth() + 1).padStart(2, "0");
                        var dd = String(dataHoje.getDate()).padStart(2, "0");
                        var hh = String(dataHoje.getHours()).padStart(2, "0");
                        var minutos = String(dataHoje.getMinutes()).padStart(2, "0");

                        var dataHoraInvalida = 0;
                        dataHoje = yyyy + "-" + mm + "-" + dd;

                        if(Date.parse(dataHoje) == Date.parse(dataFormatada))
                        {
                            var dataHoraInicial = dataFormatada.concat(" ", horaInicial);
                            dataHoje = dataHoje.concat(" ", hh, ":", minutos);
                            
                            if(Date.parse(dataHoraInicial) < Date.parse(dataHoje))
                            {
                                dataHoraInvalida = 1;
                            }
                        }
                        
                        if((data != "" && horaInicial != "" && horaFinal != "") && checkHoraIni < checkHoraFim && dataHoraInvalida == 0)
                        {
                            $.post("index.php?r=agendamento/filter&computador='.'"+checkComputador'
                            .'+"&projetor='.'"+checkProjetor'
                            .'+"&videoconferencia='.'"+checkVideoconferencia'
                            .'+"&numMinCadeiras='.'"+numMinCadeiras'
                            .'+"&data='.'"+data'
                            .'+"&horaInicial='.'"+horaInicial'
                            .'+"&horaFinal='.'"+horaFinal'
                            .'+"&update='.'"+updateAgendamento
                            , function(data)
                            {
                                $( "select#agendamento-id_sala" ).html(data);
                            });
                        }
                        else
                        {
                            if(checkHoraIni != "" && checkHoraFim != "" && checkHoraIni >= checkHoraFim)
                            {
                                alert("A hora inicial não pode ser maior que a hora final.");
                            }
                            else
                            {
                                if(dataHoraInvalida == "1")
                                {
                                    dataHoraAgora = dd + "-" + mm + "-" + yyyy + " " + hh + ":" + minutos;
                                    alert("A data e hora inicial não podem ser menores que agora. ("+dataHoraAgora+")");
                                }
                                else
                                {
                                    alert("Preencha os campos de data e hora do agendamento.");
                                }
                            }
                        }
                    ',
        'class' => 'btn btn-info'
    ]);
    echo '<div id="teste" class="help-block"></div></div>';
    ?>

    <?= $form->field($model, 'id_sala')->dropDownList(array(), ['prompt' => 'Realize a filtragem de sala acima.'])->label('Sala *') ?>
    
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
