app.controller('shippingsCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	$scope.getAll = function() {
		$scope.shipping={};
		$http.post(base_url+"shippings/all")
		.then(function(res) {
			$scope.shipping=res.data.shipping;
			console.log(res);
		})
	}
	$scope.getInt = function() {
		$scope.obj={};
		$http.post(base_url+"shippings/all")
		.then(function(res) {
			$scope.obj=res.data.shipping.international;
			console.log(res);
		})
	}
	$scope.editIntShipping=function(obj) {		
		// console.log(obj);
		$http.post(base_url+"shippings/edit_international", $.param({
			shipping:obj
		})).then(function(res) {
			// console.log(res);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('shippings');
			}
			else
				notification('danger', res.data.message);
		});
	}
});