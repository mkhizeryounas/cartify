app.controller('collectionsCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	$scope.startCollectionForm = function() {
		$scope.obj={};
		$scope.obj.publish = true;
		$scope.products = [];
		$scope.obj.products = [];
		$.ajax({
			type:'get',
			url: base_url+'products/all',
			headers : $rootScope.auth_token,
		}).then(function(res) {
			console.log(res)
			$scope.products = res.products;
		});
	}
	$scope.addCollection = function(obj) {
		console.log(obj);
		$http.post(base_url+"collections/create", $.param({
			collection: obj
		})).then(function(res) {
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('collections');
			}
			else {
				notification('danger', res.data.message);
			}
		})
	}
	$scope.select = function(o) {
		$('#productInput').val('');
		console.log(o);
		if(!var_check(o.id)) {
			notification('danger', 'No product selected');
		}
		else {
			var check = true;
			$.each($scope.obj.products, function(k, v) {
				if(v.id == o.id) {
					check = false;
				}
			});
			if(check == true) {
				$scope.obj.products.push(o);
				$scope.$apply();
			}
			else {
				notification('danger', 'Product already added');
			}
		}
	}
	$scope.deleteProduct = function(k) {
		$scope.obj.products.splice(k, 1);
	}
	$scope.getAll = function () {
		$scope.collections = [];
		$.ajax({
			type:'get',
			url: base_url+'collections/all',
			headers : $rootScope.auth_token,
		}).then(function(res) {
			console.log(res)
			$scope.collections = res.collections;
		});
	}
	$scope.getCollection = function () {
		$scope.obj = {};
		$.ajax({
			type:'get',
			url: base_url+'products/all',
			headers : $rootScope.auth_token,
		}).then(function(res) {
			console.log(res)
			$scope.products = res.products;
		});
		$.ajax({
			type:'get',
			url: base_url+'collections/get',
			headers : $rootScope.auth_token,
			data: {
				id: $stateParams.c_id
			}
		}).then(function(res) {
			if(res.status==true) {
				console.log(res)
				$scope.obj = res.collection;
			}
			else {
				notification('danger', res.message);
				$state.go('collections');
			}
		});
	}
	$scope.editCollection = function (obj) {
		console.log(obj);
		$http.post(base_url+'collections/edit', $.param({
			collection: obj
		})).then(function(res) {
			console.log(res);
			if(res.data.status ==true) {
				notification('success', res.data.message);
				$state.go('collections');
			} 
			else {
				notification('danger', res.data.message);
			}
		})
	}
	$scope.deleteCollection = function (obj) {
		$http.post(base_url+'collections/delete', $.param({
			collection: obj
		})).then(function(res) {
			console.log(res);
			if(res.data.status ==true) {
				notification('success', res.data.message);
				$state.go('collections');
			} 
			else {
				notification('danger', res.data.message);
			}
		})
	}
});