var app=angular.module('Ulibi');
app.controller('UlibierController', function($scope,UlibiApi){
	$scope.dummyText='fuck you';
	var api=UlibiApi.ulibier;
	var s=$scope;
	s.numOfTrendings=3;
	s.dataSource=[];
	s.getTrending=function(){
		api.trending(s.numOfTrendings)
			.success(function(data){
				console.log(data);
				s.dataSource=data;
			});

	};
});