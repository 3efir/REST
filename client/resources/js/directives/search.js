App.directive('search', function() {
  return {
    restrict: 'AE',
    replace: false,
    templateUrl: '/~user8/REST/client/resources/templates/search.html',
	async: true
  };
});