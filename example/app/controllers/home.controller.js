app.controller('homeCtrl',function($scope, $rootScope, $stateParams) {
	$scope.cart = [];

	$scope.allProducts = function() {
		$scope.products=[];
		ecom.products().then(function(res){
			console.log(res);
			$scope.products=res.products;
			$scope.$apply();
		});
	}
	$scope.allCollections = function() {
		$scope.products=[];
		ecom.collections().then(function(res){
			console.log(res);
			$scope.collections=res.collections;
			$scope.$apply();
		});
	}
	$scope.singleCollection = function() {
		var id = $stateParams.c_id;
		ecom.single_collection(id).then(function(res){
			console.log(res);
			$scope.collection=res.collection;
			$scope.$apply();
		});
	}
	$scope.singleProduct = function() {
		var id = $stateParams.p_id;
		ecom.single_product(id).then(function(res){
			console.log(res);
			$scope.product=res.product;
			$scope.$apply();
			$('#dec').html($scope.product.description);
		});	
	}
	$scope.addToCart = function (id) {
		ecom.addToCart(id).then(function(res) {
			console.log(res);
			$scope.getCart();
			alert(res.message);
			// $scope.$apply();
			if(!$scope.$$phase) $scope.$apply();
		})
	}
	$scope.removeFromCart = function (id) {
		ecom.removeFromCart(id).then(function(res) {
			console.log(res);
			$scope.getCart();
			alert(res.message);
			if(!$scope.$$phase) $scope.$apply();
			// $scope.$apply();	
		})
	}
	$scope.getCart = function() {
		ecom.getCart().then(function(res) {
			$scope.cart = res;
			if(!$scope.$$phase) $scope.$apply();
			console.log(res)
		});
	}
	$scope.getCart();
	$scope.checkout = () => {
		ecom.checkout().then(res => {
			console.log(res);
		})
	}
});