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
class BaseAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'stylesheets/css/main.css',
    ];
    public $js = [
        'js/vendors/angular.min.js',
        'js/vendors/jquery.mousewheel.min.js',
        'js/vendors/gsap/TweenMax.min.js',
        'js/vendors/gsap/plugins/ScrollToPlugin.min.js',
        'js/vendors/scrollMagic/jquery.scrollmagic.min.js',
        'js/app.js',
        'js/directives.js',
        'js/services.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
