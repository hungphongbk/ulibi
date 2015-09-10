var app=angular.module("Ulibi",["satellizer","ui.router"]);app.factory("UlibiAuth",function(){return{currentUser:""}}),app.config(["$stateProvider","$urlRouterProvider","$authProvider","$provide",function(t,o,e,l){e.loginUrl="ulibi/api/auth/authenticate",t.state("home",{url:"/home",views:{"":{templateUrl:"ng-templates/index-view.html"},"topDes@home":{templateUrl:"ng-templates/top-destinations.html",controller:"DestinationsController"}}}).state("login",{url:"/login",templateUrl:"ng-templates/login-view.html",controller:"AuthController"}),o.otherwise("/home")}]),app.run(["$rootScope","$state","UlibiAuth",function(t,o,e){t.$on("$stateChangeStart",function(t,o,e,l,r){console.log(l.name+" -> "+o.name)})}]);var app=angular.module("Ulibi");app.controller("UserController",["$scope","$state","$auth","UlibiAuth",function(t,o,e,l){t.user=l.currentUser,t.logout=function(){e.logout().then(function(t){l.currentUser="",o.go("^",null,{reload:!0})})}}]);var app=angular.module("Ulibi");app.controller("AuthController",["$scope","$auth","$state","UlibiAuth",function(t,o,e,l){var r=t;r.login=function(){var t={username:r.username,password:r.password};console.log(t),o.login(t).then(function(t){console.log(t),l.currentUser=t.data.user[0],e.go("home",null,{reload:!0})})}}]);var app=angular.module("Ulibi");app.directive("bootstrapCol",function(){return{restrict:"A",link:function(t,o,e){var l=["xs","sm","md","lg"],r=e.bootstrapCol.split(" ").map(function(t,o){return"-"===t?null:"col-"+l[o]+"-"+t}).join(" ");o.addClass(r)}}});var app=angular.module("Ulibi");app.controller("ArticlesController",["$scope","UlibiApi",function(t,o){var e=o,l=t;l.dataSource=[],l.getTop=function(){e.article.getAll().success(function(t){l.dataSource=t.slice(0,3)})}}]);var app=angular.module("Ulibi");app.controller("DestinationsController",["$scope","UlibiApi",function(t,o){var e=o,l=t;l.dataSource=[],l.getTop=function(){e.destinations.getAll("withAvatar=1").success(function(t){console.log(t),l.dataSource=t})}}]);var app=angular.module("Ulibi");app.factory("UlibiApi",["$http",function(t){var o="/ulibi/api/",e=t,l={article:{postfix:"article"},destinations:{postfix:"dest"}};return angular.forEach(l,function(t,l){t.getAll=function(t){return t=void 0===t?"":"?"+t,e.get(o+this.postfix+"/all"+t)}}),l}]);
//# sourceMappingURL=app.js.map