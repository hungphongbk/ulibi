var app = angular.module('Ulibi',['satellizer','ui.router']);
app.config(function($stateProvider,$urlRouterProvider,$authProvider){
    $authProvider.loginUrl='/auth/authenticate';
    $urlRouterProvider.otherwise('/auth');
    $stateProvider
        .state('auth', {
            url: '/auth',
            templateUrl: '../views/authView.html',
            controller: 'AuthController as auth'
        })
        .state('users', {
            url: '/users',
            templateUrl: '../views/userView.html',
            controller: 'UserController as user'
        });
});
app.controller('UserController',function($http){

});