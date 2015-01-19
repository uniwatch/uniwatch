<?php
/* @var $this yii\web\View */
use app\assets\BaseAsset;

BaseAsset::register($this);
?>
<section id="home-page" class="page">
    <div id="logo">
        <img class="logo-image" src="/images/main_logo.png" alt="Be in time!"/>
    </div>
    <div id="catalog-link">
        <span>catalog</span>
    </div>
</section>

<section id="catalog-page" class="page">
    <div id="main-menu" role="navigation">
        <div class="menu-wrap">
            <div class="left">
                <ul class="menu-list">
                    <li class="menu-item">
                        <span class="home-icon"></span>
                    </li>
                    <li class="menu-item">
                        <a href="#">about us</a>
                    </li>
                    <li class="menu-item">
                        <a href="#">catalog</a>
                    </li>
                </ul>
            </div>
            <div class="center" id="menu-logo">
                <div class="menu-logo" >
                    <img src="/images/icons/logo_header_default.png" alt="Uniwatch catalog"/>
                </div>
            </div>
            <div class="right">
                <ul class="menu-list">
                    <li class="menu-item">
                        <a href="#">contacts</a>
                    </li>
                    <li class="menu-item">
                        <label>
                            <input type="text" class="search-input"/>
                        </label>
                    </li>
                    <li class="menu-item">
                        <span class="cart-icon"></span>
                        <span class="cart-count">1</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="products-list-wrap" ng-controller="catalogCtrl" load-products ng-init="init()">
<!--        <div class="debug">-->
<!--            <span id="pageCount">{{page}}</span>-->
<!--            <span id="pageSize">{{pageSize}}</span>-->
<!--        </div>-->

        <ul class="products-list">
            <li class="product-item" ng-repeat="product in products">
                <div class="product-item-inner" data-id="{{product.id}}" data-ng-click="viewProduct()">
                    <div class="image-container">
                        <img class="image" data-ng-src="{{product.img}}" align="center" alt=""/>
                    </div>
                    <div class="content-container">
                        <div class="description">
                            <div class="name-container">
                                <span class="name">{{product.name}}</span>
                            </div>
                            <div class="price-container">
                                <span class="price">{{product.price + product.currency}}</span>
                            </div>
                        </div>
                        <div class="buttons">
                            <span class="view-product"></span>
                            <span class="add-to-cart"></span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div id="load-trigger"></div>
</section>

<section id="footer">
    <div class="box contacts">
        <div class="contacts-inner">
            <div class="phone"><span>063 230 70 25</span></div>
            <div class="mail"><span>support@uniwatch.com</span></div>
        </div>
    </div>
    <div class="box links">
        <div class="links-inner">
            <ul class="links-list">
                <li class="links-item"><a href="#">homepage</a></li>
                <li class="links-item"><a href="#">about us</a></li>
                <li class="links-item"><a href="#">catalog</a></li>
                <li class="links-item"><a href="#">contacts</a></li>
                <li class="links-item"><a href="#">search</a></li>
                <li class="links-item"><a href="#">cart</a></li>
            </ul>
        </div>
    </div>
    <div class="box copyright">
        <div class="copyright-inner">
            <div class="image"><img src="/images/icons/footer_logo.png" alt="UNIWATCH"/></div>
            <div class="text"><span>All rights reserved. &copy; 2014 UNIWATCH</span></div>
        </div>
    </div>
    <div class="box social">
        <div class="social-inner">
            <div class="text">share</div>
            <div class="icons">
                <ul class="icons-list clearfix">
                    <li class="icon-item vk"></li>
                    <li class="icon-item twitter"></li>
                    <li class="icon-item instagram"></li>
                    <li class="icon-item google"></li>
                    <li class="icon-item facebook"></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--CART-->
<div id="cart" class="popup" ng-controller="cartCtrl">
    <div class="cart-wrap popup-content">
        <div class="cart-products">
            <ul class="cart-products-list">
                <li class="cart-product-item" ng-repeat="item in cart.items">
                    <div class="cart-product-image">
                        <img data-ng-src="{{item.image}}" alt=""/>
                    </div>
                    <div class="cart-product-body">
                        <div class="body-wrap">
                            <div class="name">{{item.name}}</div>
                            <div class="count">
                                <label><input type="text" ng-value="{{item.count}}" pattern="[0-9]"/></label>
                            </div>
                            <div class="price">{{item.price}}</div>
                        </div>
                    </div>
                    <span class="delete"></span>
                </li>
            </ul>
        </div>
        <div class="cart-total">
            <div class="total-count">
                <div class="text-wrap"><span class="text">Total items</span></div>
                <div class="number-wrap"><span class="number">20</span></div>
            </div>
            <div class="total-price">
                <div class="text-wrap"><span class="text">Order total</span></div>
                <div class="number-wrap"><span class="number">$ 4000</span></div>
            </div>
        </div>
        <div class="cart-controls">
            <span class="back-to-catalog" id="cartClose"></span>
            <span class="checkout" id="cartProceed"></span>
        </div>
    </div>
