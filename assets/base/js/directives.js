/*global $:false, jQuery:false */

'use strict';

app.directive('initPage', function() {
    return {
        restrict: 'A',
        link: function($scope) {

            //this function used for improve scroll performance;
            function disableHoverOnScroll () {
                var body = $('body'),
                    timer;

                $(window).on('scroll', function () {
                    clearTimeout(timer);

                    if(!body.hasClass('disable-hover')) {
                        body.addClass('disable-hover');
                    }

                    timer = setTimeout(function(){
                        body.removeClass('disable-hover');
                    },500);
                });
            }

            // prevent chrome from scroll to previous position
            function scrollToTop () {
                setTimeout(function() {
                    // target, duration, options
                    TweenLite.to(window, 1, {scrollTo:{y:0}});
                }, 400);
            }

            // add some scroll magic (http://janpaepke.github.io/ScrollMagic/)
            function initScrollPlugin() {
                var controller = new ScrollMagic();

                //scene for menu pin
                var pin_scene = new ScrollScene({
                    triggerElement: '#catalog-page',
                    triggerHook: 0
                }).setPin('#main-menu');

                //scene for menu change style
                var menu_scene = new ScrollScene({
                    triggerElement: '#main-menu',
                    triggerHook: 0,
                    offset: 200,
                    duration: 300
                }).on('progress', menuUpdate);

                controller.addScene([pin_scene, menu_scene]);
            }

            function menuUpdate(event) {
                var progress = event.progress.toFixed(3);

                var bigLogoH = 210,
                    smallLogoH = 80;

                var distance = bigLogoH - smallLogoH,
                    logo = $('#menu-logo');

                var newH = bigLogoH - distance * progress;
                logo.height(newH);
            }

            function enableSmoothScroll() {
                var platform = navigator.platform.toLowerCase();
                if (platform.indexOf('win') == 0 || platform.indexOf('linux') == 0) {
                    $.srSmoothscroll();
                }
            }

            $(function() {
                //TODO: add site preloader
                scrollToTop();
                disableHoverOnScroll();
                initScrollPlugin();

                //TODO: add cross-browser smooth scrolling
                //enableSmoothScroll();
            });
        }
    }
});

// change some predefined variables on window resize
app.directive('windowResize', function() {
    return {
        restrict: 'A',
        link: function(scope) {
            var timer = 200,
                timeout;

            $(window).on('resize', function() {
                if (timeout) {
                    clearTimeout(timeout);
                }

                timeout = setTimeout(function() {
                    scope.$apply(function() {
                        scope.windowHeight = $(window).height();
                    });
                }, timer);
            });
        }
    }
});

app.directive('loadProducts', function() {
    return {
        restrict: 'A',
        link: function($scope) {

            var controller = new ScrollMagic();

            var load_scene = new ScrollScene({
                triggerElement : "#load-trigger",
                triggerHook    : 1,
                duration: 100,
                offset: -100
            }).on('start', loadProducts);


            controller.addScene(load_scene);

            // adds special indicators thar show scroll scene start/stop
            //load_scene.addIndicators({zindex: 100});

            // update scroll scene after variable change
            $scope.$watch('products', function() {
                load_scene.update();
            });

            function loadProducts(event) {
                if (event.scrollDirection == "FORWARD") {
                    $('#loader').addClass('active');
                    $scope.loadProducts();
                }
            }
        }
    }
});

app.directive('checkoutProduct', function() {
    return {
        restrict: 'A',
        scope: true,
        link: function(scope, element, attrs) {

        }
    }
});
