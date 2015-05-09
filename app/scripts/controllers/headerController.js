'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('headerController', function ($scope, servicecallback, $rootScope, $location, loginService) {
            $scope.user = null;
            $scope.display = false;
            $scope.isloading = false;
            $scope.isSubscribewindow = false;


            $scope.login = function (user) {
                $scope.message = "";
                var hash = CryptoJS.MD5(user.password);
                user.password = hash.toString();
                var path = apiPath + "/site/login";
                servicecallback.http(path, "POST", user, function (data) {
                    if (data.error != "ERROR_USERNAME_INVALID" && data.error != "ERROR_PASSWORD_INVALID")
                    {
                        loginService.setUser(data);
                        $scope.user = loginService.isLoggedIn();
                        $scope.toggleLogin();
                        $location.path("/distributor");
                    }
                    else {
                        $scope.message = "User name or Password not correct";
                    }
                }, function () {
                });
            };

            $scope.toRegisterPage = function () {

                $scope.toggleLogin();
                $location.path("/register");
            };
            $scope.search = function (searchString) {

                $location.path("/blog/search/" + searchString);

            };

            $scope.toggleLogin = function () {

                $scope.display = !$scope.display;
            };
            $scope.logout = function ()
            {
                loginService.setUser(null);
                $scope.user = loginService.isLoggedIn();
                $location.path("/");
            },
            $scope.toggleSubcribewindow = function () {
                        $scope.isSubscribewindow = !$scope.isSubscribewindow;
                    };
            $scope.$on('isloading', function (event, bool) {
                $scope.isloading = bool;
            });
            $scope.$on('routeupdate', function (event, route) {
                $scope.currentroute = route;
            });
            $scope.$on('toggleSubcribewindow', function (event, bool) {
                $scope.isSubscribewindow = bool;
            });
            $scope.$on('emptySearch', function (event) {
                $scope.searchkeyword = "";
            });

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
                            $rootScope.$broadcast("showmessage", {title: "Account register", body: "Please use your register details to login."});

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

angular.module('xiaoqiaoApp')
        .controller('distributorCtrl', function ($scope, loginService, $location) {
            if (!loginService.isLoggedIn())
            {
                $location.path("/");
            }
        });