'use strict';
/*global $:false, jQuery:false */

var slider = angular.module('app.slider', []);

var app = angular.module('app', ['app.slider', 'ngStorage']);



app.controller('appCtrl', ['$scope', '$localStorage', function($scope, $localStorage) {
    /**
     * Used to prevent double animation execution;
     * true if animation is running
     */
    $scope.isAnimationRunning = false;

    $scope.isMainPage = true;

    $scope.isMenuStuck = false;

    $scope.windowHeight = $(window).height();

    $scope.storage = $localStorage.$default({
        cart: []
    });

    $scope.cartCount = $scope.storage.cart.length;


    /**
     * Detects scroll direction. You just need to pass scroll event;
     * @param event
     * @returns {boolean} true - scroll bottom, false - scroll top
     */
    $scope.scrollDirection = function(event) {
        return !(event.originalEvent.wheelDelta >= 0);
    };

    $scope.offsetY = 0;

    /**
     * Shows popup.
     * @param popup - jQuery selector
     */
    $scope.showPopup = function(popup) {
        var $popup = $(popup),
            $body  = $('body'),
            $menu  = $('#main-menu'),
            $foot  = $('#footer');

        if ($popup.length) {
            $('.popup').removeClass('active');
            $scope.offsetY = window.pageYOffset;

            $popup.fadeIn(function() {
                $body.addClass('fixed');
                $body.css('top', $scope.offsetY);
                $popup.addClass('active');
                $menu.addClass('fixed');
                $foot.addClass('fixed');
            });
        }
    };

    /**
     * Hides popup.
     * If argument not passed, then hides all popups.
     * @param popup - jQuery selector
     */
    $scope.hidePopup = function(popup) {
        var $popup = $(popup),
            $body  = $('body'),
            $menu  = $('#main-menu'),
            $foot  = $('#footer'),
            $win   = $(window);

        if (arguments.length && $popup.length) {
            $popup.removeClass('active');
        } else {
            $('.popup').removeClass('active');
        }

        setTimeout(function() {
            $popup.fadeOut();
        }, 500);

        setTimeout(function() {
            $body.removeClass('fixed');
            $body.css('top', $scope.offsetY);
            $menu.removeClass('fixed');
            $foot.removeClass('fixed');

            $win.scrollTop($scope.offsetY);
        }, 500);
    };

    $scope.showTooltip = function(text) {
        if (arguments.length) {
            var tooltip = $('#tooltip');

            if (tooltip.length) {
                tooltip.text(text);
                tooltip.fadeIn('slow');

                setTimeout(function () {
                    tooltip.fadeOut('slow');
                }, 3000)
            }
        } else {
            throw new Error('Invalid arguments passed');
        }
    };

    $scope.showThankYou = function() {
        var $popup = $('#thank-you'),
            $body = $('body');

        if ($popup.length) {
            $popup.fadeIn(function() {
                $body.addClass('fixed');
            });

            $popup.addClass('active');
        }

        setTimeout(function() {
            $scope.hideThankYou();
        }, 3000);
    };

    $scope.hideThankYou = function() {
        var $popup = $('#thank-you'),
            $body = $('body');

        if ($popup.length) {
            var isActive = $popup.hasClass('active');

            if (isActive) {
                $popup.removeClass('active');
                $popup.fadeOut();

                setTimeout(function() {
                    $body.removeClass('fixed');
                }, 500);
            }
        }
    };

    /**
     * Show cart popup;
     */
    $scope.showCart = function() {
        $scope.showPopup('#cart');
    };

    /**
     * Close cart popup;
     */
    $scope.closeCart = function() {
        $scope.hidePopup('#cart');
    };

}]);

