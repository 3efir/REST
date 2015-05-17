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
	};
	adminService.getOrders(function(results) {
        $scope.orders = results;
    });
	adminService.getAllCars(function(results) {
        $scope.data = results;
    });
	$scope.deleteCar = function(id) {
		adminService.deleteCar(id);
	}
});