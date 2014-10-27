<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\CategoryAsset;
CategoryAsset::register($this);
/* @var $this yii\web\View */
/* @var \app\models\Category[] $categories */
/* @var string $alias */
/* @var \app\models\Category $subcat*/
/* @var string $baseUri */
$this->title = 'Categories';
$this->dynamicPlaceholders['body_class'] = $alias;
$this->dynamicPlaceholders['pageId'] = $pageId;
?>
<div id="content-wrapper">
    <?php foreach($categories as $cat):
        if($cat->getProductsCount()):?>
        <div class="main-category" data-content="<?=$cat->id?>">
            <a href="<?php echo $baseUri . $cat->id; ?>">
                <h2><?php echo $cat->name?></h2>
            </a>
            <ul>
                <?php foreach($cat->getChildren() as $subcat):
                    if($subcat->getProductsCount()):?>
                    <li>
                        <a href="<?php echo $baseUri . $subcat->id;?>">
                            <?=$subcat->name;?> (<?=$subcat->getProductsCount();?>)
                        </a>
                    </li>
                <?php endif;endforeach; ?>
            </ul>
        </div>
    <?php endif;endforeach; ?>
</div>
