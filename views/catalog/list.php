<?php
/* @var $this yii\web\View */
/* @var string $wrapper */
use \app\assets\CatalogAsset;
CatalogAsset::register($this);
$this->title='Catalog - Bivic';
$this->dynamicPlaceholders['pageId'] = 'catalog';
?>
<?php if(!empty($wrapper) and true === $wrapper):?>
    <div id="content-wrapper">
<?php endif;?>
<?php foreach($items as $item):?>

<article class="catalog-item" style="background-image: url('<?php echo $item->img?>')">

    <div class="hidden">
        <header>
            <p class="entry-title"><a title="Permalink to <?=$item->name?>" href="<?php echo $item->url; ?>" rel="bookmark">
                    <?php echo $item->name; ?>
                </a></p>
        </header>
        <div class="catalog-item-go-button"><a href="<?php echo $item->url?>"></a></div>
        <footer>
                    <span class="catalog-item-price">

                        <span class="catalog-item-price-amount">
                            <?php echo ($price = $item->price)?$price:'';?>
                        </span>
                        <span class="catalog-item-price-currency">
                            <?php echo ($price)?'грн':'';?>
                        </span>
                    </span>
            <span class="catalog-item-buynow-button"><a href="<?php echo $item->url;?>">купить</a></span>
        </footer>
    </div>

</article>
<?endforeach;?>
<?php if(!empty($wrapper) and true === $wrapper):?>
    </div>
<?php endif;?>