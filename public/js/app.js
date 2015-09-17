var app = angular.module('Ulibi',[
    'satellizer',
    'ui.router',
    'ngAnimate'
]);
app.factory('UlibiAuth', function(){
    return {currentUser: ''};
});
app.config(["$stateProvider", "$urlRouterProvider", "$authProvider", "$provide", function($stateProvider,$urlRouterProvider,$authProvider,$provide){
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
            $state.go('home', null, { 'reload': true });
        });
    };
}]);
var app=angular.module('Ulibi');
app.controller('UlibierController', ["$scope", "UlibiApi", function($scope,UlibiApi){
	$scope.dummyText='fuck you';
	var api=UlibiApi.ulibier;
	var s=$scope;
	s.numOfTrendings=3;
	s.dataSource=[];
	s.getTrending=function(){
		api.trending(s.numOfTrendings)
			.success(function(data){
				s.dataSource=data;
			});

	};
}]);
var app = angular.module('Ulibi');
app.controller('ArticlesController', ["$scope", "UlibiApi", function($scope,UlibiApi){
    var api=UlibiApi;
    var s=$scope;
    s.dataSource=[];

    s.getTop = function(){
        api.article.getAll()
            .success(function(data){
                s.dataSource=data.slice(0,3);
            });
    };
}]);
var app = angular.module('Ulibi');
app.controller('DestinationsController', ["$scope", "UlibiApi", function($scope,UlibiApi){
    var api=UlibiApi;
    var s=$scope;
    s.dataSource=[];

    s.getTop = function(){
        api.destinations.getAll('withAvatar=1')
            .success(function(data){
                //console.log(data);
                s.dataSource=data;
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
var app=angular.module('Ulibi');
app.factory('UlibiApi',["$http", function($http){
    var urlBase = '/ulibi/api/';
    var h=$http;
    var api= {
        article: {
            postfix: 'article'
        },
        destinations: {
            postfix: 'dest'
        },
        ulibier: {
            postfix: 'ulibier'
        }
    };
    angular.forEach(api, function(section,_){
        section.getAll=function(param){
            param = (param === undefined)?'':'?'+param;
            return h.get(urlBase+this.postfix+'/all'+param);
        }
    });

    api.ulibier.trending=function(top){
        top=top||3;
        return h.get(urlBase+this.postfix+'/trending?top='+top);
    };

    return api;
}]);
//# sourceMappingURL=app.js.map