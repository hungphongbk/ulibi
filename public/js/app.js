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
app.factory('UlibiApi',["$http", "$location", function($http,$location){
    function getUrlBase(loc){
        var root = loc.$$absUrl
            .split('#')[0]
            .replace(window.location.origin,'');
        if(root.endsWith('/'))
            root=root.slice(0,-1);
        if(root.endsWith('index.html'))
            root=root.replace('index.html','');
        return root;
    }
    console.log(getUrlBase($location));
    var urlBase = getUrlBase($location)+'/api/';
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
var app = angular.module('Ulibi');
function wordsLimitTo(input, limit, begin, exceedSign){
    begin = (!begin || isNaN(begin)) ? 0 : toInt(begin);
    begin = (begin < 0 && begin >= -input.length) ? input.length + begin : begin;
    limit+=begin;

    exceedSign = (typeof exceedSign!=='undefined')?exceedSign:'';

    var regex=/\s+/gi;
	var words = input.trim().replace(regex,' ').split(' ');
	//console.log(words.length,' ',begin+limit);
	var length=(begin+limit>words.length)?words.length:begin+limit;
	exceedSign=(begin+limit<words.length)?exceedSign:'';
	var rs = words.slice(0,length).join(' ')+exceedSign;
	//console.log(length);
	//console.log(words.slice(0,length).join('-'));
	return rs;
}
app.filter('wordLimit',function(){
	return wordsLimitTo;
});
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
        api.destinations.getAll('withAvatar=1&top=6')
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
//# sourceMappingURL=app.js.map