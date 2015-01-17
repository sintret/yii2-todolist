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
        if (isset($this->relations)) {
            $this->model = new ToDoList();
            $this->model->relations = $this->relations;
        }
        parent::init();
    }

    public function run() {
        parent::init();
        $view = $this->getView();
        ListJs::register($this->view);
        $pasive = $this->model->data(1);
        $data = $this->model->data();
        return $this->render('index', [
                    'data' => $data,
                    'url' => $this->url,
        ]);
    }

}
