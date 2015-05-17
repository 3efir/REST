App.service('adminService', function($window, $http, $stateParams) {
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
		},
		getOrders: function(callback) {
			$http.get('/~user8/REST/client/api/server/orders/').success(callback);
		},
		getAllCars: function(callback) {
			$http.get('/~user8/REST/client/api/car/getCarsForRedact').success(callback);
		},
		deleteCar: function(id) {
			$http.delete('/~user8/REST/client/api/car/info/'+id).success(function(data) {
			$window.location.reload();
			});
		},
		register: function(arr) {
			$http({
				method  : 'POST',
				url     : "/~user8/REST/client/api/user/register/",
				data    : $.param(arr),  
				headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
			})
			.success(function(data) {
				alert(data);
				$window.location.reload();
				if (!data ) {
				  // if not successful, bind errors to error variables
				  
				}
			});
		},
		message: ""
	}
});