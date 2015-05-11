var App = angular.module('main', ['ui.router']);
App.controller('mainController', function($scope, $http, mainService) {
    mainService.getAllCars(function(results) {
        $scope.data = results;
    });
	mainService.getData(function(results) {
        $scope.render = results;
    });
      // create a blank object to hold our form information
      // $scope will allow this to pass between controller and view
      $scope.formData = {};
	 
	  // process the form
	$scope.processForm = function() {
	  $http({
	  method  : 'POST',
	  url     : "/~user8/REST/client/api/server/search/",
	  data    : $.param($scope.formData),  // pass in data as strings
	  headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
	 })
	  .success(function(data) {
		$scope.data = data;

		if (!data ) {
		  // if not successful, bind errors to error variables
		  $scope.error = "your search returned no results";
		} else {
		  // if successful, bind success message to message
		  $scope.message = data.message;
		}
	  });
	};
	mainService.checkLogin(function(results) {
		if(results == false) {
			$scope.login = {};
			$scope.login.sref = 'ui-sref="register"';
			$scope.login.link = "Registration";
		}
		else {
			$scope.login = "exit";
		}
    });
});