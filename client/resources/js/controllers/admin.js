App.controller('adminController',  function($scope, $state, $stateParams, mainService) {
	var action = $stateParams.action;
	$scope.items = ['settings', 'home', 'other'];
  $scope.selection = $scope.items[0];
});