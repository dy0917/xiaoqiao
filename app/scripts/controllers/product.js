'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
  .controller('ProductCtrl', function ($scope,$http,masonryService) {
   
   masonryService.masonryinit(50);
  console.log("products");
  });
