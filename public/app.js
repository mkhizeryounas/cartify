var app = angular.module('cartify', [
  'ngStorage',
  'ui.router',
  'angular-loading-bar',
  'angularTrix',
  'uiSwitch',
  'ngSanitize',
  'mgcrea.ngStrap',
  'textAngular',
]);
app.config(function($httpProvider) {
  $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
  $httpProvider.interceptors.push('httpRequestInterceptor');
});

app.factory('httpRequestInterceptor', function ($localStorage, $rootScope) {
 return {
   request: function (config) {
    var auth_headers = $localStorage.public_key;
    // console.log(auth_headers);
    if (typeof auth_headers !== 'undefined')  {
      config.headers["Public-Key"] = auth_headers;
    }
    return config;
   }
 };
});
app.run(function($localStorage, $state, $rootScope, $http) {
	$rootScope.base_url = base_url;
	$rootScope.$state = $state;
	$rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams, options) {
    $rootScope.auth_token={"Public-Key":$localStorage.public_key};
    $('#preloader').show();
		$http.post(base_url+'open/me')
		.then(function(res) {
			if(res.data.logged_in != true) {
				event.preventDefault();
        location.reload();
			}
			else {
				$localStorage.public_key = res.data.store_key;
        $('#preloader').fadeOut();
			}
		})
	});
});
