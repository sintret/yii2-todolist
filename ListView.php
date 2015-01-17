<?php

/**
 * @link https://github.com/sintret/yii2-todolist
 * @copyright Copyright (c) 2014 Andy fitria 
 * @license MIT
 */

namespace sintret\todolist;

use Yii;
use yii\base\Widget;
use sintret\todolist\models\ToDoList;

/**
 * @author Andy Fitria <sintret@gmail.com>
 */
class ListView extends Widget {

    public $sourcePath = '@vendor/sintret/yii2-todolist/assets';
    public $css = [
    ];
    public $js = [ // Configured conditionally (source/minified) during init()
        'js/todolist.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $models;
    public $url;

    public function init() {
        parent::init();
    }

    public function run() {
        parent::init();
        ListJs::register($this->view);
        $view = $this->getView();
        $output = '';
        return $this->renderAjax('index', [
                    'model' => $model,
        ]);
    }

    public static function data() {
        $output .='';
        $models = ToDoList::records();
        if ($models)
            foreach ($models as $model) {
                if (isset($model->user->avatarImage)) {
                    $avatar = $model->user->avatarImage;
                } else
                    $avatar = Yii::getAlias("@vendor/sintret/yii2-chat-adminlte/assets/img/avatar.png");
                $output .= '<div class="item">
                <img class="online" alt="user image" src="' . $avatar . '">
                <p class="message">
                    <a class="name" href="#">
                        <small class="text-muted pull-right" style="color:green"><i class="fa fa-clock-o"></i> ' . \kartik\helpers\Enum::timeElapsed($model->updateDate) . '</small>
                        ' . $model->user->username . '
                    </a>
                   ' . $model->title . '
                </p>
            </div>';
            }

        return $output;
    }

}
