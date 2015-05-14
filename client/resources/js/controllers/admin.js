App.controller('adminController',  function($scope, $state, $stateParams, 
	adminService, mainService) {
	$scope.adminMenu = '';
	$scope.formAuto = {};
	$scope.add = function() {
		$scope.adminMenu = 'add';
	};
	$scope.list = function() {
		$scope.adminMenu = 'list';
	};
	$scope.orders = function() {
		$scope.adminMenu = 'orders';
	};
	$scope.addAuto = function() {
		$scope.message = adminService.addAuto($scope.formAuto);
	  /* $http({
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
		}
	  }); */
	};
	adminService.getOrders(function(results) {
        $scope.orders = results;
    });
	adminService.getAllCars(function(results) {
        $scope.data = results;
		//console.log($scope.main);
    });
	$scope.deleteCar = function(id) {
		adminService.deleteCar(id);
	}
});