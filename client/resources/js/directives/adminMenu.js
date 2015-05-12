App.directive('admin', function() {
  return {
    restrict: 'AE',
    replace: false,
    templateUrl: '/~user8/REST/client/resources/templates/adminMenu.html',
	async: true
  };
});