<?php

namespace app\controllers\admin\master;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenggunaController implements the CRUD actions for User model.
 */
class PenggunaController extends Controller
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
                    'only' => ['index','view','create','update','delete'],
                    'rules' => [
                        [
                            'actions' => ['index','view','create','update','delete'],
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['!=','id',\Yii::$app->user->identity->id]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        $authManager = \Yii::$app->authManager;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if($this->request->post('admin') !== null){
                    if(!$authManager->checkAccess($model->getId(),'admin')){
                        $adminRole = $authManager->getRole('admin');
                        $authManager->assign($adminRole, $model->getId());
                    }
                }else{
                    if($authManager->checkAccess($model->getId(),'admin')){
                        $adminRole = $authManager->getRole('admin');
                        $authManager->revoke($adminRole,$model->getId());
                    }
                }
                if($this->request->post('user') !== null){
                    if(!$authManager->checkAccess($model->getId(),'admin')){
                        $userRole = $authManager->getRole('user');
                        $authManager->assign($userRole, $model->getId());
                    }
                }else{
                    if($authManager->checkAccess($model->getId(),'user')){
                        $userRole = $authManager->getRole('user');
                        $authManager->revoke($userRole,$model->getId());
                    }
                }
                \Yii::$app->session->setFlash('success','Berhasil menambah pengguna');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'authManager' => $authManager
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $authManager = \Yii::$app->authManager;
        $model->password = '';
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            if($this->request->post('admin') !== null){
                if(!$authManager->checkAccess($model->id,'admin')){
                    $adminRole = $authManager->getRole('admin');
                    $authManager->assign($adminRole, $model->id);
                }
            }else{
                if($authManager->checkAccess($model->id,'admin')){
                    $adminRole = $authManager->getRole('admin');
                    $authManager->revoke($adminRole,$model->id);
                }
            }
            if($this->request->post('user') !== null){
                if(!$authManager->checkAccess($model->id,'admin')){
                    $userRole = $authManager->getRole('user');
                    $authManager->assign($userRole, $model->id);
                }
            }else{
                if($authManager->checkAccess($model->id,'user')){
                    $userRole = $authManager->getRole('user');
                    $authManager->revoke($userRole,$model->id);
                }
            }
            \Yii::$app->session->setFlash('success','Berhasil mengubah pengguna');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'authManager' => $authManager
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        \Yii::$app->session->setFlash('success','Berhasil menghapus pengguna');
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
