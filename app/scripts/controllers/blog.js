'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('BlogCtrl', function ($scope, masonryService, facotryblogs, $rootScope, typeservice, $filter, $routeParams, $location,servicecallback) {

            $scope.blogs = [];


            $scope.filterbyKeyword = function (keyword) {

                $scope.blogs = $filter('blogStringFilter')($rootScope.blogs, keyword);
                masonryService.masonryinit(500);
            };

            $scope.filterbyType = function (condition) {

                if (condition.BlogTypeid == 0)
                {
                    $scope.blogs = $rootScope.blogs;

                } else
                {
                    $scope.blogs = $filter("filter")($rootScope.blogs, {BlogTypeid: condition.BlogTypeid});
                }
                $scope.$apply();
                masonryService.masonryinit(500);
            };

            $scope.search = function () {
                var searchString = $routeParams.keyword;

                $rootScope.$broadcast('isloading', true);

                $scope.afterinit(searchString);
            };

            $scope.init = function ()
            {
                //filter type settings
                typeservice.gettype().then(function (result) {
                    $scope.blogtypes = [{BlogTypeid: "0", BlogType: "全部", cssclass: "ng-scope ng-isolate-scope ng-binding"}];
//                  class="ng-scope ng-isolate-scope ng-binding btn-clicked"
                    result.data.forEach(function (element) {

                        if ($location.path().indexOf("filerbytype") > -1 && element.BlogTypeid == $routeParams.keyword) {
                            element.cssclass = "ng-scope ng-isolate-scope ng-binding btn-clicked";
                        }
                        else {
                            element.cssclass = "ng-scope ng-isolate-scope ng-binding";
                        }
                    });
                    $scope.blogtypes = $scope.blogtypes.concat(result.data);

                });
                if ($rootScope.blogs == undefined) {

                    var homepageblog = apiPath + "/blog/getsataticblog";
                    servicecallback.http(homepageblog, "POST", null, function (data) {
                        $rootScope.blogs = data;
                        if ($location.path().indexOf("filerbytype") > -1) {
                            var searchString = $routeParams.keyword;

                            $scope.blogs = $filter("filter")($rootScope.blogs, {BlogTypeid: searchString});

                            masonryService.masonryinit(500);
                        }
                        else {
                            $scope.search();
                        }
                        masonryService.masonryinit(50);
                    });

//                    facotryblogs.getblogs().then(function (result) {
//
//                    });
                }
                else {
                    $scope.search();
                }

            };
            $scope.afterinit = function (searchString) {


                $scope.blogs = $rootScope.blogs;
                if (searchString)
                {
                    $scope.filterbyKeyword(searchString);
                }
                $rootScope.$broadcast('isloading', false);
                masonryService.masonryinit(500);
            };

            $scope.init();


            $scope.getimage = function (blog)
            {
                return facotryblogs.getimage(blog);
            };



        });


angular.module('xiaoqiaoApp')
        .controller('BookCtrl', function ($scope, checkoutservice, $rootScope) {

            $scope.book = {};
//              redirectPost

            $scope.checkout = function ()
            {
                var postData = {Quantity: 1, Reference: 22222, Address1: 242, Address2: 4234234, Address3: "data.orderid", Submit: "Submit"};
//                $.redirectPost("/payment/dps/PxPay_Sample_Curl.php", postData);
//                apiPath + "/payment/dps/PxPay_Sample_Curl.php"
                checkoutservice.redirectPost("POST", apiPath + "/checkout", postData, "_blank");
            }

        });
