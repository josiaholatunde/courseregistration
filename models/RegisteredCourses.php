<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registered_courses".
 *
 * @property int $id
 * @property string $course_id
 * @property int $faculty_id
 * @property int $dept_id
 * @property int $user_id
 *
 * @property Department $dept
 * @property Faculty $faculty
 */
class RegisteredCourses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registered_courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'faculty_id', 'dept_id', 'user_id'], 'required'],
            [['course_id'], 'string'],
            [['faculty_id', 'dept_id', 'user_id'], 'integer'],
            [['dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dept_id' => 'dept_id']],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id' => 'faculty_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'faculty_id' => 'Faculty ID',
            'dept_id' => 'Dept ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDept()
    {
        return $this->hasOne(Department::className(), ['dept_id' => 'dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['faculty_id' => 'faculty_id']);
    }
    
   
}
