<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property int $faculty_id
 * @property string $faculty_name
 *
 * @property Department[] $departments
 * @property RegisteredCourses[] $registeredCourses
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faculty_name'], 'required'],
            [['faculty_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'faculty_id' => 'Faculty ID',
            'faculty_name' => 'Faculty Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['faculty_id' => 'faculty_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredCourses()
    {
        return $this->hasMany(RegisteredCourses::className(), ['faculty_id' => 'faculty_id']);
    }
}
