var app = angular.module('Ulibi',[
    'satellizer',
    'ui.router',
    'ngAnimate'
]);
app.factory('UlibiAuth', function(){
    return {currentUser: ''};
});
app.config(function($stateProvider,$urlRouterProvider,$authProvider,$provide){
    $authProvider.loginUrl='ulibi/api/auth/authenticate';
    $stateProvider
        .state('home', {
            url: '/home',
            views: {
                '': {
                    templateUrl: 'ng-templates/index-view.html'
                },
                'topDes@home': {
                    'templateUrl': 'ng-templates/top-destinations.html',
                    controller: 'DestinationsController'
                },
                'topUlibier@home': {
                    templateUrl: 'ng-templates/top-ulibier.html',
                    controller: 'UlibierController'
                }
            }
        })
        .state('login', {
            url: '/login',
            templateUrl: 'ng-templates/login-view.html',
            controller: 'AuthController'
        });
    $urlRouterProvider.otherwise('/home');
});