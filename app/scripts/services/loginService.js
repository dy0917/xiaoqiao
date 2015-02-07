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
app.service('servicecallback', function($http) {
    return {
        http: function(url, method, data, successcallback, errorcallback)
        {
            $http({
                url: url,
                method: method,
                data: data,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data, status, headers, config) {
                //  $scope.persons = data; // assign  $scope.persons here as promise is resolved here 
                successcallback(data);
            }).error(function(data, status, headers, config) {
                // $scope.status = status;
                errorcallback(data);
            });
        },
        test: function()
        {
            console.log("test");
        }
    };
});

app.factory('facotryblogs', function($http, $rootScope) {

    var factory = [];
    var blogs;
    factory.getblogs = function() {
        return $http.get(apiPath + "/blog/").then(function(result) {

            var blogs = result.data;
            
            return  blogs;
        });
    };
    factory.method1 = function() {
        console.log(blogs);
    };
    factory.method2 = function() {
        console.log("method2");
    };
    factory.getobjectbyid = function(id) {

       
        if ($rootScope.blogs)
        {
            var blogs = $rootScope.blogs;
            for (var i = 0; i < blogs.length; i++)
            {
                var object = blogs[i];
                if (object.Blogid == id)
                {
                    return object;
                    break;
                }

            }
        } else {
            return null;
        }
//        return null;
    };
    return factory;
});
app.factory('blogservice', function() {

    var blog = {};
    return {
        init: function(blogObj)
        {
            blog = blogObj;
        },
        getBlog: function()
        {
            return blog;
        },
        settitle: function(title) {
            blog.title = title;
        },
        getTitle: function() {
            return  blog.title;
        }

    };
});