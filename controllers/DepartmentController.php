<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Department;

class DepartmentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLists($id)
    {
        $departments = Department::find()
                   ->where(['faculty_id'=>$id])
                   ->all();
        if(!empty($departments)) {
            foreach($departments as $department) {
                echo "<option value = '".$department->dept_id."'>".$department->dept_name."</option>";
            }
        } else{
            echo "<option>-</option>";
        }

       // return $this->render('lists');
    }

}
