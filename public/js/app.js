var app=angular.module("Ulibi",["satellizer","ui.router"]);app.config(["$stateProvider","$urlRouterProvider","$authProvider",function(r,t,e){e.loginUrl="/auth/authenticate",t.otherwise("/auth"),r.state("auth",{url:"/auth",templateUrl:"../views/authView.html",controller:"AuthController as auth"}).state("users",{url:"/users",templateUrl:"../views/userView.html",controller:"UserController as user"})}]),app.controller("UserController",["$http",function(r){}]);var app=angular.module("Ulibi");app.directive("bootstrapCol",function(){return{restrict:"A",link:function(r,t,e){var l=["xs","sm","md","lg"],o=e.bootstrapCol.split(" ").map(function(r,t){return"-"===r?null:"col-"+l[t]+"-"+r}).join(" ");t.addClass(o)}}});var app=angular.module("Ulibi");app.controller("AuthController",["$auth","$state",function(r,t){var e=this;e.login=function(){var l={username:e.username,password:e.password};r.login(l).then(function(r){t.go("users",{})})}}]);