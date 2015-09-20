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
            url: '/',
            views: {
                '': {
                    templateUrl: 'ng-templates/index-view.html'
                },
                'topDes@home': {
                    'templateUrl': 'ng-templates/index-view/top-destinations.html',
                    controller: 'DestinationsController'
                },
                'topUlibier@home': {
                    'templateUrl': 'ng-templates/index-view/top-ulibier.html',
                    controller: 'UlibierController'
                }
            }
        })
        .state('blog', {
            url: '/blog',
            views: {
                '': {
                    templateUrl: 'ng-templates/blog-view.html'
                }
            }
        })
        .state('login', {
            url: '/login',
            templateUrl: 'ng-templates/login-view.html',
            controller: 'AuthController'
        })
        .state('404', {
            url: '/404',
            templateUrl: 'ng-templates/404.html'
        });
    $urlRouterProvider.otherwise('/home');
});