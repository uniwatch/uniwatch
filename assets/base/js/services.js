'use strict';

app.factory('uniService', ['$http', '$q', '$rootScope', '$localStorage', function($http, $q, $rootScope, $localStorage) {
    // required only 'url' parameter
    // options: { url: '', method: 'GET', data: '', headers: {}}
    var service;
    var makeRequest = function (options) {
        var defer = $q.defer();

        // Declare request options with defaults
        var requestOptions = {
            //Default method is 'GET'
            method: options.method || 'GET',
            url: options.url,
            headers: options.headers
        };

        if (requestOptions.method === 'GET') {
            requestOptions.params = options.data;
        } else {
            requestOptions.data = options.data;
        }

        $http(requestOptions)
            .success(function (data) {
                defer.resolve(data);
            }).
            error(function (data, status) {
                //TODO: show error popup
                defer.reject(status);
            });

        return defer.promise;
    };

    var product = {};
    var arr = [];
    var checkout = [];

    service = {
        viewProduct: function (id) {
            return makeRequest({
                url: 'product/view',
                method: 'GET',
                data: {
                    id: id
                }
            });
        },

        getProducts: function (page, pageSize) {
            return makeRequest({
                url: 'product/getlist',
                method: 'GET',
                data: {
                    page: page,
                    pageSize: pageSize
                }
            })
        },

        getStoredProduct: function(id, catalog) {
            var result = null;

            for (var i = 0; i < catalog.length; i++) {
                var product = catalog[i];

                if (product.hasOwnProperty('id')) {
                    if (product.id == id) {
                        result = product;
                        break;
                    }
                }
            }
            return result;
        },

        /**
         * Send request to server.
         * @param product_id
         */
        addToCartAjax: function(product_id) {
            return makeRequest({
                url: 'cart/additem',
                method: 'GET',
                data: {
                    id: product_id
                }
            });
        },

        clearCart: function() {
            console.log('clear cart');
        },

        /**
         * Calculate cart totals;
         * @param cart
         * @returns {{count: number, price: number}}
         */
        cartTotals: function(cart) {
            var count = 0,
                price = 0;

            angular.forEach(cart, function(item) {
                var intPrice = parseInt(item.price, 10),
                    intCount = parseInt(item.count, 10);

                count += intCount;
                price += intPrice * intCount;
            });

            return {count: count, price: price};
        },

        getProductData: function () {
            return product;
        },
        
        setProductData: function (value) {
            product = value;
        },

        getCheckoutData: function () {
          return checkout;
        },

        setCheckoutData: function (value) {
            if (value) {
                checkout =  value;
            }
        },

        /**
         * Check if there is same products already added to cart.
         * @param product
         * @param cart
         * @returns {*|null}
         */
        findProductInCart: function(product, cart) {
            var i,
                arr_length = cart.length,
                item;

            for (i = 0; i < arr_length; i++) {
                if (product.hasOwnProperty('id') && cart[i].hasOwnProperty('id')) {
                    if (cart[i].id == product.id) {
                        item = cart[i];
                        break;
                    }
                }
            }

            return item || null
        },

        /**
         * Increase counter of some product in cart.
         * @param product
         * @param cart
         */
        incrCountInCart: function(product, cart) {
            var i,
                arr_length = cart.length;

            for (i = 0; i < arr_length; i++) {
                if (product.hasOwnProperty('id') && cart[i].hasOwnProperty('id')) {
                    if (cart[i].id == product.id) {
                        var cart_item = cart[i];

                        if (cart_item.hasOwnProperty('count')) {
                            cart_item.count ++;
                        } else {
                            cart_item.count = 1;
                        }

                        break;
                    }
                }
            }
        }
    };

    return service;
}]);