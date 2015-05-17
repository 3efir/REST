var App = angular.module('main', ['ui.router']);
App.controller('mainController', function($window, $scope, $http, mainService,
	userService) {
    
    mainService.getAllCars(function(results) {
        $scope.data = results;
    });
	mainService.getData(function(results) {
        $scope.render = results;
    });
     
      $scope.formData = {};
	 
	  // process the form
	$scope.processForm = function() {
	  $http({
	  method  : 'POST',
	  url     : "/~user8/REST/client/api/server/search/",
	  data    : $.param($scope.formData),  
	  headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  
	 })
	.success(function(data) {
		$scope.data = data;

		if (!data ) {
		  // if not successful, bind errors to error variables
		  $scope.error = "your search returned no results";
		}
	  });
	};
	$scope.login = {};
	mainService.checkLogin(function(results) {
		$scope.log = results;
    });
    $scope.reloadRoute = function() {
           $window.location.reload();
    };
	$scope.logOut = function() {
		userService.logOut();	
	};
	$scope.order = function() {
		userService.order();
	}
});
