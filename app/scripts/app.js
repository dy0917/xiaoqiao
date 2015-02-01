'use strict';

/**
 * @ngdoc overview
 * @name xtripApp
 * @description
 * # xtripApp
 *
 * Main module of the application.
 */
 var apiPath="http://api.editor";
 var app=angular
 .module('xiaoqiaoApp', [
  'ngAnimate',
  'ngCookies',
  'ngResource',
  'ngRoute',
  'ngSanitize',
  'ngTouch',
  //  'angular-redactor'
  ])
 .config(function ($routeProvider) {
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
  .when('/product', {
    templateUrl: 'views/product.html',
    controller: 'ProductCtrl'
  })
  .when('/contact', {
    templateUrl: 'views/contact.html',
    controller: 'ContactCtrl'
  })
  .otherwise({
    redirectTo: '/'
  });
     //  redactorOptions.buttons = ['formatting', '|', 'bold', 'italic']; 
   });

