'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('AboutCtrl', function ($scope, $http, masonryService) {

//            routeservice.updateroute();
            masonryService.masonryinit(50);

        });
angular.module('xiaoqiaoApp')
        .controller('testCtrl', function ($scope, $http, masonryService) {

            $('#summernote').summernote();

        });
angular.module('xiaoqiaoApp')
        .controller('Subcribewindowcontroller', function ($scope, $http, $rootScope, $location) {
            $scope.isSubscribewindow = false;

            $scope.submit = function (subcribe) {
                $rootScope.$broadcast('isloading', true);
                var path = apiPath + "/subscribe";
                return $http.post(path, subcribe).success(function (data) {

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
                    $scope.unsubmit = function (subcribe) {
                        $rootScope.$broadcast('isloading', true);
                        var path = apiPath + "/subscribe/unsubscribe";
                        return $http.post(path, subcribe).success(function (data) {
                            $rootScope.$broadcast('isloading', false);
                            if (data == "Email_Not_Found")
                            {
                                $rootScope.$broadcast("showmessage", {title: "message", body: "Email Not Found"}
                                );
                            }
                            else {
                                $rootScope.$broadcast("showmessage", {title: "message", body: "thank you for unsubcribe us"}
                                );
                                $location.path("/");
                            }

                        });

                    };
        });
angular.module('xiaoqiaoApp')
        .controller('registerCtrl', function ($scope, $rootScope, servicecallback, formcheckservice) {
            $scope.register = function (user)
            {
                var hash = CryptoJS.MD5(user.Password);

                user.Password = hash.toString();
                var hash2 = CryptoJS.MD5(user.password2);
                user.password2 = hash2.toString();
                if (user.Password == user.password2) {
                    var path = apiPath + "/user";
                    servicecallback.http(path, "POST", user, function (data) {
                        if (data == "registered")
                        {
                            $rootScope.$broadcast("showmessage", {title: "adfadfasdf", body: "asdfasdfasdf"});

                        }
                        else if (data == "email_already_registered")
                        {
                            $rootScope.$broadcast("showmessage", {title: "Email Already register", body: "asdfasdfasdf"});
                        }
                    }, function (data) {

                    });
                } else {

                }

            };

            $scope.isFormCorrect = function (user) {

                var b = false;

                if (user && formcheckservice.isfilled(user.Password) && formcheckservice.isfilled(user.password2)
                        && formcheckservice.isemail(user.email))
                {

                    b = true;
                }

                return b;
            };

        });