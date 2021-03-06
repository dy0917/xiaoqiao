'use strict';
/**
 * @ngdoc function
 * @name xtripApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('MainCtrl', function ($scope, masonryService, servicecallback, facotryblogs) {

            masonryService.masonryinit(50);
            $scope.init = function () {
                var path = apiPath + "/blog/gethomepageblog";
                var homepageblog = apiPath + "/blog/getsataticblog";
                servicecallback.http(homepageblog, "POST", {BlogTypeid: 4}, function (data) {
                    $scope.blogs = data;
                    masonryService.masonryinit(50);
                });

            };

            $scope.getsliders = function () {
                var path = apiPath + "/slider/";
                servicecallback.http(path, "GET", null, function (data) {
                    $scope.sliders = data;
                    $scope.sliders.forEach(function (slider)
                    {
                        var img = document.createElement("img");
                        img.setAttribute("src", slider.imagelUrl);
                        img.setAttribute("title", slider.title);
                        var a = document.createElement('a');
                        if(slider.linkto){
                        a.setAttribute('href', slider.linkto);
                    }
                        a.appendChild(img);
                        var li = document.createElement("li");
                        li.appendChild(a);
                        $('#mainslider').append(li);
                    });
                    $('#banner-fade').bjqs({
                        height: 450,
                        width: 1600,
                        responsive: true
                    });
                    masonryService.masonryinit(50);
                }, function () {
                });
            };

            if (!$scope.sliders) {
                $scope.getsliders();
            }


            $scope.getimage = function (blog)
            {

                return  facotryblogs.getimage(blog);
            };


            $scope.getblogcss = function (blog)
            {

            };

            $scope.init();
            $scope.displayLogin = function () {
                //	loginService.login(data,$scope); //call login service
            };
            $scope.login = function (user) {
                console.log("login");
                //	loginService.login(data,$scope); //call login service
            };
            $scope.$on("myEvent", function (event, args) {


            });
        });
angular.module('xiaoqiaoApp')
        .controller('feedbackCtrl', function ($scope, $timeout) {
            $scope.isshow = false;
            $scope.switch = function (b)
            {
                $scope.isshow = b;
            },
                    $scope.$on("showmessage", function (event, data) {

                        $scope.isshow = true;
                        $scope.message = data;
                        $timeout(function () {
                            $scope.isshow = false;
                            $scope.message = {};
                        }, 5000);
                    });
        });