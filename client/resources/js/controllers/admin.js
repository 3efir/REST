App.controller('adminController',  function($scope, $state, $stateParams, 
	mainService) {
	$scope.adminMenu = '';
	$scope.add = function() {
		$scope.adminMenu = 'add';
	};
	$scope.list = function() {
		$scope.adminMenu = 'list';
	};
	$scope.orders = function() {
		$scope.adminMenu = 'orders';
	};
});