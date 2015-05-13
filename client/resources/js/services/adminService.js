App.service('adminService', function($http, $stateParams) {
	return {
		addAuto: function(arr) {
			$http({
				method  : 'POST',
				url     : "/~user8/REST/client/api/car/info/",
				data    : $.param(arr),  
				headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
			})
			.success(function(data) {
				arr = "Auto added!";

				if (!data ) {
				  // if not successful, bind errors to error variables
				  $scope.error = "your search returned no results";
				}
			});
		}
	};
});