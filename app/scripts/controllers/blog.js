'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('BlogCtrl', function($scope, $http,masonryService) {
            $scope.blogs = [
                {blogid: 1, imgurl: 'images/1.jpg', title: "About Joanne", createTime: "5 Jan 2015", tample: "", views: ">3.6k"},
                {blogid: 2, imgurl: 'images/4.jpeg', title: "About Joanne", createTime: "5 Jan 2015", tample: "2", views: ">3.6k"},
                {blogid: 3, imgurl: 'images/3.jpeg', title: "About Joanne", createTime: "5 Jan 2015", tample: "2", views: ">3.6k"},
                {blogid: 4, imgurl: 'images/2.jpeg', title: "About Joanne", createTime: "5 Jan 2015", tample: "2", views: ">3.6k"},
                {blogid: 5, imgurl: 'images/5.jpeg', title: "About Joanne", createTime: "5 Jan 2015", tample: "2", views: ">3.6k"},
            ];


           masonryService. masonryinit(50);

        });



