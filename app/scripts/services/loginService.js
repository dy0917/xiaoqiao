'use strict';

/**
 * @ngdoc overview
 * @name xtripApp
 * @description
 * # xtripApp
 *
 * Main module of the application.
 */
app.factory('loginService', function($http) {
    return {
        login: function()
        {
            $http({
                url: apiPath + "/test",
                method: "POST",
                data: "asdfasdfa",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data, status, headers, config) {
                //  $scope.persons = data; // assign  $scope.persons here as promise is resolved here 
                console.log("ok");
            }).error(function(data, status, headers, config) {
                // $scope.status = status;
                console.log("error");
            });

        },
    };

});

app.factory('masonryService', function() {
    return {
        masonryinit: function(milliseconds)
        {
            setTimeout(function() {
                var container = document.querySelector('#container');
                var msnry = new Masonry(container, {
                    // options
                    columnWidth: 4,
                    itemSelector: '.item'
                });
            }, milliseconds);

        },
    };

});