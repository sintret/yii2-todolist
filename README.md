# yii2-todolist
yii2 to do list using adminlte template

you can preview in <a href="http://sintret.com/adiadrian">http://sintret.com/adiadrian</a> with username : kasir password : jakarta

create table todolist like these following :
<pre>
CREATE TABLE `todolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `params` text,
  `updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
</pre>

in your view , you have to set url and relations for User like this following code :

<pre>
<?= \sintret\todolist\ListView::widget([
            'url' => \yii\helpers\Url::to(['/ajax/todolist']),
            'relations' => app\models\User::className(),
        ]);
        ?>
</pre>


in controllers :

<pre>
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
</pre>