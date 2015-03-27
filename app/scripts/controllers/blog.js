'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('BlogCtrl', function ($scope, masonryService, facotryblogs, $rootScope, typeservice, $filter) {

            $scope.blogs = [];



            $scope.init = function ()
            {

                typeservice.gettype().then(function (result) {
                    $scope.blogtypes = [{BlogTypeid: "0", BlogType: "全部"}];
                    $scope.blogtypes = $scope.blogtypes.concat(result.data);

                });

                $rootScope.$broadcast('isloading', true);
                if ($rootScope.blogs == undefined) {
                    facotryblogs.getblogs().then(function (result) {

                        $rootScope.blogs = result.data;
                        $scope.blogs = $rootScope.blogs;
                        $rootScope.$broadcast('isloading', false);
                        masonryService.masonryinit(500);

                    });
                } else {
                    $scope.blogs = $rootScope.blogs;
                    $rootScope.$broadcast('isloading', false);
                    masonryService.masonryinit(500);
                }


            };
            $scope.init();


            $scope.getimage = function (blog)
            {
                if (typeof blog.FeatureIamge === 'undefined' || blog.FeatureIamge === null)
                {
                    return "defaultmissing.jpg";
                }
                else {
                    return blog.FeatureIamge;
                }
            };

            $scope.filterbyType = function (condition) {

                if (condition.BlogTypeid == 0)
                {
                    console.log(condition);
                    $scope.blogs = $rootScope.blogs;

                } else
                {
                    $scope.blogs = $filter("filter")($rootScope.blogs, {BlogTypeid: condition.BlogTypeid});
                }
                masonryService.masonryinit(500);
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
