<?php

namespace app\controllers;
use app\models\Course;

class CourseController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLists($id)
    {
        $courses = Course::find()
        ->where(['dept_id'=>$id])
        ->all();
        if(!empty($courses)) {
            $msg = "<table class='table table-striped table-bordered'><tr><th>S/N</th><th>Course Title</th>
            <th>Course Description</th><th>Units Load</th></tr>";
                foreach($courses as $course) {
                    $msg.= "<tr><td><input type='checkbox' name='course_id[]' 
                    value='".$course->course_id."'/></td><td>".$course->course_code."</td>
                    <td>".$course->course_description."</td><td>".$course->units_load."</td></tr>";
                }

            $msg.= "</table>";
            echo $msg;
        } else{
                echo "<div class='alert alert-danger'>No courses found</div>";
            }
    }

}
