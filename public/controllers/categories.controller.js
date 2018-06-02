app.controller('categoriesCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	$scope.addCategory = function(obj) {
		console.log(obj);
		$http.post(base_url+'categories/create', $.param({
			category : obj
		})).then(function(res) {
			console.log(res.data);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('categories');
			}
			else
				notification('danger', res.data.message);
		})
	}
	$scope.getAll = function() {
		$scope.categories = [];
		$.ajax({
			type:'get',
			url: base_url+'categories/all',
			headers : $rootScope.auth_token,
		}).then(function(res) {
			console.log(res)
			$scope.categories = res.categories;
		});
	}
	$scope.getCategory = function() {
		$.ajax({
			type:'get',
			url: base_url+'categories/get',
			headers : $rootScope.auth_token,
			data: $.param({
				id: $stateParams.cat_id,
			})
		}).then(function(res) {
			console.log(res)
			if(res.status==true) {
				$scope.obj = res.category;	
			}
			else {
				notification('danger', res.message);
				$state.go('categories');
			}
		});
	}
	$scope.editCategory = function (obj) {
		console.log(obj);
		$http.post(base_url+'categories/edit', $.param({
			category: obj
		})).then(function(res) {
			console.log(res);
			if(res.data.status ==true) {
				notification('success', res.data.message);
				$state.go('categories');
			} 
			else {
				notification('danger', res.data.message);
			}
		})
	}
	$scope.deleteCategory = function (obj) {
		$http.post(base_url+'categories/delete', $.param({
			category: obj
		})).then(function(res) {
			console.log(res);
			if(res.data.status ==true) {
				notification('success', res.data.message);
				$state.go('categories');
			} 
			else {
				notification('danger', res.data.message);
			}
		})
	}

});