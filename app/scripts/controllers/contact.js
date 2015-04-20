'use strict';

/**
 * @ngdoc function
 * @name xtripApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the xtripApp
 */
angular.module('xiaoqiaoApp')
        .controller('ContactCtrl', function ($scope, $http, servicecallback, $rootScope, formcheckservice) {

            $scope.sendmail = function (mail) {

                if (!$scope.emailform.$invalid) {
                    var path = apiPath + "/email/send";
                    return $http.post(path, mail).success(function () {
                        $scope.mail = {};
                        $rootScope.$broadcast("showmessage", {title: "message", body: "asdfasdfa"}
                        );

                    });
                }
            };
            $scope.isFormCorrect = function (mail)
            {

                var b = false;

                if (mail && formcheckservice.isfilled(mail.content) && formcheckservice.isfilled(mail.title) && formcheckservice.isemail(mail.email))
                {

                    b = true;
                }

                return b;
            };
        });
