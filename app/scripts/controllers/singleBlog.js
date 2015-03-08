'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('singleBlogCtrl', function($scope, $http, $routeParams, facotryblogs, $rootScope, factorymessages) {

            var currentId = $routeParams.blogid;
            $rootScope.blog = facotryblogs.getobjectbyid(currentId);

            if (typeof $scope.blog == 'undefined' || $scope.blog == null)
            {
                $http({
                    url: apiPath + "/blog/" + $routeParams.blogid,
                    method: "get",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function(data, status, headers, config) {
                    $rootScope.blog = data.blog;
                    $rootScope.blog.body = facotryblogs.decodeuri($rootScope.blog.body);
                    factorymessages.getmessagesbyid($rootScope.blog.Blogid);
                }).error(function(data, status, headers, config) {

                    console.log("error");
                });

            } else {
                console.log("v");
                $rootScope.blog.body = facotryblogs.decodeuri($rootScope.blog.body);
                factorymessages.getmessagesbyid($rootScope.blog.Blogid);
            }

        });


angular.module('xiaoqiaoApp')
        .controller('messageCtrl', function($scope, $rootScope, servicecallback, $http) {

            var path = apiPath + "/message/getmessagebyid";

            $scope.sendmessage = function(message)
            {
                $scope.message.Blogid = $rootScope.blog.Blogid;

                var path = apiPath + "/message";
                servicecallback.http(path, "POST", $scope.message, function() {

                }, function() {
                });
            };

//            $scope.$on('getmessages', function(event, id) {
//                console.log("aaaaaaaaaaaaaaa");
//                $http.post(path, {id: id}).success(
//                        function(data, status, headers, config)
//                        {
//                            $scope.messages = data;
//                        }
//                ).error();
//            });
        });