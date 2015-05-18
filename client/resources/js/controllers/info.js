App.controller('infoController',  function($scope, $stateParams, mainService) {
	mainService.getDetail(function(results) {
		$scope.detail = results;
		console.log(results);
	});
});