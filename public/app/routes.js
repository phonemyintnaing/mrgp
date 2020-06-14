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
            }).
            when('/patients_my', {
                templateUrl: 'templates/patients_my.html',
                controller: 'PatientsController'
            }).
            when('/records', {
                templateUrl: 'templates/records.html',
                controller: 'RecordsController'
            }).
            when('/clinton', {
                templateUrl: 'templates/clinton.html',
                controller: 'ClintonController'
            });
}]);