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
  `createDate` datetime DEFAULT NULL,
  `updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
</pre>

in your view , you have to set url and relations for User like this following code :

<pre>
<?= \sintret\todolist\ListView::widget([
            'url' => \yii\helpers\Url::to(['/ajax/todolist'])
        ]);
        ?>
</pre>


in controllers :

<pre>
public function actionTodolist() {
        if(isset($_POST)){
            $model = new \sintret\todolist\models();
            $model->post = $_POST;
            echo $model->send();
        }
        
    }
</pre>