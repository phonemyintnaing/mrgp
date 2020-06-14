var app =  angular.module('main-App',['ngRoute','angularUtils.directives.dirPagination']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/admin', {
                templateUrl: 'templates/home.html',
                controller: 'AdminController'
            }).
            when('/items', {
                templateUrl: 'templates/items.html',
                controller: 'ItemController'
            }).
            when('/', {
                templateUrl: 'templates/patients.html',
                controller: 'PatientsController'
            }).
            when('/history/:hid', {
                templateUrl: 'templates/history.html',
                 controller: 'HistoriesController'
            }).
            when('/patients', {
                templateUrl: 'templates/patients.html',
                controller: 'PatientsController'
            });
}]);