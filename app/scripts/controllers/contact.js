'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('ContactCtrl', function ($scope, $http, servicecallback, $rootScope) {

            $scope.sendmail = function (mail) {
                console.log($scope.emailform.$invalid);
                if (!$scope.emailform.$invalid) {
                    var path = apiPath + "/email/send";

                    return $http.post(path, mail).success(function () {
                        $rootScope.$broadcast("showmessage", {title: "message", body: "asdfasdfa"}
                        );

                    });
                }
            };
        });
