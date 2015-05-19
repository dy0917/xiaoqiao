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
                        $rootScope.$broadcast("showmessage", {title: "邮件已发送", body: "非常感谢您的咨询，我们的工作人员将在第一时间与您取得联系。谢谢！"}
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
