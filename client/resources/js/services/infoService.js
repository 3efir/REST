App.service('infoService', function($http) {
	return {
		getDetail: function(id, callback) {
			$http.get('/~user8/REST/client/api/server/getAllDetail/'+id).success(callback);
		}
	};
});