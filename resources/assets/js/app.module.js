var app = angular.module('Ulibi',['satellizer','ui.router']);
app.factory('UlibiAuth', function(){
    return {currentUser: ''};
});
app.config(function($stateProvider,$urlRouterProvider,$authProvider,$provide){
    $authProvider.loginUrl='ulibi/api/auth/authenticate';
    $stateProvider
        .state('home', {
            url: '/home',
            views: {
                'auth': {
                    templateUrl: 'ng-templates/auth-view.html',
                    controller: function($state,$auth){
                        console.log('Current user: '+$auth.isAuthenticated());
                        if($auth.isAuthenticated())
                            $state.go('home.loggedin');
                        else
                            $state.go('home.public');
                    }
                },
                'topArticles': {
                    templateUrl: 'ng-templates/top-articles.html',
                    controller: 'topArticlesController'
                }
            }
        })
        .state('home.public', {
            url: '/public',
            templateUrl: 'ng-templates/login-view.html',
            controller: 'AuthController'
        })
        .state('home.loggedin', {
            url: '/loggedin',
            templateUrl: 'ng-templates/user-view.html',
            controller: 'UserController'
        });
    $urlRouterProvider.otherwise('/home');
});
app.run(function($rootScope, $state, UlibiAuth){
    $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
        console.log(fromState.name+' -> '+toState.name);
    });
});
