'use strict';
/*global $:false, jQuery:false */

var app = angular.module('app', []);
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
}]);

app.controller('catalogCtrl', ['$scope', '$filter', 'catalogService', function($scope, catalogService, $filter) {
    $scope.products = [
        {
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 1,
            currency: '$',
            image: 'images/catalog/perrelet-a1047-2.jpg'
        },{
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 2,
            currency: '$',
            image: 'images/catalog/casio-ga-100-1a4er.jpg'
        },{
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 3,
            currency: '$',
            image: 'images/catalog/edox-01113-357rn-nir.jpg'
        },{
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 4,
            currency: '$',
            image: 'images/catalog/perrelet-a1047-2.jpg'
        },{
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 5,
            currency: '$',
            image: 'images/catalog/perrelet-a1047-2.jpg'
        },{
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 6,
            currency: '$',
            image: 'images/catalog/perrelet-a1047-2.jpg'
        },{
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 7,
            currency: '$',
            image: 'images/catalog/perrelet-a1047-2.jpg'
        },{
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 8,
            currency: '$',
            image: 'images/catalog/perrelet-a1047-2.jpg'
        },{
            name: 'Perrelet P Pierre Lanier',
            price: '4500',
            id: 9,
            currency: '$',
            image: 'images/catalog/perrelet-a1047-2.jpg'
        }
    ];

    $scope.getProducts = function (offset, count) {
        catalogService.list().then(function(response) {
            $scope.products = response;
        });
    };

    $scope.viewProduct = function(id) {
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
                image: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                image: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                image: 'images/catalog/perrelet-a1047-2.jpg'
            }
        ],
        ordered: [
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                image: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                image: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                price: '4500',
                id: 4,
                currency: '$',
                image: 'images/catalog/perrelet-a1047-2.jpg'
            }
        ],
        carted: [
            {
                name: 'Perrelet P Pierre Lanier',
                image: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                image: 'images/catalog/perrelet-a1047-2.jpg'
            },
            {
                name: 'Perrelet P Pierre Lanier',
                id: 4,
                image: 'images/catalog/perrelet-a1047-2.jpg'
            }
        ]
    };
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
                image: 'images/catalog/perrelet-a1047-2.jpg'
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
                image: 'images/catalog/perrelet-a1047-2.jpg'
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

    $scope.proceedCheckout = function () {

    };

    $scope.cancelCheckout = function () {

    };
}]);