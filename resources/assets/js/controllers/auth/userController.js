var app = angular.module('Ulibi');
app.controller('UserController',function($scope, $state, $auth, UlibiAuth){
    $scope.user = UlibiAuth.currentUser;
    $scope.logout = function(){
        $auth.logout().then(function(data){
            UlibiAuth.currentUser = '';
            $state.go('^', null, { 'reload': true });
        });
    };
});