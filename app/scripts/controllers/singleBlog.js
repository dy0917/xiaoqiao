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

            console.log($scope.blog);
            if (typeof $scope.blog == 'undefined' || $scope.blog == null)
            {
                $http({
                    url: apiPath + "/blog/" + $routeParams.blogid,
                    method: "get",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function(data, status, headers, config) {
                    console.log(data.blog);
                    $scope.blog = data.blog;
                }).error(function(data, status, headers, config) {

                    console.log("error");
                });
            }
        });
