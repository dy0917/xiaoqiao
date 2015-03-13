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
                url: apiPath + "test",
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
app.service('servicecallback', function($http, $rootScope) {
    return {
        http: function(url, method, data, successcallback, errorcallback, afterfunction)
        {
            $rootScope.$broadcast('isloading', true);
            $http({
                url: url,
                method: method,
                data: data,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data, status, headers, config) {
                //  $scope.persons = data; // assign  $scope.persons here as promise is resolved here 
                if (successcallback) {
                    successcallback(data);
                }
                $rootScope.$broadcast('isloading', false);
            }).error(function(data, status, headers, config) {
                if (errorcallback) {
                    errorcallback(data);
                }
                $rootScope.$broadcast('isloading', false);
            }).then(function() {
                $rootScope.$broadcast('isloading', false);
                if (afterfunction) {
                    afterfunction();
                }
            });
            ;
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
    factory.decodeuri = function(body) {

        return decodeURI(body);
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
    };
    factory.getBlog = function()
    {
        return $rootScope.blog;
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


app.factory('factorymessages', function($http, $rootScope, shareservice) {

    return {
        getmessagesbyid: function(id) {
            var path = apiPath + "/message/getmessagebyid";
            $http.post(path, {id: id}).success(
                    function(data, status, headers, config)
                    {
                        shareservice.broadcastItem('setMessages', data);
                    }
            ).error();
        }
    };
});

app.factory('checkoutservice', function() {
    return {
        redirectPost: function(post, location, args, target)
        {
            var form = document.createElement("form");
            form.action = location;
            form.method = post;
            form.target = target || "_self";
            if (args) {
                for (var key in args) {
                    var input = document.createElement("textarea");
                    input.name = key;
                    input.value = typeof args[key] === "object" ? JSON.stringify(args[key]) : args[key];
                    form.appendChild(input);
                }
            }
            form.style.display = 'none';
            document.body.appendChild(form);
            form.submit();
        }
    };


});

app.factory('shareservice', function($rootScope) {

    return {
        broadcastItem: function(event, value) {
            $rootScope.$broadcast(event, value);
        }
    };

});

