'use strict';

/**
 * @ngdoc overview
 * @name xtripApp
 * @description
 * # xtripApp
 *
 * Main module of the application.
 */

var apiPath = "http://local.test.api.xiaoqiaonz.com/";
//var apiPath = "http://test.api.xiaoqiaonz.com";
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
                    .otherwise({
                        redirectTo: '/'
                    });
            //  redactorOptions.buttons = ['formatting', '|', 'bold', 'italic']; 
        });

