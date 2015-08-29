var app = angular.module('Ulibi',['satellizer','ui.router']);
app.factory('UlibiAuth', function(){
    return {currentUser: ''};
});
app.config(["$stateProvider", "$urlRouterProvider", "$authProvider", "$provide", function($stateProvider,$urlRouterProvider,$authProvider,$provide){
    $authProvider.loginUrl='ulibi/api/auth/authenticate';
    $stateProvider
        .state('home', {
            url: '/home',
            views: {
                'auth': {
                    templateUrl: 'ng-templates/auth-view.html',
                    controller: ["$state", "$auth", function($state,$auth){
                        console.log('Current user: '+$auth.isAuthenticated());
                        if($auth.isAuthenticated())
                            $state.go('home.loggedin');
                        else
                            $state.go('home.public');
                    }]
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
}]);
app.run(["$rootScope", "$state", "UlibiAuth", function($rootScope, $state, UlibiAuth){
    $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
        console.log(fromState.name+' -> '+toState.name);
    });
}]);

var app = angular.module('Ulibi');
app.controller('UserController',["$scope", "$state", "$auth", "UlibiAuth", function($scope, $state, $auth, UlibiAuth){
    $scope.user = UlibiAuth.currentUser;
    $scope.logout = function(){
        $auth.logout().then(function(data){
            UlibiAuth.currentUser = '';
            $state.go('^', null, { 'reload': true });
        });
    };
}]);
var app = angular.module('Ulibi');
app.controller('AuthController',["$scope", "$auth", "$state", "UlibiAuth", function($scope,$auth,$state, UlibiAuth){
    var vm = $scope;
    vm.login = function () {
        var credentials = {
            username: vm.username,
            password: vm.password
        };
        console.log(credentials);
        // Use Satellizer's $auth service to login
        $auth.login(credentials).then(function (data) {
            // If login is successful, redirect to the users state
            console.log(data);
            UlibiAuth.currentUser = data.data['user'][0];
            $state.go('^', null, { 'reload': true });
        });
    };
}]);
var app=angular.module('Ulibi');
app.directive('bootstrapCol',function(){
    return {
        restrict: 'A',
        link:function(s,e,a){
            var units=['xs','sm','md','lg'];
            var vals= a.bootstrapCol.split(' ')
                .map(function(e,i){
                    if(e==='-') return null;
                    return 'col-'+units[i]+'-'+e;
                })
                .join(' ');
            e.addClass(vals);
        }
    }
});
var app = angular.module('Ulibi');
app.controller('topArticlesController', ["$scope", function($scope){
    
}]);