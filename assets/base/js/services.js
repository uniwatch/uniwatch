'use strict';

app.factory('uniService', ['$http', '$q', '$rootScope', function($http, $q, $rootScope) {
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

    service = {
        viewProduct: function (product) {
            $rootScope.product = product;
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
        }
    };

    return service;
}]);