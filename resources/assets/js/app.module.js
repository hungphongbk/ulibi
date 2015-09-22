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

    $urlRouterProvider.when('','/');
    $urlRouterProvider.when('/blog','/blog/index');

    $stateProvider
        .state('homepage', {
            url: '/',
            views: {
                '': {
                    templateUrl: 'ng-templates/index-view.html'
                },
                'topDes@homepage': {
                    'templateUrl': 'ng-templates/index-view/top-destinations.html',
                    controller: 'DestinationsController'
                },
                'topUlibier@homepage': {
                    'templateUrl': 'ng-templates/index-view/top-ulibier.html',
                    controller: 'UlibierController'
                }
            }
        })
        .state('blog', {
            url: '/blog',
            abstract: true,
            template: '<ui-view />'
        })
        .state('blog.index', {
            url: '/index',
            views: {
                '': {
                    templateUrl: 'ng-templates/blog-view.html'
                }
            }
        })
        .state('blog.detail', {
            url: '/detail/:articleId',
            views: {
                '': {
                    templateUrl: 'ng-templates/blog-view/blog-detail.html'
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

    $urlRouterProvider.otherwise('/404');
    console.log('completed');
});