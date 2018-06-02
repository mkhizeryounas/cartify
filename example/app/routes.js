app.config(function($stateProvider,$urlRouterProvider) {
  $stateProvider
  .state('home', {
    templateUrl: 'app/partials/home.html',
    url: '/home',
    controller: "homeCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('default', {
    templateUrl: 'app/partials/home.html',
    url: '/',
    controller: "homeCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('collections', {
    templateUrl: 'app/partials/collections.html',
    url: '/collections',
    controller: "homeCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('single_collection', {
    templateUrl: 'app/partials/single-collection.html',
    url: '/collections/:c_id/:c_slug',
    controller: "homeCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('single_product', {
    templateUrl: 'app/partials/single-product.html',
    url: '/products/:p_id/:p_slug',
    controller: "homeCtrl",
    data : {
      authLevel: "admin"
    }
  })
  


  $urlRouterProvider.otherwise('/home');
});