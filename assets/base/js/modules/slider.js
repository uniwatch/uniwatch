'use strict';
/*global $:false, jQuery:false */

slider.directive('slider', [function() {
    return {
        restrict: 'E',
        templateUrl: 'partials/slider.html',
        scope: {
            itemsWidth : '=',
            items      : '='
        },
        link: function($scope, element) {
            $scope.sliderInner = element.find('.slider-inner');

            $scope.$watch('items', function(newval, oldval) {
                if (newval && newval.length) {

                    if ($scope.itemsWidth && $scope.items) {
                        $scope.sliderWidth = $scope.items.length * $scope.itemsWidth;

                        $scope.sliderInner.css('width', $scope.sliderWidth);

                        if ($scope.items.length > 4) {
                            $scope.right = true;
                        }
                    }
                }
            }, true);
        },
        controller: function($scope, $element) {
            $scope.wrapWidth = 672;
            $scope.offset = 0;
            $scope.sliderInner = [];

            $scope.left = false;
            $scope.right = false;


            $scope.nextSlide = function() {
                var itemsCount = $scope.items.length;

                if (itemsCount > 4) {
                    var newOffset = $scope.offset + $scope.wrapWidth;

                    if (newOffset < $scope.sliderWidth) {
                        $scope.offset = newOffset;

                        $scope.sliderInner.transition({x: -newOffset}, 500);

                        // hide the right button
                        if (newOffset + $scope.wrapWidth > $scope.sliderWidth) {
                            $scope.right = false;

                        } else {
                            $scope.left = $scope.right = true;
                        }
                    } else {
                        return false;
                    }
                }
            };

            $scope.prevSlide = function () {
                var itemsCount = $scope.items.length;

                if (itemsCount > 4) {
                    var newOffset = $scope.offset - $scope.wrapWidth;

                    if (newOffset >= 0) {
                        $scope.offset = newOffset;

                        $scope.sliderInner.transition({x: -newOffset}, 500);

                        // hide the left button
                        if (newOffset - $scope.wrapWidth < 0) {
                            $scope.left = false;
                        } else {
                            $scope.left = $scope.right = true;
                        }
                    } else {
                        return false;
                    }
                }
            }
        }
    }
}]);