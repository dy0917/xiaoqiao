'use strict';
/**
 * @ngdoc overview
 * @name xtripApp
 * @description
 * # xtripApp
 *
 * Main module of the application.
 */
app.factory('loginService', function ($http) {
    var loginuser;
    return {
        setUser: function (aUser) {
            loginuser = aUser;
        },
        isLoggedIn: function () {
            return(loginuser) ? loginuser : null;
        }
    };
});
app.factory('masonryService', function () {
    return {
        masonryinit: function (milliseconds)
        {
            setTimeout(function () {
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
app.service('servicecallback', function ($http, $rootScope) {

    function private_error() {
        alert("contactkingsley");
    }
    ;
    return {
        http: function (url, method, data, successcallback, errorcallback, afterfunction)
        {
            $rootScope.$broadcast('isloading', true);
            return  $http({
                url: url,
                method: method,
                data: data,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data, status, headers, config) {
                //  $scope.persons = data; // assign  $scope.persons here as promise is resolved here 
                if (successcallback) {
                    successcallback(data);
                }
                $rootScope.$broadcast('isloading', false);
            }).error(function (data, status, headers, config) {
                private_error();
                if (errorcallback) {
                    errorcallback(data);
                }
                $rootScope.$broadcast('isloading', false);
            }).then(function (data, status, headers, config) {
                $rootScope.$broadcast('isloading', false);
                if (afterfunction) {
                    afterfunction(data);
                }
            });
        }, getmethod: function (url)
        {

            return $http.get(url).error(function () {
                private_error();
            }).then(function (result) {

                var blogs = result;
                return  blogs;
            });
        }
    };
});
app.factory('facotryblogs', function ($http, $rootScope, servicecallback) {

    var factory = [];
    var blogs;
    factory.getblogs = function () {

        return  servicecallback.getmethod(apiPath + "/blog/");
    };
    factory.getobjectbyid = function (id) {
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
    factory.getBlog = function ()
    {
        return $rootScope.blog;
    };
    return factory;
});
app.factory('blogservice', function () {

    var blog = {};
    return {
        init: function (blogObj)
        {
            blog = blogObj;
        },
        getBlog: function ()
        {
            return blog;
        },
        settitle: function (title) {
            blog.title = title;
        },
        getTitle: function () {
            return  blog.title;
        }

    };
});
app.factory('factorymessages', function ($http, $rootScope, shareservice) {

    return {
        getmessagesbyid: function (id) {
            var path = apiPath + "/message/getmessagebyid";
            $http.post(path, {id: id}).success(
                    function (data, status, headers, config)
                    {
                        shareservice.broadcastItem('setMessages', data);
                    }
            ).error();
        }
    };
});
app.factory('checkoutservice', function () {
    return {
        redirectPost: function (post, location, args, target)
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
app.factory('shareservice', function ($rootScope) {

    return {
        broadcastItem: function (event, value) {
            $rootScope.$broadcast(event, value);
        }
    };
});
app.factory('encodeservice', function () {

    var obj = {};
    var i = 0;
    return {
        htmlEncode: function (html)
        {
            return document.createElement('a').appendChild(
                    document.createTextNode(html)).parentNode.innerHTML;
        },
        htmlDecode: function (html)
        {
            var find = '&amp;';
            var re = new RegExp(find, 'g');
            var str = html.replace(re, '&');

            var find = '&lt;';
            var re = new RegExp(find, 'g');
            var str = str.replace(re, '<');
            find = '&gt;';
            var re = new RegExp(find, 'g');
            str = str.replace(re, '>');

            return str;
        }
    };
});
app.factory("typeservice", function ($http, servicecallback) {
    return {
        gettype: function ()
        {
            var getstatusMethod = servicecallback.getmethod(apiPath + "/blogtype/");
            return getstatusMethod;
        }
    };
});

app.factory("formcheckservice", function () {
    return {
        isemail: function (email)
        {
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
        },
        isfilled: function (input)
        {
            var b = true;
            if (typeof input === 'undefined') {
                b = false;
            }
            return b;
        },
        isNumeric: function (n)
        {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }

    };
});


