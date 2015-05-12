App.config(function($stateProvider, $urlRouterProvider) {
  //
  // For any unmatched url, redirect to /state1
  $urlRouterProvider.otherwise("/");
  //
  // Now set up the states
  $stateProvider
    .state('info', {
      url: "/info/{id}",
	  controller: "infoController  as info",
      templateUrl: "/~user8/REST/client/resources/templates/detail.html"
    })
	.state('index', {
		url: "/",
		controller: "mainController",
		templateUrl: "/~user8/REST/client/resources/templates/shop.html"
	})
	.state('register', {
		url: "/register/",
		controller: "registerController",
		templateUrl: "/~user8/REST/client/resources/templates/register.html"
	})
	.state('admin', {
		url: "/admin/", 
		templateUrl: "/~user8/REST/client/resources/templates/admin.html",
		controller: "adminController as admin"
	})
	.state('addAuto', {
		url: "/admin/add/", 
		views: {
			'admin': {
				templateUrl: "/~user8/REST/client/resources/templates/addAuto.html",
				controller: "adminController as admin"
			}
		}
	})
});