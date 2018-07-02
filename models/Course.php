<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property int $course_id
 * @property string $course_code
 * @property string $course_description
 * @property int $units_load
 * @property int $dept_id
 *
 * @property Department $dept
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_code', 'course_description', 'units_load', 'dept_id'], 'required'],
            [['units_load', 'dept_id'], 'integer'],
            [['course_code', 'course_description'], 'string', 'max' => 298],
            [['dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dept_id' => 'dept_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'course_code' => 'Course Code',
            'course_description' => 'Course Description',
            'units_load' => 'Units Load',
            'dept_id' => 'Dept ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDept()
    {
        return $this->hasOne(Department::className(), ['dept_id' => 'dept_id']);
    }
}
