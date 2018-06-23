var app = angular.module('cartify_customer', [
  
]);

app.controller("customer_controller", function($scope, $http) {
  $scope.alreadyMember = true;
  $scope.toggleAccount = () => {
    $scope.alreadyMember = !$scope.alreadyMember;
  }
  $scope.loadCart = () => {
    $scope.products = cart_products;
    $scope.countries = all_countries;
    $scope.cart = {
      shipping: 0,
      tax: 0,
      sub_total: 0,
      total: 0
    };
    $scope.products.map(e => {
      $scope.cart.sub_total+=(e.qty*e.sale_price)
    })
  }
})