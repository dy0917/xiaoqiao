'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('AboutCtrl', function($scope, $http, masonryService) {

//            routeservice.updateroute();
            masonryService.masonryinit(50);

        });
angular.module('xiaoqiaoApp')
        .controller('testCtrl', function($scope, $http, masonryService) {

            $('#summernote').summernote(

                    );

        });
angular.module('xiaoqiaoApp')
        .controller('Subcribewindowcontroller', function($scope, servicecallback) {

            $scope.submit = function(subcribe) {
                var path = apiPath + "/subscribe";
                servicecallback.http(path, "POST", subcribe, function() {

                }, function() {
                });

            },
                    $scope.unsubmit = function(subcribe) {
                        var path = apiPath + "/subscribe/unsubscribe";
                        servicecallback.http(path, "POST", subcribe, function() {

                        }, function() {
                        });

                    };
        });
angular.module('xiaoqiaoApp')
        .controller('registerCtrl', function($scope, servicecallback) {
            $scope.register = function(user)
            {
                var hash = CryptoJS.MD5(user.Password);
                user.Password = hash.toString();
                var hash2 = CryptoJS.MD5(user.password2);
                user.password2 = hash2.toString();
                if ($scope.user.Password == $scope.user.password2) {
                    var path = apiPath + "/user";
                    servicecallback.http(path, "POST", user, function() {
                    }, function() {
                    });
                } else {
                    console.log("password not match");
                }

            };

        });