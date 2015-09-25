var app = angular.module('Ulibi');
app.controller('ArticlesController', function($scope,UlibiApi){
    var api=UlibiApi;
    var s=$scope;
    s.dataSource=[];

    s.getTop = function(){
        api.article.getAll()
            .success(function(data){
                s.dataSource=data.slice(0,3);
            });
    };
});