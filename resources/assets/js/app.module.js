var app = angular.module('Ulibi',[
    'satellizer',
    'ui.router',
    'ngMaterial'
]);
app.factory('UlibiAuth', function(){
    return {currentUser: ''};
});
app.config(function($stateProvider,$urlRouterProvider,$authProvider,$provide){
    $authProvider.loginUrl='ulibi/api/auth/authenticate';
    $stateProvider
        .state('home', {
            url: '/home',
            templateUrl: 'ng-templates/index-view.html',
            controller: function($state){
                $state.go('home.trending');
            }
        })
        .state('home.trending', {
            url: '/top',
            views: {
                'topArticles': {
                    templateUrl: 'ng-templates/top-articles.html',
                    controller: 'ArticlesController'
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
app.run(function($rootScope, $state, UlibiAuth){
    $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
        console.log(fromState.name+' -> '+toState.name);
    });
});
