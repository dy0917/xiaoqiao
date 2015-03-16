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
        .controller('Subcribewindowcontroller', function($scope, $http, $rootScope, $location) {
            $scope.isSubscribewindow = false;
            $scope.submit = function(subcribe) {
                $rootScope.$broadcast('isloading', true);
                var path = apiPath + "/subscribe";
                return $http.post(path, subcribe).success(function(data) {

                    $rootScope.$broadcast('isloading', false);
                    $rootScope.$broadcast("toggleSubcribewindow", false);
                    if (data == "register") {
                        $rootScope.$broadcast("showmessage", {title: "message", body: "Thank you for subcribe us"}
                        );

                    } else {
                        $rootScope.$broadcast("showmessage", {title: "message", body: "You have already register with us, and we have enable your registeration."}
                        );
                    }
                });
            },
                    $scope.unsubmit = function(subcribe) {
                        $rootScope.$broadcast('isloading', true);
                        var path = apiPath + "/subscribe/unsubscribe";
                        return $http.post(path, subcribe).success(function() {
                            $rootScope.$broadcast('isloading', false);
                            $rootScope.$broadcast("showmessage", {title: "message", body: "thank you for unsubcribe us"}
                            );
                            $location.path("/");
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