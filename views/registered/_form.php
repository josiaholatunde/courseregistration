<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Faculty;
use app\models\Course;

/* @var $this yii\web\View */
/* @var $model app\models\RegisteredCourses */
/* @var $form yii\widgets\ActiveForm */
//session_start();
?>

<div class="registered-courses-form">
    
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
     <?= $form->field($model, 'faculty_id')->dropdownList(
         ArrayHelper::map(Faculty::find()->all(),'faculty_id','faculty_name'),[
             'prompt'=>'Select your Faculty',
             'onchange'=>'
                    $.post("index.php?r=department/lists&id='.'"+$(this).val(), 
                                function(data) {
                              $("select#deptId" ).html( data );
                            });
                        ']);
         ?>

       <?= $form->field($model, 'dept_id')->dropdownList(
                [],['prompt'=>'Select your department',
                'id'=>'deptId',
                'onchange'=>'
                    $.post("index.php?r=course/lists&id='.'"+$(this).val(), 
                                function(data) {
                              $("#courseId" ).html( data );
                            });
                
                
                ']); ?>

    <div id='courseId'></div>

    <div class="form-group">
        
        <input type='submit' value='ADD' class='btn btn-info'
         formaction='index.php?r=registered/add'>
                            
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']); ?>
    </div>

    <?= $msg = ''; ?>
     <?php if(Yii::$app->session->has('message')) { ?>
        <div id='msg' class='page-header'>
        <table class='table table-bordered table-striped'><tr><th>Course Code</th>
            <th>Course title</th><th>Units</th><th></tr>

            <?php
            
            (array)$courses[] = Yii::$app->session['message'];
            //var_dump($courses);die();
       
       
            if(!empty($courses)){
                foreach($courses as $course){
                    
                    $courseList = Course::find()->where(['course_id'=> $course[0][0]])->all();
                    
                        //print_r($courseList);die();
                      //  echo $courseList[0]['course_code'] . " ".$courseList[0]['course_description'];
                        //die();
                        //var_dump($courseList);die();
                      
                    // echo $course ."</br>"
                
                     $msg .= "<tr><td>".$courseList[0]['course_code']."</td><td> ".$courseList[0]['course_description'].
                    "</td><td>".$courseList[0]['units_load']."</td><td>Delete</td></tr>";

                   // $prev = $msg;
                }
                
                // $msg.= "</table>";
                 echo  $msg;
                  
                //$_SESSION['message'] = $msg;
                
            }

            
            ?>
        </div>
    <?php }  ?> 

            </table>
    <div id='msg'></div> 

    <?php ActiveForm::end(); ?>

</div>
