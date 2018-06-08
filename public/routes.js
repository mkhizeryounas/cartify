app.config(function($stateProvider,$urlRouterProvider) {
  $stateProvider
  .state('home', {
    templateUrl: base_url+'public/partials/home.html',
    url: '/home',
    controller: "homeCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('default', {
    templateUrl: base_url+'public/partials/home.html',
    url: '/',
    controller: "homeCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('categories', {
    templateUrl: base_url+'public/partials/categories/categories.html',
    url: '/categories',
    controller: "categoriesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('new_category', {
    templateUrl: base_url+'public/partials/categories/new.html',
    url: '/categories/new',
    controller: "categoriesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('edit_category', {
    templateUrl:  base_url+'public/partials/categories/edit.html',
    url: '/categories/:cat_id/edit',
    controller: "categoriesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('delete_category', {
    templateUrl:  base_url+'public/partials/categories/delete.html',
    url: '/categories/:cat_id/delete',
    controller: "categoriesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('products', {
    templateUrl: base_url+'public/partials/products/products.html',
    url: '/products',
    controller: "productsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('new_product', {
    templateUrl: base_url+'public/partials/products/new.html',
    url: '/products/new',
    controller: "productsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('edit_product', {
    templateUrl:  base_url+'public/partials/products/edit.html',
    url: '/products/:p_id/edit',
    controller: "productsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('delete_product', {
    templateUrl:  base_url+'public/partials/products/delete.html',
    url: '/products/:p_id/delete',
    controller: "productsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('collections', {
    templateUrl: base_url+'public/partials/collections/collections.html',
    url: '/collections',
    controller: "collectionsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('new_collection', {
    templateUrl: base_url+'public/partials/collections/new.html',
    url: '/collections/new',
    controller: "collectionsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('edit_collection', {
    templateUrl:  base_url+'public/partials/collections/edit.html',
    url: '/collections/:c_id/edit',
    controller: "collectionsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('delete_collection', {
    templateUrl:  base_url+'public/partials/collections/delete.html',
    url: '/collections/:c_id/delete',
    controller: "collectionsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('coupons', {
    templateUrl: base_url+'public/partials/coupons/coupons.html',
    url: '/coupons',
    controller: "couponsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('new_coupon', {
    templateUrl: base_url+'public/partials/coupons/new.html',
    url: '/coupons/new',
    controller: "couponsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('edit_coupon', {
    templateUrl: base_url+'public/partials/coupons/edit.html',
    url: '/coupons/:c_id/edit',
    controller: "couponsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('delete_coupon', {
    templateUrl: base_url+'public/partials/coupons/delete.html',
    url: '/coupons/:c_id/delete',
    controller: "couponsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('taxes', {
    templateUrl: base_url+'public/partials/taxes/taxes.html',
    url: '/taxes',
    controller: "taxesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('new_tax', {
    templateUrl: base_url+'public/partials/taxes/new.html',
    url: '/taxes/new',
    controller: "taxesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('edit_tax', {
    templateUrl: base_url+'public/partials/taxes/edit.html',
    url: '/taxes/:t_id/edit',
    controller: "taxesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('delete_tax', {
    templateUrl: base_url+'public/partials/taxes/delete.html',
    url: '/taxes/:t_id/delete',
    controller: "taxesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('shippings', {
    templateUrl: base_url+'public/partials/shippings/shipping.html',
    url: '/shippings',
    controller: "shippingsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('int_shipping', {
    templateUrl: base_url+'public/partials/shippings/int-shipping.html',
    url: '/shippings/international/edit',
    controller: "shippingsCtrl",
    data : {
      authLevel: "admin"
    }
  })
  // ORDERS
  .state('orders', {
    templateUrl: base_url+'public/partials/orders/orders.html',
    url: '/orders',
    controller: "ordersCtrl",
    data : {
      authLevel: "admin"
    }
  })
  // API
  .state('api', {
    templateUrl: base_url+'public/partials/api/api.html',
    url: '/api',
    controller: "homeCtrl",
    data : {
      authLevel: "admin"
    }
  })
  // CUSTOMERS
  .state('customers', {
    templateUrl: base_url+'public/partials/customers/customers.html',
    url: '/customers',
    controller: "customersCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('new_customer', {
    templateUrl: base_url+'public/partials/customers/new.html',
    url: '/customers/new',
    controller: "customersCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('edit_customer', {
    templateUrl: base_url+'public/partials/customers/edit.html',
    url: '/customers/:cus_id/edit',
    controller: "customersCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('delete_customer', {
    templateUrl: base_url+'public/partials/customers/delete.html',
    url: '/customers/:cus_id/delete',
    controller: "customersCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('pages', {
    templateUrl: base_url+'public/partials/pages/pages.html',
    url: '/pages',
    controller: "pagesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('new_page', {
    templateUrl: base_url+'public/partials/pages/new.html',
    url: '/pages/new',
    controller: "pagesCtrl",
    data : {
      authLevel: "admin"
    }
  })
  .state('edit_page', {
    templateUrl: base_url+'public/partials/pages/edit.html',
    url: '/pages/:p_id/edit',
    controller: "pagesCtrl",
    data : {
      authLevel: "admin"
    }
  })







  $urlRouterProvider.otherwise('/home');
});