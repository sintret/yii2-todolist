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
    public $model;
    public $url;
    public $relations;

    public function init() {
        if(isset($this->relations)){
            $this->model = new ToDoList();
            $this->model->relations=  $this->relations;
            
        }
        parent::init();
    }

    public function run() {
        parent::init();
        ListJs::register($this->view);
        $models = $this->model->records();
        return $this->render('index', [
                    'models' => $models,
                    'url' => $url,
        ]);
    }

    public static function data() {
        $output .='';
        $models = $this->model->records();
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
                <small class="label label-danger"><i class="fa fa-clock-o"></i>' . \kartik\helpers\Enum::timeElapsed($model->updateDate) . '</small>
                <!-- General tools such as edit or delete-->
                <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>';
            }

        return $output;
    }

}
