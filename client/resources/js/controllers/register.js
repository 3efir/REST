App.controller('registerController',  function($scope, $stateParams, mainService) {
	mainService.getDetail(function(results) {
		$scope.detail = results;
	});
});