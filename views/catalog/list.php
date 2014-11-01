<?php
/* @var $this yii\web\View */
/* @var string $wrapper */
use \app\assets\CatalogAsset;
$this->title='Catalog - Bivic';
$this->dynamicPlaceholders['pageId'] = 'catalog';
?>
<?php if(!empty($wrapper) and true === $wrapper):?>
    <div id="content-wrapper">
<?php endif;?>
<?php foreach($items as $item):?>
<?php var_dump($items) ?>

<?endforeach;?>
<?php if(!empty($wrapper) and true === $wrapper):?>
    </div>
<?php endif;?>