<?php

namespace app\controllers;

use Yii;
use app\models\RegisteredCourses;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\Course;

/**
 * RegisteredController implements the CRUD actions for RegisteredCourses model.
 */
//session_start();
class RegisteredController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $prev = '';
    public $courses =[];
    public $courseList =[];
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
     * Lists all RegisteredCourses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RegisteredCourses::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegisteredCourses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
       return $this->render('view', [
           'model' => $model,
       ]);
     }

    /**
     * Creates a new RegisteredCourses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegisteredCourses();
        //var_dump($_POST);die;;

       if ($model->load(Yii::$app->request->post())) {
            

             // 
              
             if($model->save()) {
                Yii::$app->getSession()->setFlash('success','Course has been successfully saved');
                return $this->redirect(['view', 'id' => $model->id]);
             }
            
        }
        //Yii::$app->session->set('message','');
        return $this->render('create', [
            'model' => $model,
        ]);

        //var_dump($_POST);die;
    }

    /**
     * Updates an existing RegisteredCourses model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RegisteredCourses model.
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

    public function actionAdd() 
    {
        $model = new RegisteredCourses();
        
       if ($model->load(Yii::$app->request->post())) {
            $model->faculty_id = $_POST['RegisteredCourses']['faculty_id'];
            $model->dept_id = $_POST['RegisteredCourses']['dept_id'];
            $model->user_id = 1;
            $model->course_id = json_encode($_POST['course_id']);

         // 
          
         if($model->save()) {
             Yii::$app->getSession()->setFlash('success','Course has been successfully saved');
             $model = $this->findModel($model->id);
             $this->courses[] = json_decode($model->course_id);
        //var_dump($courses);die();
        //var_dump($this->courses);
             $ourCourses = $this->courses;
        //echo count($courses);die();

        $session = Yii::$app->session;
         $session['message'] = $ourCourses;
    
            return $this->redirect(['create']);
         }
        
        }
    }
            
    /**
     * Finds the RegisteredCourses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegisteredCourses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegisteredCourses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
