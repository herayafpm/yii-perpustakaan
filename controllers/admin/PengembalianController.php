<?php

namespace app\controllers\admin;

use app\models\Buku;
use app\models\Pengembalian;
use app\models\PengembalianSearch;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PengembalianController implements the CRUD actions for Pengembalian model.
 */
class PengembalianController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index','view','create','delete'],
                    'rules' => [
                        [
                            'actions' => ['index','view'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                        [
                            'actions' => ['create','delete'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pengembalian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PengembalianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengembalian model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pengembalian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pengembalian();
        $model->admin_id = \Yii::$app->user->identity->id;
        $bukus = Buku::find()->all();
        $users = User::find()->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                \Yii::$app->session->setFlash('success','Berhasil menambah pengembalian');
                return $this->refresh();
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'bukus' => $bukus,
            'users' => $users,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pengembalian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        \Yii::$app->session->setFlash('success','Berhasil menghapus pengembalian');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pengembalian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pengembalian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengembalian::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
