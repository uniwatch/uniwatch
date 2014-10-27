<?php
/* @var $this yii\web\View */
use app\assets\ContactsAsset;
ContactsAsset::register($this);
$this->title='Catalog - Bivic';
$this->dynamicPlaceholders['pageId'] = 'contacts';
?>
<div id="content-wrapper">
    <h1>contact/index</h1>

    <p>
        You may change the content of this page by modifying
        the file <code><?= __FILE__; ?></code>.
    </p>
</div>
