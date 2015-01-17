<?php

namespace sintret\todolist\models;

use Yii;
//use app\models\User;

/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property string $message
 * @property integer $userId
 * @property string $updateDate
 */
class ToDoList extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'todolist';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title'], 'required'],
            [['userId'], 'integer'],
            [['updateDate', 'params'], 'safe']
        ];
    }

//    public function getUser() {
//        return $this->hasOne(User::className(), ['id' => 'userId']);
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'userId' => 'User',
            'updateDate' => 'Update Date',
            'params' => 'Params'
        ];
    }

    public function beforeSave($insert) {
        $this->userId = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }

    public static function records() {
        return static::find()->orderBy('id desc')->all();
    }

}
