/*global $:false, jQuery:false */

'use strict';

function showPopup(popup) {
    $('body').addClass('fixed');
    $(popup).show();
}

app.directive('initPage', function() {
    return {
        restrict: 'A',
        link: function() {

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
                    TweenLite.to(window, 0, {
                        scrollTo : { y:0 },
                        ease     : Power2.ease
                    });
                }, 200);
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

            $(function() {
                scrollToTop();
                disableHoverOnScroll();
                initScrollPlugin();
            });
        }
    }
});

// change some predefined variables on window resize
app.directive('windowResize', function() {
    return {
        restrict: 'A',
        link: function(scope) {
            var height;
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
        link: function(scope) {

            var controller = new ScrollMagic();

            var load_scene = new ScrollScene({
                triggerElement : "#catalog-page",
                triggerHook    : 1,
                offset: -100
            }).on('start', loadProducts);

            controller.addScene(load_scene);

            function loadProducts() {
                $('#loader').addClass('active');
                scope.loadProducts();
            }
        }
    }
});

app.directive('viewProduct', function() {
    return {
        restrict: 'A',
        scope: true,
        link: function(scope, element, attrs) {

            function view(prod_id) {
                var data = scope.viewProduct(prod_id);
                showPopup('#product-view');
            }

            element.on('click', function() {
                view(attrs.viewProduct);
            });
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

//app.directive('cartProduct', function() {
//    return {
//        restri
//    }
//});