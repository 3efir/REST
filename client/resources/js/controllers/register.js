App.controller('registerController',  function($scope, $stateParams, adminService) {
	$scope.registerForm = {};
	$scope.message = "";
	$scope.register = function() {
		adminService.register($scope.registerForm);
	}
});