</div>
<!--CART-->

<!--CHECKOUT-->
<div id="checkout" class="popup" ng-controller="checkoutCtrl">
    <div class="checkout-wrap popup-content">
        <div class="checkout-heading">
            <h1 class="heading">secure checkout</h1>
        </div>
        <div class="checkout-body">
            <div class="order-form">
                <form action="" method="POST" name="checkoutForm" id="checkoutForm">
                    <div class="form-row">
                        <label class="first-name-text">first name <input type="text" name="firstName" class="first-name"/></label>
                    </div>
                    <div class="form-row">
                        <label class="last-name-text">last name <input type="text" name="lastName" class="last-name"/></label>
                    </div>
                    <div class="form-row">
                        <label class="phone-text">phone <input type="text" name="phone" class="phone"/></label>
                    </div>
                    <div class="form-row">
                        <label class="email-text">email <input type="text" name="email" class="email"/></label>
                    </div>
                    <div class="form-row">
                        <label class="city-text">city <input type="text" name="city" class="city"/></label>
                    </div>
                    <div class="form-row">
                        <label class="address-text">address <input type="text" name="address" class="address"/></label>
                    </div>
                    <div class="form-row bigger-margin">
                        <label class="phone-text">phone <input type="text" name="phone" class="phone"/></label>
                    </div>
                    <div class="form-row">
                        <label class="comment-text">comment <textarea name="comment" class="comment" cols="30" rows="10"></textarea></label>
                    </div>
                    <div class="form-row submit-button">
                        <button type="submit" id="submitOrder"></button>
                    </div>
                </form>
            </div>

            <div class="order-details">
                <div class="order-items-wrap">
                    <div class="details-heading">
                        <h3 class="heading">your order</h3>
                    </div>
                    <ul class="order-items-list">
                        <li class="order-item" ng-repeat="item in checkout.items">
                            <div class="item-image">
                                <img data-ng-src="{{item.image}}" alt=""/>
                            </div>
                            <div class="item-body">
                                <div class="item-body-wrap">
                                    <div class="name"><span>{{item.name}}</span></div>
                                    <div class="count">
                                        <label><input type="number" name="product.count" value="{{item.count}}"/></label></div>
                                    <div class="price"><span>{{item.price}}</span></div>
                                </div>
                            </div>
                            <span class="delete-order-item"></span>
                        </li>
                    </ul>
                </div>
                <div class="order-amount">
                    <div class="total-count">
                        <span class="text"></span>
                        <span class="count"></span>
                    </div>
                    <div class="total-price">
                        <span class="text"></span>
                        <span class="count"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--CHECKOUT-->


<!--THANK YOU PAGE-->
<div id="thank-you" class="popup">
    <div class="thank-you-wrap popup-content">
        <h2 class="thank-heading">thank you</h2>
        <div class="thank-body">
            <h3 class="thank-text">your order has been proceeded</h3>
            <div class="thank-logo">
                <img src="" alt="Be in time"/>
            </div>
        </div>
        <span class="close-button"></span>
    </div>
</div>
<!--THANK YOU PAGE-->


<!--PRODUCT VIEW-->
<div id="product-view" class="popup active" ng-controller="productCtrl">
    <div class="product-wrap popup-content">
        <div class="left-panel">
            <ul class="related-products-list purchased-together">
                <li class="related-product-item" ng-repeat="related in product.ordered">
                    <img class="related-image" data-ng-src="{{related.image}}" alt="{{related.name}}"/>
                </li>
            </ul>
        </div>

        <div class="middle-panel product-main-view">
            <div class="product-image">
                <img src="{{product.img}}" alt="product.name"/>
            </div>
            <div class="product-content">
                <div class="product-heading">
                    <h2 class="product-name">{{product.name}}</h2>
                    <span class="price">{{product.price}}</span>
                </div>
                <div class="product-body">
                    <div class="description">
                        {{product.desc}}
                    </div>
                    <div class="controls">
                        <span class="buy-button" id="product-buy">buy</span>
                        <span class="add-to-cart" id="product-add-to-cart">to cart</span>
                    </div>
                    <div class="recently-viewed">
                        <ul class=" related-products-list recently-viewed-list">
                            <li class="recently-viewed-item" ng-repeat="viewed in product.related">
                                <img data-ng-src="{{viewed.image}}" alt="{{viewed.name}}"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <span class="close-button" title="Back to catalog"></span>
        </div>

        <div class="right-panel">
            <ul class="related-products-list added-together">
                <li class="related-product-item" ng-repeat="related in product.carted">
                    <img class="related-image" data-ng-src="{{related.image}}" alt="{{related.name}}"/>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="loader" id="loader"></div>