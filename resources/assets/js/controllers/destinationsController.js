var app = angular.module('Ulibi');
app.controller('DestinationsController', function($scope,UlibiApi){
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
});