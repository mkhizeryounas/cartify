var app = angular.module('cartify_customer', [
  
]);

app.controller("customer_controller", function($scope, $http) {
  $scope.alreadyMember = true;
  $scope.toggleAccount = () => {
    $scope.alreadyMember = !$scope.alreadyMember;
  }
  $scope.loadCart = () => {
    console.log(cart_products);
    $scope.products = cart_products;
  }
})