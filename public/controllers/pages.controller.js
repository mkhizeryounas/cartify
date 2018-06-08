app.controller('pagesCtrl',function($scope, $rootScope, $http, $state, $localStorage, $stateParams) {
	$scope.init = () => {
		$scope.pages = [];
		$.ajax({
			type:'get',
			url: base_url+'pages/all',
			headers : $rootScope.auth_token,
		}).then(function(res) {
			console.log(res)
			$scope.pages = res.pages;
		});
	}
	$scope.startNewPage = () => {
		$scope.obj = Object();
		$scope.images = Array();
	}
	$scope.addPage = (obj) => {
		$http.post(base_url+'pages/create', $.param({
			page : obj
		})).then(function(res) {
			console.log(res.data);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('pages');
			}
			else
				notification('danger', res.data.message);
		})
	}
	$scope.uploadedFile = function() {
		$('#prog-div').show()
		$('#prog').val(0);
		$("#image").upload(base_url+"open/do_upload", function(res){
			if(res.status == true) {
				$scope.images.push(base_url+'files/'+res.upload_data);
				$scope.$apply();
			}	
			else {
				notification('danger', res.message);
			}
			console.log($scope.obj.images);
		},$("#prog"));
	}
	$scope.deleteImg = function(i) {
		$scope.images.splice(i,1);
	}
	$scope.deletePage = function (id) {
		let flag = confirm("Are you sure you want to delete this page?");
		if(!flag) return;
		$http.post(base_url+'pages/delete', $.param({
			page: {id}
		})).then(function(res) {
			console.log(res);
			if(res.data.status ==true) {
				notification('success', res.data.message);
				$state.reload();
			} 
			else {
				notification('danger', res.data.message);
			}
		})
	}
	$scope.startEditPage = () => {
		let id = $stateParams.p_id;
		$.ajax({
			type:'get',
			url: base_url+'pages/get',
			headers : $rootScope.auth_token,
			data: $.param({id})
		}).then(function(res) {
			console.log(res)
			if(res.status==true) {
				$scope.obj = res.page;	
			}
			else {
				notification('danger', res.message);
				$state.go('pages');
			}
		});
	}
	$scope.editPage = (obj) => {
		$http.post(base_url+'pages/edit', $.param({
			page : obj
		})).then(function(res) {
			console.log(res.data);
			if(res.data.status==true) {
				notification('success', res.data.message);
				$state.go('pages');
			}
			else
				notification('danger', res.data.message);
		})
	}
});