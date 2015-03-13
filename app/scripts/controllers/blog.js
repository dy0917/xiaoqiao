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
//            routeservice.updateroute();
            $scope.blogs = [];
            $scope.blogtypes = [{value: "test", name: "test"}, {value: "test1", name: "test1"}, {value: "test2", name: "test2"}];
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
            $scope.test = function()
            {
                console.log("test");
            };
        });


angular.module('xiaoqiaoApp')
        .controller('BookCtrl', function($scope, checkoutservice, $rootScope) {

            $scope.book = {};
//              redirectPost

            $scope.checkout = function()
            {
                var postData = {Quantity: 1, Reference: 22222, Address1: 242, Address2: 4234234, Address3: "data.orderid", Submit: "Submit"};
//                $.redirectPost("/payment/dps/PxPay_Sample_Curl.php", postData);
//                apiPath + "/payment/dps/PxPay_Sample_Curl.php"
                checkoutservice.redirectPost("POST", apiPath + "/checkout", postData, "_blank");
            }

        });
