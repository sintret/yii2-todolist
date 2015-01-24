<?php

/**
 * @link https://github.com/sintret/yii2-todolist
 * @copyright Copyright (c) 2014 Andy fitria 
 * @license MIT
 */

namespace sintret\todolist;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Andy Fitria <sintret@gmail.com>
 */
class ListJs extends AssetBundle {

    public $sourcePath = '@vendor/sintret/yii2-todolist/assets';
    public $js = [
        'js/icheck.js',
        'js/todolist.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
