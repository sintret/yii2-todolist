# yii2-todolist
yii2 to do list using adminlte template

in controllers :


public function actionTodolist() {
        $id = (int)$_POST['id'];
        $title = $_POST['title'];
        $type = (int)$_POST['type'];
        if ($id) {
            $model = \sintret\todolist\models\ToDoList::findOne($id);
            $model->status = 1;
            $model->save();
        }
        if ($title) {
            $model = new \sintret\todolist\models\ToDoList();
            $model->title = $title;
            $model->userId = Yii::$app->user->id;
            if ($model->save()) {
                echo $model->data();
            }
        }
        if(isset($_POST['type'])){
            $model = new \sintret\todolist\models\ToDoList();
            echo $model->data($type);
        }
        
    }