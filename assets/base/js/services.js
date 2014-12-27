'use strict';

app.factory('catalogService', ['$http', '$rootScope', function($http, $rootScope) {
    return {
        viewProduct: function(product) {
            $rootScope.product = product;
        },
        getProducts: function() {
            $http({
                url: '/product/get-list',
                method: 'GET',
                data: {
                    page: 1,
                    pageSize: 10
                }
            }).success(function(data, status, headers, config) {
                   console.log(data);
                }).
                error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });
        }
    };
}]);

app.service('productStorage', function () {
    var product = {};
    return {
        setProduct: function (product) {
            product = name;
        },
        getProduct: function () {
            return product;
        }
    }
});