app.controller('catalogCtrl', ['$scope', '$localStorage', 'uniService', function($scope, $localStorage, uniService) {
    $scope.productsList = [];
    $scope.productItem = {};

    $scope.page = 1;
    $scope.pageSize = 24;

    $scope.loadProducts = function (page, count) {
        var pageNum, pageSize;

        if (arguments.length) {
            pageNum  = page;
            pageSize = count;
        } else {
            pageNum  = $scope.page;
            pageSize = $scope.pageSize;
        }

        uniService.getProducts(pageNum, pageSize).then(
            // request success
            function(response) {
                var products = response;

                if (products.length) {
                    $scope.render(products);
                    $scope.page ++;
                }

                $('#loader').removeClass('active');
            },

            // request error
            function(error) {
                console.log(error);
            }
        );
    };

    $scope.render = function(products) {
        var count = $scope.productsList.length;

        if (count > 0) {
            $scope.productsList.concat(products);
        } else {
            $scope.productsList = products;
        }
    };

    $scope.viewProduct = function(id, event) {
        uniService.viewProduct(id).then(function(response) {
            if (response)  {

                $scope.productItem = response;

                uniService.setProductData($scope.productItem);

                var target = $(event.currentTarget),
                    isProductItem = target.hasClass('product-item-inner');

                // show product popup only if we click on it
                // but not when we try to add to cart or checkout
                if (isProductItem) {
                    $scope.showPopup('#product-view');
                }
            } else {
                $scope.showTooltip('Internal server error.')
            }
        });
    };

    /**
     * Add product to cart from main(catalog) page.
     * @param id
     * @param event
     */
    $scope.addToCart = function(id, event) {


        var productsList = $scope.productsList;

        // we should get product data before add to cart
        var product = uniService.getStoredProduct(id, productsList);

        uniService.addToCartAjax(id).then(ajaxCallback);

        function ajaxCallback(response) {
            if (response == 'true') {
                var cart = $scope.storage.cart;

                if (product != null) {
                    if (cart.length > 0) {
                        var sameProduct = uniService.findProductInCart(product, cart);

                        if (sameProduct != null) {
                            uniService.incrCountInCart(sameProduct, cart);
                        } else {
                            product.count = 1;
                            $scope.storage.cart.push(product);
                        }
                    } else {
                        product.count = 1;
                        $scope.storage.cart.push(product);
                    }
                }

                $scope.showTooltip('Successfully added to cart.');
            } else {
                $scope.showTooltip('Internal server error.')
            }
        }
    };

    $scope.checkout = function(id) {

    }
}]);

app.controller('productCtrl', ['$scope', 'uniService', function($scope, uniService) {
    $scope.product = {
        ordered: [],
        carted: [],
        viewed: []
    };

    $scope.$watch(function () {return uniService.getProductData();}, function (newValue, oldValue) {
        if (newValue != null) {
            //update Controller2's xxx value
            $scope.product= newValue;
        } else {
            $scope.product = {};
        }
    }, true);

    /**
     * Add to cart from product page.
     * @param id
     */
    $scope.addToCart = function(id) {
        uniService.addToCartAjax(id).then(ajaxCallback);

        function ajaxCallback(response) {
            if (response == 'true') {
                var cart    = $scope.storage.cart,
                    product = $scope.product;

                if (cart.length > 0) {
                    var sameProduct = uniService.findProductInCart(product, cart);

                    if (sameProduct != null) {
                        uniService.incrCountInCart(sameProduct, cart);
                    } else {
                        product.count = 1;
                        $scope.storage.cart.push(product);
                    }
                } else {
                    product.count = 1;
                    $scope.storage.cart.push(product);
                }

                $scope.showTooltip('Successfully added to cart.');
            } else {
                $scope.showTooltip('Internal server error.');
            }
        }
    };
}]);

app.controller('cartCtrl', ['$scope', 'uniService', function ($scope, uniService) {
    $scope.cart = $scope.storage.cart;

    $scope.totalCount = uniService.cartTotals($scope.cart).count;
    $scope.totalPrice = uniService.cartTotals($scope.cart).price;


    $scope.addItem = function () {
        console.log('add item');
    };

    $scope.removeItem = function(index) {
        $scope.cart.splice(index, 1);
    };

    $scope.total = function() {
        return uniService.cartTotals($scope.cart);
    };

    $scope.checkout = function() {
        $scope.showPopup('#checkout');

        uniService.setCheckoutData($scope.cart);
    };
}]);

app.controller('checkoutCtrl', ['$scope', 'uniService', function($scope, uniService) {
    $scope.checkout = [];

    $scope.$watch(function() {return uniService.getCheckoutData()}, function(newVal, oldVal) {
        if (newVal != null) {
            $scope.checkout = newVal;
        }
    });

    $scope.proceedCheckout = function () {
        uniService.submitCheckout($scope.checkout).then(function(response) {
            console.log(response);
        });
    };

    $scope.total = function() {

    };

    $scope.deleteItem = function() {

    };

    $scope.cancelCheckout = function () {

    };
}]);
