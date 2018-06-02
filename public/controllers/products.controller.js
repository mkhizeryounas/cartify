app.controller('productsCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	$scope.newProductForm = function() {
		$scope.obj = {};
		$scope.obj.qty=0;
		$scope.obj.track = false;
		$scope.obj.shipping = false;
		$scope.obj.weight = 0;
		$scope.obj.depth = 0;
		$scope.obj.width = 0;
		$scope.obj.height = 0;
		$scope.obj.meta = '';
		$scope.obj.product_publish = true;
		$scope.obj.sku = '';
		$scope.obj.taxable = true;
		$scope.obj.images = [];

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
	$scope.addProduct = function(obj) {
		$scope.obj.description = $('.trix-content').val();
		console.log(obj);
		$http.post(base_url+'products/create', $.param({
			product:obj
		})).then(function(res) {
			console.log(res);
			if(res.data.status == true) {
				$state.go('products');
				notification('success', res.data.message);
			}	
			else {
				notification('danger', res.data.message);
			}
		})
	}
	$scope.uploadedFile = function() {
		$('#prog-div').show()
		$('#prog').val(0);
		$("#image").upload(base_url+"open/do_upload", function(res){
			if(res.status == true) {
				$scope.obj.images.push(res.upload_data);
				$scope.$apply();
			}	
			else {
				notification('danger', res.message);
			}
			console.log($scope.obj.images);
		},$("#prog"));
	}
	$scope.deleteImg = function(i) {
		$scope.obj.images.splice(i,1);
	}
	$scope.getAll = function() {
		$scope.products = [];
		$.ajax({
			type:'get',
			url: base_url+'products/all',
			headers : $rootScope.auth_token,
		}).then(function(res) {
			console.log(res)
			$scope.products = res.products;
		});
	}
	$scope.getProduct = function() {
		$scope.categories = [];
		$.ajax({
			type:'get',
			url: base_url+'categories/all',
			headers : $rootScope.auth_token,
		}).then(function(res) {
			console.log(res)
			$scope.categories = res.categories;
		});

		$scope.obj={};
		$.ajax({
			type:'get',
			url: base_url+'products/get/edit',
			headers : $rootScope.auth_token,
			data: $.param({
				id: $stateParams.p_id,
			})
		}).then(function(res) {
			console.log(res)
			if(res.status==true) {
				$scope.obj = res.product;
				$scope.obj.price = parseFloat($scope.obj.price);				
				$scope.obj.quantity = parseFloat($scope.obj.quantity);				
				$scope.obj.weight = parseFloat($scope.obj.weight);				
				$scope.obj.depth = parseFloat($scope.obj.depth);				
				$scope.obj.width = parseFloat($scope.obj.width);				
				$scope.obj.height = parseFloat($scope.obj.height);				
				$scope.obj.compare_price = parseFloat($scope.obj.compare_price);				
			}
			else {
				notification('danger', res.message);
				$state.go('products');
			}
		});
	}
	$scope.editProduct = function(obj) {
		obj = JSON.parse(JSON.stringify(obj));
		obj.description = $('.trix-content').val();
		console.log(obj);
		$http.post(base_url+"products/edit",$.param({
			product:obj
		})).then(function(res){
			console.log(res);
			if(res.data.status == true) {
				$state.go('products');
				notification('success', res.data.message);
			}	
			else {
				notification('danger', res.data.message);
			}
		})
	}
	$scope.deleteProduct = function (obj) {
		$http.post(base_url+'products/delete', $.param({
			product: obj
		})).then(function(res) {
			console.log(res);
			if(res.data.status ==true) {
				notification('success', res.data.message);
				$state.go('products');
			} 
			else {
				notification('danger', res.data.message);
			}
		})
	}
});