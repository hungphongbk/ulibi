var app = angular.module('Ulibi');
app.controller('AuthController',function($scope,$auth,$state, UlibiAuth){
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
});