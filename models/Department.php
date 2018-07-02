<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $dept_id
 * @property string $dept_name
 * @property int $faculty_id
 *
 * @property Faculty $faculty
 * @property RegisteredCourses[] $registeredCourses
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dept_name', 'faculty_id'], 'required'],
            [['faculty_id'], 'integer'],
            [['dept_name'], 'string', 'max' => 255],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id' => 'faculty_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dept_id' => 'Dept ID',
            'dept_name' => 'Dept Name',
            'faculty_id' => 'Faculty ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['faculty_id' => 'faculty_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredCourses()
    {
        return $this->hasMany(RegisteredCourses::className(), ['dept_id' => 'dept_id']);
    }
}
