/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


'use strict';
app.directive('aside', function() {
    return{
        templateUrl: 'views/partials/aside.html'
    };
});

app.directive('loginandregisterdirective', function() {
    return{
        templateUrl: 'views/partials/loginAndRegisterLightbox.html'
    };
});

app.directive('messagedirective', function() {
    return{
        templateUrl: 'views/partials/messageboard.html'
    };
});

app.directive('subscribewindow', function() {
    return{
        templateUrl: 'views/partials/subscribewindow.html'
    };
});