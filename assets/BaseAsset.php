<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class WithMenuAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/with-menu.css',
        'css/common/top-sidebar.css',
        'css/common/left-sidebar.css',
    ];
    public $js = [
        'js/menu/search.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
