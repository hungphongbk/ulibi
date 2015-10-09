var app=angular.module('UlibiAdmin',['ui.router','ngResource']);
app.config(function($stateProvider,$urlRouterProvider){
    $urlRouterProvider.otherwise('/dest/view');
    $stateProvider
        .state('home',{
            url:'/'
        })
        .state('dest',{
            url:'/dest',
            controller:'DestController',
            templateUrl:'ngtmpl/destinations.view.html'
        })
        .state('dest.viewMD',{
            url:'/view',
            views: {
                'master':{
                    'templateUrl':'ngtmpl/destinations.master.html'
                },
                'detail':{
                    'templateUrl':'ngtmpl/destinations.detail.html'
                }
            }
        });
});
function UlibiAdminApi($resource){
    return {
        Dest: $resource('/admin/destination/:id')
    };
}
app.factory('UlibiAdminApi',UlibiAdminApi);
function DestController($scope,UlibiAdminApi){
    $scope.dataSrc=UlibiAdminApi.Dest.query();
}
app.controller('DestController',DestController);
//# sourceMappingURL=admin.js.map
