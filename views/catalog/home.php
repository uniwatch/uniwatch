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
                            <input type="text" ng-model="search" class="search-input"/>
                        </label>
                    </li>
                    <li class="menu-item" id="cart-button" ng-click="showCart()">
                        <span class="cart-icon"></span>
                        <span class="cart-count">{{storage.cart.length}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="products-list-wrap" ng-controller="catalogCtrl" load-products ng-init="loadProducts()">
        <ul class="products-list">
            <li class="product-item" ng-repeat="product in productsList | filter:search">
                <div class="product-item-inner" data-id="{{product.id}}" data-ng-click="viewProduct(product.id, $event)">
                    <div class="image-container">
                        <img class="image" data-ng-src="{{product.img}}" align="center" alt=""/>
                    </div>
                    <div class="content-container">
                        <div class="description">
                            <div class="name-container">
                                <span class="name">{{product.name}}</span>
                            </div>
                            <div class="price-container">
                                <span class="price">{{product.price | currency}}</span>
                            </div>
                        </div>
                        <div class="buttons">
                            <span class="view-product" title="View"></span>
                            <span class="add-to-cart" title="To cart" data-ng-click="addToCart(product.id, $event)"></span>
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
                    <li class="icon-item vk"><a class="social-link" href="#"></a></li>
                    <li class="icon-item twitter"><a class="social-link" href="#"></a></li>
                    <li class="icon-item instagram"><a class="social-link" href="#"></a></li>
                    <li class="icon-item google"><a class="social-link" href="#"></a></li>
                    <li class="icon-item facebook"><a class="social-link" href="#"></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--CART-->
<div id="cart" class="popup" ng-controller="cartCtrl">
    <div class="cart-wrap popup-content" ng-if="storage.cart.length">
        <div class="cart-products">
            <ul class="cart-products-list">
                <li class="cart-product-item" ng-repeat="item in storage.cart">
                    <div class="cart-product-image">
                        <img data-ng-src="{{item.img}}" alt=""/>
                    </div>
                    <div class="cart-product-body">
                        <div class="body-wrap">
                            <div class="name">{{item.name}}</div>
                            <div class="count">
                                <label><input type="number" ng-model="item.count" ng-required pattern="[0-9]"/></label>
                            </div>
                            <div class="price">{{item.price * item.count | currency}}</div>
                        </div>
                    </div>
                    <span class="delete" ng-click="removeItem($index)"></span>
                </li>
            </ul>
        </div>

        <div class="cart-total">
            <div class="total-count">
                <div class="text-wrap"><span class="text">Total items</span></div>
                <div class="number-wrap"><span class="number">{{total().count}}</span></div>
            </div>
            <div class="total-price">
                <div class="text-wrap"><span class="text">Order total</span></div>
                <div class="number-wrap"><span class="number">{{total().price | currency}}</span></div>
            </div>
        </div>

        <div class="cart-controls">
            <span class="back-to-catalog" id="cartClose" ng-click="closeCart()"></span>
            <span class="checkout" id="cartProceed" ng-click="checkout()"></span>
        </div>
    </div>

    <div class="cart-wrap popup-content" ng-if="!storage.cart.length">
        <h4 class="heading">There is no items in cart.</h4>
    </div>
</div>
<!--CART-->

<!--CHECKOUT-->
<div id="checkout" class="popup" ng-controller="checkoutCtrl">
    <div class="checkout-wrap popup-content">
        <div class="checkout-content">
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
                            <button type="button" id="submitOrder" ng-click="proceedCheckout()"></button>
                        </div>
                    </form>
                </div>

                <div class="order-details">
                    <div class="order-items-wrap">
                        <div class="details-heading">
                            <h3 class="heading">your order</h3>
                        </div>
                        <ul class="order-items-list">
                            <li class="order-item" ng-repeat="item in checkout">
                                <div class="item-image">
                                    <img data-ng-src="{{item.img}}" alt=""/>
                                </div>
                                <div class="item-body">
                                    <div class="item-body-wrap">
                                        <div class="name"><span>{{item.name}}</span></div>
                                        <div class="count">
                                            <label><input type="number" name="product.count" value="{{item.count}}"/></label></div>
                                        <div class="price"><span>{{item.price | currency}}</span></div>
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
</div>
<!--CHECKOUT-->


<!--THANK YOU PAGE-->
<div id="thank-you" class="popup">
    <div class="thank-you-wrap popup-content">
        <div class="popup-inner">
            <h2 class="thank-heading">thank you</h2>
            <div class="thank-body">
                <h3 class="thank-text">your order has been proceeded</h3>
                <div class="thank-logo">
                    <img src="/images/icons/logo_header_default.png" alt="Be in time"/>
                </div>
            </div>
            <span class="close-button" ng-click="hideThankYou()"></span>
        </div>
    </div>
</div>
<!--THANK YOU PAGE-->


<!--PRODUCT VIEW-->
<div id="product-view" class="popup" ng-controller="productCtrl">
    <div class="product-wrap popup-content">
        <div class="left-panel" ng-if="product.ordered.length">
            <ul class="related-products-list purchased-together">
                <li class="related-product-item" ng-repeat="related in product.ordered">
                    <img class="related-image" data-ng-src="{{related.img}}" alt="{{related.name}}"/>
                </li>
            </ul>
        </div>

        <div class="middle-panel product-main-view">
            <div class="middle-panel-inner">
                <div class="product-image">
                    <img data-ng-src="{{product.img}}" alt="product.name"/>
                </div>

                <div class="product-content">
                    <div class="product-heading">
                        <h2 class="product-name">{{product.name}}</h2>
                        <span class="price">{{product.price | currency}}</span>
                    </div>
                    <div class="product-body">
                        <div class="description">
                            {{product.desc}}
                        </div>
                        <div class="controls">
                            <span class="buy-button" id="product-buy" ng-click="checkOut(product.id)">buy</span>
                            <span class="add-to-cart" id="product-add-to-cart" ng-click="addToCart(product.id)">to cart</span>
                        </div>
                        <slider items-width="150" items="product.viewed"></slider>
                    </div>
                </div>
            </div>

            <span class="close-button" title="Back to catalog" data-ng-click="hidePopup('#product-view')"></span>
        </div>

        <div class="right-panel" ng-if="product.carted.length">
            <ul class="related-products-list added-together">
                <li class="related-product-item" ng-repeat="related in product.carted">
                    <img class="related-image" data-ng-src="{{related.img}}" alt="{{related.name}}"/>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="loader" id="loader"></div>
<div id="tooltip"></div>

<span class="button" style="position: fixed; top: 20px; right: 20px; color: red" ng-click="showThankYou()">TOGGLE ACTIVE</span>

<!--<script>-->
<!--    var toggle = true;-->
<!--    function toggleActive() {-->
<!--//        var block = $('.middle-panel');-->
<!--        var block = $('#product-view');-->
<!--        if (toggle) {-->
<!--            block.addClass('active');-->
<!--//            block.transition({-->
<!--//                perspective: '900px',-->
<!--//                rotateX: '45deg',-->
<!--//                x: '-50%',-->
<!--//                y: '-50%',-->
<!--//                scale: ['1.7', '1.7']-->
<!--//            });-->
<!--        } else {-->
<!--            block.removeClass('active');-->
<!--//            block.transition({-->
<!--//                perspective: '900px',-->
<!--//                rotateX: '0deg',-->
<!--//                x: '-50%',-->
<!--//                y: '-50%',-->
<!--//                scale: ['1', '1']-->
<!--//            });-->
<!--        }-->
<!--        toggle = !toggle-->
<!--    }-->
<!--//<!--</script>-->