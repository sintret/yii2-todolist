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
 * @property string $createDate
 */
class ToDoList extends \yii\db\ActiveRecord {

    public $relations;
    public static $labels = ['info', 'danger', 'warning', 'success', 'primary', 'info', 'danger', 'warning', 'success', 'primary', 'info', 'danger', 'warning', 'success', 'primary',];
    public $post = [];

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
            [['updateDate', 'createDate', 'params'], 'safe']
        ];
    }

    public function getUser() {
        if (isset($this->relations))
            return $this->hasOne($this->relations, ['id' => 'userId']);
        else
            return $this->hasOne(Yii::$app->getUser()->identityClass, ['id' => 'userId']);
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
            'params' => 'Params',
            'createDate' => 'Create Date'
        ];
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->createDate = date('Y-m-d H:i:s');
        }
        $this->userId = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }

    public function records($status = 0) {
        return static::find()->where(['status' => $status])->limit(10)->orderBy('id desc')->all();
    }

    public function send() {
        $post = $this->post;
        if ($post) {
            $id = (int) $post['id'];
            $title = $post['title'];
            $type = (int) $post['type'];
            if ($id) {
                $model = static::findOne($id);
                $model->status = 1;
                $model->save();
            }
            if ($title) {
                $model = new \sintret\todolist\models\ToDoList();
                $model->title = $title;
                $model->userId = Yii::$app->user->id;
                $model->save();
            }
        }
        return $model->data($type);
    }

    public function data($status = 0) {
        $output = '';
        $models = $this->records($status);
        $num = 0;
        if ($models)
            foreach ($models as $model) {
                $checked = $model->status == 1 ? "checked" : "";

                $output .='<li>
                <!-- drag handle -->
                <span class="handle">
                    <i class="fa fa-ellipsis-v"></i>
                    <i class="fa fa-ellipsis-v"></i>
                </span>
                <!-- checkbox -->
                <input type="checkbox" ' . $checked . ' class="todolistCheck" value="' . $model->id . '" name="list"/>
                <!-- todo text -->
                <span class="text">' . $model->title . '</span>
                <!-- Emphasis label -->
                <small class="label label-' . self::$labels[$num] . '"><i class="fa fa-clock-o"></i>' . \kartik\helpers\Enum::timeElapsed($model->createDate) . '</small>
                <!-- General tools such as edit or delete-->
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>';
                $num++;
            }

        return $output;
    }

}
