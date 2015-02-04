'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('singleBlogCtrl', function($scope, $http, $routeParams) {

//            var currentId = $routeParams.blogid;
//            console.log($routeParams);
//            console.log(currentId);

            $http({
                url: apiPath + "/blog/" + $routeParams.blogid,
                method: "get",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data, status, headers, config) {

                console.log(data);
            }).error(function(data, status, headers, config) {

                console.log("error");
            });
        });
