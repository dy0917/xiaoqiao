'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('singleBlogCtrl', function ($scope, $http, $routeParams, facotryblogs, $rootScope, factorymessages, encodeservice) {

            var currentId = $routeParams.blogid;
            $rootScope.blog = facotryblogs.getobjectbyid(currentId);

            if (typeof $scope.blog == 'undefined' || $scope.blog == null)
            {
                $http({
                    url: apiPath + "/blog/" + $routeParams.blogid,
                    method: "get",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data, status, headers, config) {
                    $rootScope.blog = data.blog;
                    $rootScope.blog.body = encodeservice.htmlDecode($rootScope.blog.body);
                    factorymessages.getmessagesbyid($rootScope.blog.Blogid);
                }).error(function (data, status, headers, config) {


                });

            } else {
                $rootScope.blog.body = encodeservice.htmlDecode($rootScope.blog.body);
                factorymessages.getmessagesbyid($rootScope.blog.Blogid);
            }

        });


angular.module('xiaoqiaoApp')
        .controller('messageCtrl', function ($scope, $rootScope, servicecallback, $http) {
            var path = apiPath + "/message/getmessagebyid";
            $scope.sendmessage = function (event, message)
            {

                var buttonString = "wait";

                $scope.$emit("isloading", true);
                $scope.message.Blogid = $rootScope.blog.Blogid;
                var path = apiPath + "/message";
                servicecallback.http(path, "POST", $scope.message, function (data) {
                    $scope.messages.push(data);
                    $scope.message.owner = "";
                    $scope.message.body = "";
                    $scope.$emit("isloading", false);
                    var i = 5;
                    var t = setInterval(function () {
                        if (i != 0)
                        {
                            i--;
                            event.target.value = buttonString + " " + i;
                        }
                        else {
                            clearInterval();
                        }
                    }, 1000);
                }, function () {
                });
            };
            $scope.$on('setMessages', function (event, data) {
                $scope.messages = data;
            });

        });