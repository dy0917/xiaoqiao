'use strict';
/**
 * @ngdoc overview
 * @name xtripApp
 * @description
 * # xtripApp
 *
 * Main module of the application.
 */
app.filter('blogStringFilter', function () {
    return function (items, keyword) {
        var filtered = [];

        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            if (item.title.indexOf(keyword) > -1 || item.body.indexOf(keyword) > -1) {
                filtered.push(item);
            }
        }
        return filtered;
    };
});