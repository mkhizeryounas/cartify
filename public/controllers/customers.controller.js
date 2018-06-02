app.controller('customersCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	$scope.addCustomer = function(obj) {
		console.log(obj);
		$.ajax({
			type:'post',
			url: base_url+'customers/create',
			headers : $rootScope.auth_token,
			data : {
				customer:obj
			}
		}).then(function(res) {
			console.log(res);
			if(res.status == true) {
				notification('success', res.message);
				$state.go('customers');
			}else {
				notification('danger', res.message);
			}
		});
	}
	$scope.editCustomer = function(obj) {
		if(!var_check(obj.password)) {
			obj.password = null;
		}
		console.log(obj);
		$.ajax({
			type:'post',
			url: base_url+'customers/edit',
			headers : $rootScope.auth_token,
			data : {
				customer:obj
			}
		}).then(function(res) {
			console.log(res);
			if(res.status == true) {
				notification('success', res.message);
				$state.go('customers');
			}else {
				notification('danger', res.message);
			}
		});
	}
	$scope.getAll = function() {
		$http.post(base_url+"customers/all")
		.then(function(res) {
			console.log(res.data);
			if(res.data.status==true) {
				$scope.customers = res.data.customers;
			}
		})
	}
	$scope.getSingle = function () {
		var id = $stateParams.cus_id;
		$scope.obj = {};
		$.ajax({
			url:base_url+'customers/get',
			type: 'GET',
			headers: $rootScope.auth_token,
			data: {
				id: id
			}	
		}).then(function(res) {
			console.log(res);
			if(res.status == true) {
				$scope.obj = res.customer;
			}
			else {
				notifiction('danger', res.message);
				$state.go('customers');
			}
		})
	}
	$scope.deleteCustomer = function(obj) {
		console.log(obj);
		$http.post(base_url+"customers/delete", $.param({
			customer: obj
		}))
		.then(function(res) {
			console.log(res.data);
			if(res.data.status == true) {
				notification('success', res.data.message);
				$state.go('customers');
			}else {
				notification('danger', res.data.message);
			}
		})
	}
});