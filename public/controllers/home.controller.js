app.controller('homeCtrl',function($scope, $rootScope, $http, $localStorage) {
	$scope.getApiKey = function() {
		$scope.store_key = $localStorage.public_key;
	}
});