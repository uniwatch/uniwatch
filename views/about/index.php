<?php
/* @var $this yii\web\View */
use app\assets\AboutAsset;
AboutAsset::register($this);
$this->title='About us - Bivic';
$this->dynamicPlaceholders['pageId'] = 'about';
?>
<div id="content-wrapper">
    <h1>about/index</h1>

    <p>
        You may change the content of this page by modifying
        the file <code><?= __FILE__; ?></code>.
    </p>
</div>