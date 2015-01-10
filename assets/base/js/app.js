'use strict';
/*global $:false, jQuery:false */

var app = angular.module('app', ['ngRoute'])
    .config(function($routeProvider, $locationProvider) {
        $routeProvider
            .when('/product/:productId', {
                controller: 'productCtrl'
            });

        // configure html5 to get links working on jsfiddle
        $locationProvider.html5Mode(true);
    });



app.controller('appCtrl', ['$scope', function($scope) {
    /**
     * Used to prevent double animation execution;
     * true if animation is running
     */
    $scope.isAnimationRunning = false;

    $scope.isMainPage = true;

    $scope.isMenuStuck = false;

    $scope.windowHeight = $(window).height();

    /**
     * Detects scroll direction. You just need to pass scroll event;
     * @param event
     * @returns {boolean} true - scroll bottom, false - scroll top
     */
    $scope.scrollDirection = function(event) {
        return !(event.originalEvent.wheelDelta >= 0);
    };

    /**
     * Shows popup.
     * @param popup - jQuery selector
     */
    $scope.showPopup = function(popup) {
        var popupObj = $(popup);

        if (popupObj.length) {
            $('body').addClass('fixed');
            $('.popup').removeClass('active');

            $(popup).addClass('active');
        }
    };

    /**
     * Hides popup.
     * If argument not passed, then hides all popups.
     * @param popup - jQuery selector
     */
    $scope.hidePopup = function(popup) {
        var popupObj = $(popup);

        if (arguments.length && popupObj.length) {
            $('body').removeClass('fixed');
            $(popup).removeClass('active');
        } else {
            $('.popup').removeClass('active');
        }
    };
}]);

app.controller('catalogCtrl', ['$scope', 'uniService', function($scope, uniService) {
    $scope.page = 1;
    $scope.pageSize = 24;

    $scope.products = [];

    $scope.init = function() {
        //TODO: move this to YII model
        uniService.getProducts($scope.page, $scope.pageSize).then(function(response) {
            if (response.length) {

                $scope.products = response;
                $scope.page ++;
            }

            $('#loader').removeClass('active');
        });
    };

    $scope.loadProducts = function () {
        uniService.getProducts($scope.page, $scope.pageSize).then(

            function(response) { // success
                console.log('page '+ $scope.page + ' loaded');
                var products = response;

                if (products.length) {
                    $scope.render(products);
                    $scope.page ++;
                }

                $('#loader').removeClass('active');
            },

            function(error) { // error
                console.log(error);
            }
        );
    };

    $scope.render = function(products) {
        if ($scope.products.length) {
            if (products.length) {
                for(var i = 0; i < products.length; i++) {
                    $scope.products.push(products[i]);
                }
            }
        }
    };

    $scope.viewProduct = function(id) {
        $scope.showPopup('#product-view');

        for(var product in $scope.products) {
            if ($scope.products[product].id == id) {
                //catalogService.viewProduct(product);
                return $scope.products[product];
            }
        }
    };
}]);

app.controller('productCtrl', ['$scope', function($scope) {
    $scope.product = {
        name: 'Perrelet P Pierre Lanier',
        price: '4500',
        id: 1,
        img: 'images/catalog/perrelet-a1047-2.jpg',
        desc: 'Manufacturer: Switzerland / Movement: mechanical with automatic winding / Glass: sapphire / Type: Switches / Case : Steel / Water Resistant: 50m / Strap : Rubber / Style: Men',
        related: [
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                img: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                img: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                img: 'images/catalog/perrelet-a1047-2.jpg'
            }
        ],
        ordered: [
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                img: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                img: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                price: '4500',
                id: 4,
                currency: '$',
                img: 'images/catalog/perrelet-a1047-2.jpg'
            }
        ],
        carted: [
            {
                name: 'Perrelet P Pierre Lanier',
                img: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                img: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                img: 'images/catalog/perrelet-a1047-2.jpg'
            }
        ]
    };

    $scope.view = function(productID) {

    }
}]);

app.controller('cartCtrl', ['$scope', function($scope) {
    $scope.cart = {
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
                image: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                price: '4500',
                id: 3,
                count: 4,
                currency: '$',
                image: 'images/catalog/perrelet-a1047-2.jpg'
            }
        ]
    };


    $scope.addItem = function () {

    };

    $scope.deleteItem = function () {

    };

    $scope.refreshCart = function() {

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