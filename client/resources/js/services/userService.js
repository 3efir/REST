App.service('userService', function($window, $http, $stateParams) {
	return {
		login: function(arr) {
			$http.put('/~user8/REST/client/api/user/login/', 
			{"test": arr})
			.success(function(data) {
			if(false == data) {
				alert("email or password not correct");
			}
			else
			{
				localStorage.setItem("dnk_key", data);
				$window.location.href = "#/";
				$window.location.reload();
			}
			})
		},
		logOut: function() {
			var hash = localStorage["dnk_key"];
			$http.delete('/~user8/REST/client/api/user/login/'+hash)
			.success(function(data) {
				localStorage.removeItem("dnk_key");
				$window.location.reload();
				hash = "";
			});
		},
		order: function() {
			if(undefined == localStorage["dnk_key"])
			{
				alert("please login first");
			}
			else
			{
				var arr = {
							id: $stateParams.id,
							hash: localStorage["dnk_key"]
						};	
				$http({
					method  : 'POST',
					url     : "/~user8/REST/client/api/server/order/",
					data    : $.param(arr),  
					headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
				})
				.success(function(data) {
					if(true == data) {
						alert("Thank you for buy, tra ta ta ");
					}
					else {
						alert("please login first");
					}

				});

			}
		}
	}
});
