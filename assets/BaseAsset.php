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
    public $sourcePath = '@app/assets/base';
    public $baseUrl = '@web/assets';
    public $js = [
        'js/vendors/angular.min.js',
        'js/vendors/jquery.mousewheel.min.js',
        'js/vendors/gsap/TweenMax.min.js',
        'js/vendors/60fps-scroll.js',
        'js/vendors/gsap/plugins/ScrollToPlugin.min.js',
        'js/vendors/scrollMagic/jquery.scrollmagic.min.js',
        'js/vendors/scrollMagic/jquery.scrollmagic.debug.js',
        'js/vendors/transit.min.js',
        'js/vendors/ngStorage.js',
        'js/app.js',
        'js/modules/slider.js',
        'js/directives.js',
        'js/services.js'
    ];
    public $css = [
        'stylesheets/css/main.less'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
