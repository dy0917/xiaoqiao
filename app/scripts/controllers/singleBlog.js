'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('singleBlogCtrl', function($scope, $http, $routeParams, facotryblogs) {

            var currentId = $routeParams.blogid;
            $scope.blog = facotryblogs.getobjectbyid(currentId);


            if (typeof $scope.blog == 'undefined' || $scope.blog == null)
            {
                $http({
                    url: apiPath + "/blog/" + $routeParams.blogid,
                    method: "get",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function(data, status, headers, config) {
                    $scope.blog = data.blog;
                    $scope.blog.body = facotryblogs.decodeuri($scope.blog.body);

                }).error(function(data, status, headers, config) {

                    console.log("error");
                });

            } else {
                $scope.blog.body = facotryblogs.decodeuri($scope.blog.body);
            }

        });


angular.module('xiaoqiaoApp')
        .controller('messageCtrl', function($scope) {





        });