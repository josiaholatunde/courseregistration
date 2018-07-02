<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registered Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registered-courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registered Courses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [ 'attribute' => 'dept_id', 'format' => 'raw', 'value' => function ($data) {
                    return $data->dept->dept_name;
            }],
            [ 'attribute' => 'faculty_id', 'format' => 'raw', 'value' => function ($data) {
                return $data->faculty->faculty_name;
              }],

              [ 'attribute' => 'course_id', 'format' => 'raw', 'value' => function ($data) {
                return $data->course->course_description;
              }],
              

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
