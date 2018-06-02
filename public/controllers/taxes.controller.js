app.controller('taxesCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	$scope.startNewTax = function() {
		$http.get(base_url+'taxes/countries')
		.then(function(res) {
			$scope.countries = res.data.countries;
			$scope.obj.country = res.data.countries[0]['id'];
		});
		$scope.obj = {};
		$scope.obj.percent = 0;
	}
	$scope.addTax=function(obj) {
		// console.log(obj);
		$http.post(base_url+"taxes/create", $.param({
			tax:obj
		})).then(function(res) {
			// console.log(res);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('taxes');
			}
			else
				notification('danger', res.data.message);
		})
	}
	$scope.getAll = function() {
		$scope.taxes = [];
		$http.post(base_url+'taxes/all')
		.then(function(res) {
			if(res.data.status==true) {
				$scope.taxes = res.data.taxes;
			}
		})
	}
	$scope.getTax = function() {
		$state.obj={};
		$http.post(base_url+'taxes/get', $.param({
			tax_id:$stateParams.t_id
		})).then(function(res) {
			console.log(res.data.tax);
			if(res.data.status==true) {
				$scope.obj = res.data.tax;
			}
			else {
				notification('danger', res.data.message);
				$state.go('taxes');
			}
		})
	}
	$scope.editTax=function(obj) {
		// console.log(obj);
		$http.post(base_url+"taxes/edit", $.param({
			tax:obj
		})).then(function(res) {
			// console.log(res);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('taxes');
			}
			else
				notification('danger', res.data.message);
		});
	}
	$scope.deleteTax=function(obj) {
		// console.log(obj);
		$http.post(base_url+"taxes/delete", $.param({
			tax:obj
		})).then(function(res) {
			// console.log(res);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('taxes');
			}
			else
				notification('danger', res.data.message);
		});
	}
});