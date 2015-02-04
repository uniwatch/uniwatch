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

    $scope.cartCount = 0;

    $scope.storage = $localStorage.$default({
        cart: []
    });

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

    $scope.showCart = function() {
        $scope.showPopup('#cart');
    }
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

    $scope.viewProduct = function(id) {
        uniService.viewProduct(id).then(function(response) {
            if (response)  {
                $scope.showPopup('#product-view');

                $scope.productItem = response;

                uniService.setProductData($scope.productItem);
            }
        });
    };

    $scope.addToCart = function(id) {
        uniService.addToCart(id).then(function (response) {
            if (response) {

                uniService.setCartData();

                console.log('Success'. $scope.productItem.id);
            }
        });
    };

    $scope.checkout = function(id) {

    }
}]);

app.controller('productCtrl', ['$scope', 'uniService', function($scope, uniService) {
    $scope.product = {};

    $scope.$watch(function () {return uniService.getProductData();}, function (newValue, oldValue) {
        if (newValue != null) {
            //update Controller2's xxx value
            $scope.product= newValue;
        } else {
            $scope.product = {};
        }
    }, true);

    $scope.addToCart = function(id) {
        uniService.addToCart(id).then(
            // success
            function (response) {
                if (response) {
                    uniService.setCartData($scope.product);
                    $scope.showTooltip('Successfully added to cart.');
                }
            },
            // error
            function() {
                $scope.showTooltip('Internal server error.');

            }
        );
    };

    $scope.checkout = function(id) {
        console.log('checkout');
    }
}]);

app.controller('cartCtrl', ['$scope', '$localStorage', '$rootScope', 'uniService', function ($scope, $localStorage, $rootScope, uniService) {
    $scope.cart = [];



    $scope.$watch(function () {return uniService.getCartData();}, function (newVal, oldVal) {
        if (newVal != null) {
            $scope.cart = newVal;
        } else {
            $scope.cart = [];
        }

        if ($scope.cart.length > 0) {
            $rootScope.$apply(function() {
                $rootScope.cartCount = $scope.cart.length;
            });
        }
    });


    $scope.addItem = function () {
        console.log('add item');
    };

    $scope.deleteItem = function () {
        console.log('delete item')
    };

    $scope.changeAmount = function () {

    };
}]);

app.controller('checkoutCtrl', ['$scope', function($scope) {
    $scope.checkout = {
        items: [
            {
                name: 'Perrelet P Pierre Lanier',
                price: '4500',
                id: 1,
                count: 2,
                currency: '$',
                img: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                price: '4500',
                id: 2,
                count: 3,
                currency: '$',
                img: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                price: '4500',
                id: 3,
                count: 4,
                currency: '$',
                img: 'images/catalog/perrelet-a1047-2.jpg'
            }
        ]
    };

    $scope.proceedCheckout = function () {

    };

    $scope.cancelCheckout = function () {

    };
}]);
