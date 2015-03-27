/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


'use strict';
app.directive('aside', function () {
    return{
        templateUrl: 'views/partials/aside.html'
    };
});

app.directive('loginandregisterdirective', function () {
    return{
        templateUrl: 'views/partials/loginAndRegisterLightbox.html'
    };
});

app.directive('messagedirective', function () {
    return{
        templateUrl: 'views/partials/messageboard.html'
    };
});

app.directive('subscribewindow', function () {
    return{
        templateUrl: 'views/partials/subscribewindow.html'
    };
});

app.directive('feedbackboard', function () {
    return{
        templateUrl: 'views/partials/feedbackboard.html'
    };
});

app.directive('clickAndDisable', function ($timeout) {
    return {
        scope: {
            clickAndDisable: '&'
        },
        link: function (scope, iElement, iAttrs) {
            iElement.bind('click', function () {
                console.log(iElement);
                iElement[0].className += " btn-disable";
                iElement.prop('disabled', true);

                scope.clickAndDisable().finally(function () {
                    $timeout(function () {
                        iElement[0].className =
                                iElement[0].className.replace
                                (/(?:^|\s)btn-disable(?!\S)/g, '');
                        iElement.prop('disabled', false);
                    }, 5000);

                });
            });
        }
    };
});