app.controller('couponsCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	datePicker('begin');
	datePicker('expire');
	$scope.newCouponForm = function() {
		$scope.obj={};
		$scope.obj.code=newCode();
		$scope.obj.type = 'flat';
		$scope.obj.publish = true;
		$scope.obj.begin = null;
		$scope.obj.expire = null;
		$scope.obj.limit = null;
	}
	$scope.generateCoupon = function() {
		$scope.obj.code=newCode();
	}
	$scope.addCoupon = function(obj) {
		console.log(obj);
		$http.post(base_url+"coupons/create", $.param({
			coupon:obj
		})).then(function(res) {
			console.log(res.data);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('coupons');
			}
			else {
				notification('danger', res.data.message);
			}
		})
	}
	$scope.getAll = function() {
		$scope.coupons = [];
		$http.post(base_url+'coupons/all')
		.then(function(res) {
			console.log(res);
			if(res.data.status == true) {
				$scope.coupons = res.data.coupons;
			}
			else {
				notifiction('danger', 'Something went wrong');
			}
		})
	}
	$scope.getCoupon = function() {
		$scope.obj = [];
		$.ajax({
			url:base_url+'coupons/get',
			type: 'GET',
			headers: $rootScope.auth_token,
			data: {
				id: $stateParams.c_id
			}	
		}).then(function(res) {
			console.log(res);
			if(res.status == true) {
				$scope.obj = res.coupon;
			}
			else {
				notifiction('danger', res.message);
				$state.go('coupons');
			}
		})
	}
	$scope.editCoupon = function(obj) {
		console.log(obj);
		$http.post(base_url+'coupons/edit', $.param({
			coupon: obj
		})).then(function(res){
			console.log(res.data);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('coupons');
			}
			else {
				notification('danger', res.data.message);
			}
		})
	}
	$scope.deleteCoupon = function (obj) {
		$http.post(base_url+'coupons/delete', $.param({
			coupon: obj
		})).then(function(res) {
			console.log(res);
			if(res.data.status ==true) {
				notification('success', res.data.message);
				$state.go('coupons');
			} 
			else {
				notification('danger', res.data.message);
			}
		})
	}
});