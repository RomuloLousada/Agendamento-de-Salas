<?php

namespace app\controllers;

use Yii;
use app\models\Agendamento;
use app\models\AgendamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgendamentoController implements the CRUD actions for Agendamento model.
 */
class AgendamentoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Agendamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgendamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 20];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agendamento model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $connection = Yii::$app->getDb();

        $command = $connection->createCommand
        ("
            SELECT S.nome as sala, C.nome as colaborador
            FROM agendamento A
            LEFT JOIN sala S ON A.id_sala = S.id
            LEFT JOIN colaborador C ON A.id_colaborador = C.id
            WHERE A.id = '$id'
        ");
        
        $salaColaborador = $command->queryAll();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelSalaColaborador' => $salaColaborador,
        ]);
    }

    /**
     * Creates a new Agendamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agendamento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    /**
     * Updates an existing Agendamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $connection = Yii::$app->getDb();

        $command = $connection->createCommand
        ("
            SELECT S.nome as sala
            FROM agendamento A
            LEFT JOIN sala S ON A.id_sala = S.id
            WHERE A.id = '$id'
        ");

        $sala = $command->queryAll();

        $model->data_reserva = date('d-m-Y', strtotime($model->data_reserva));
        
        return $this->render('update', [
            'model' => $model,
            'modelSala' => $sala,
        ]);
    }

    /**
     * Deletes an existing Agendamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Filter the Sala model.
     * Filter the current available Salas based on the form options filled. Returns a select with the available Salas.
     * @return string
     */
    public function actionFilter($computador, $projetor, $videoconferencia, $numMinCadeiras, $data, $horaInicial, $horaFinal, $update) 
    {
        $connection = Yii::$app->getDb();
        $where = '';
        $whereInterno = '';
        $dataFormatada = date('Y-m-d', strtotime($data));

        if ($computador == 1) {
            $where .= 'S.computador = "1" AND ';
        }
        if ($projetor == 1) {
            $where .= 'S.projetor = "1"  AND ';
        }
        if ($videoconferencia == 1) {
            $where .= 'S.videoconferencia = "1"  AND ';
        }
        if ($numMinCadeiras != '') {
            $where .= 'S.qtde_cadeiras >= "'.$numMinCadeiras.'"  AND ';
        }
        
        if($update != '')
        {
            $whereInterno = 'AND AG.id <> "'.$update.'"';
        }

        $command = $connection->createCommand
        ("
            SELECT S.id, S.nome
            FROM sala S
            LEFT JOIN agendamento A ON A.id_sala = S.id
            WHERE $where
            S.id NOT IN
            (
                SELECT AG.id_sala
                FROM agendamento AG
                WHERE
                    AG.data_reserva = '$dataFormatada' AND 
                    (
                        '$horaInicial' >= AG.hora_inicial AND '$horaInicial' < AG.hora_final OR
                        '$horaFinal' > AG.hora_inicial AND '$horaFinal' <= AG.hora_final
                    ) $whereInterno
            )
            GROUP BY S.id
        ");

        $salas = $command->queryAll();

        echo "<option>Salas Filtradas:</option>";
        foreach ($salas as $sala) {
            echo "<option value='" . $sala['id'] . "'>" . $sala['nome'] . "</option>";
        }
    }

    /**
     * Finds the Agendamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agendamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agendamento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
