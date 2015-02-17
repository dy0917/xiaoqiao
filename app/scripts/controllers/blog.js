'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('BlogCtrl', function($scope, $http, masonryService, facotryblogs, $rootScope) {

            $scope.blogs = [];
            if ($rootScope.blogs == null) {
                facotryblogs.getblogs().then(function(data) {
                    $rootScope.blogs = data;
                    $scope.blogs = $rootScope.blogs;
                    masonryService.masonryinit(500);
                });
            }
            else {
                $scope.blogs = $rootScope.blogs;
                masonryService.masonryinit(500);
            }

            $scope.getimage = function(blog)
            {

                if (typeof blog.FeatureIamge === 'undefined' || blog.FeatureIamge === null)
                {
                    return "defaultmissing.jpg";
                }
                else {
                    return blog.FeatureIamge;
                }

            };

        });



