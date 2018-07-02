<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RegisteredCourses */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registered Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registered-courses-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  if (Yii::$app->getSession()->hasFlash('success')) : ?>
        
    <?php  endif; ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=> 'dept_id' ,
                'value'=> $model->dept->dept_name
            ],
            [
                'attribute'=> 'faculty_id' ,
                'value'=> $model->faculty->faculty_name
            ],
            [
                'attribute'=> 'course_id' ,
                'value'=> $model->course_id
            ],
            
            
            
        ],
    ]) ?>

</div>
