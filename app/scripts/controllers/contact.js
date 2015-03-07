'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('ContactCtrl', function($scope, $http, servicecallback) {

            $scope.sendmail = function(mail) {
                var path = apiPath + "/email/send";
                servicecallback.http(path, "POST", mail, '', '', '');
            };
        });
