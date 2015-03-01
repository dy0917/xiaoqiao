'use strict';

/**
 * @ngdoc overview
 * @name xtripApp
 * @description
 * # xtripApp
 *
 * Main module of the application.
 */

//var apiPath = "http://local.test.api.xiaoqiaonz.com";
var apiPath = "http://test.api.xiaoqiaonz.com/index.php";
var app = angular
        .module('xiaoqiaoApp', [
            'ngAnimate',
            'ngCookies',
            'ngResource',
            'ngRoute',
            'ngSanitize',
            'ngTouch',
                    //  'angular-redactor'
        ])
        .config(function($routeProvider) {

            $routeProvider
                    .when('/', {
                        templateUrl: 'views/main.html',
                        controller: 'MainCtrl'
                    })
                    .when('/about', {
                        templateUrl: 'views/about.html',
                        controller: 'AboutCtrl'
                    })
                    .when('/blog', {
                        templateUrl: 'views/blog.html',
                        controller: 'BlogCtrl'
                    })
                    .when('/contact', {
                        templateUrl: 'views/contact.html',
                        controller: 'ContactCtrl'
                    })
                    .when('/product', {
                        templateUrl: 'views/product.html',
                        controller: 'ProductCtrl'
                    })
                    .when('/aboutJo', {
                        templateUrl: 'views/aboutJo.html',
//                        controller: 'ProductCtrl'
                    })
                    .when('/book', {
                        templateUrl: 'views/book.html',
                        controller: 'BookCtrl'
                    })
                    .when('/blog/:blogid', {
                        templateUrl: 'views/singleblog.html',
                        controller: 'singleBlogCtrl'
                    })
                    .when('/test', {
                        templateUrl: 'views/test.html',
                        controller: 'testCtrl'
                    }).when('/housedairy', {
                templateUrl: 'views/housedairy.html',
//                controller: 'testCtrl'
            }).when('/tipsblog', {
                templateUrl: 'views/tipsblog.html',
//                controller: 'testCtrl'
            }).when('/investmentexample', {
                templateUrl: 'views/investmentexample.html',
//                controller: 'testCtrl'
            })
                    .when('/companyintroduction', {
                        templateUrl: 'views/companyintroduction.html',
//                controller: 'testCtrl'
                    }).when('/distributor', {
                templateUrl: 'views/distributor.html',
//                controller: 'testCtrl'
            })

                    .otherwise({
                        redirectTo: '/'
                    });
            //  redactorOptions.buttons = ['formatting', '|', 'bold', 'italic']; 
        });

