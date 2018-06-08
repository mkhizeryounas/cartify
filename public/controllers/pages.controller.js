app.controller('pagesCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	$scope.init = () => {

	}
	$scope.startNewPage = () => {
		$scope.obj = Object();
	}
	$scope.addPage = (obj) => {
		console.log(obj);
	}
});