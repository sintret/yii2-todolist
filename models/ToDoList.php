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

    public $relations;

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

    public function getUser() {
        if (isset($this->relations))
            return $this->hasOne($this->relations, ['id' => 'userId']);
        else
            return $this->hasOne(\app\models\User::className(), ['id' => 'userId']);
    }

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

    public function records($status = 0) {
        return static::find()->where(['status' => $status])->orderBy('id desc')->all();
    }

}
