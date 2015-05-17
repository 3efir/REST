App.service('mainService', function($http, $stateParams) {
	return {
		getAllCars: function(callback) {
			$http.get('/~user8/REST/client/api/car/getAllCars')
			.success(callback);
		},
		getDetail: function(callback) {
			var id = $stateParams.id;
			$http.get('/~user8/REST/client/api/car/info/'+id)
			.success(callback);
			
		},
		getData: function(callback) {
			$http.get('/~user8/REST/client/api/server/getData/')
			.success(callback);
		},
		checkLogin: function(callback) {
			var hash = localStorage["dnk_key"];
			if(hash !== undefined) {
				$http.get('/~user8/REST/client/api/user/login/'+hash)
				.success(callback);
			}
			else {
				callback = false;
			}
		}
	};
});
