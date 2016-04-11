var app = angular
    .module('app', ['ngRoute'])
    .config(function($routeProvider) {
        $routeProvider
            .when('/caca', {
                templateUrl: 'toto.html',
                controller: 'TotoCtrl'
            });
//        $httpProvider.interceptors.push('APIInterceptor');
        //  console.log($httpProvider.interceptors);
    });