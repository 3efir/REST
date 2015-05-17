App.controller('userController',  function($scope, userService) {
	$scope.loginForm = {};
	$scope.login = function() {
		var message = userService.login($scope.loginForm);
		
	}
});