App.controller('registerController',  function($scope, $stateParams, adminService) {
	$scope.registerForm = {};
	$scope.message = "";
	$scope.register = function() {
		var message = adminService.register($scope.registerForm);
		console.log(adminService.message);
	}
});