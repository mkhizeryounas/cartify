var Cartify = function(pk=null) {
	if(pk==null) return false;
	// var base_url = "http://cartify.shopdesk.co/";
	var base_url = "http://localhost:8888/cartify/";
	var data = {};
	var public_key = pk;
	var token = {"Public-Key" : public_key};
	var var_check = function (v) {
	  if(typeof v !== "undefined" && v !== "" && v !== null)
	    return true;
	  else 
	    return false;
	}
	function guid() {
		function s4() {
		  return Math.floor((1 + Math.random()) * 0x10000)
			.toString(16)
			.substring(1);
		}
		return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
	}
	data.cart = [];
	var getCartId = () => {
		let id = "";
		if(!var_check(window.localStorage.getItem('cartify-cart_id'))) {
			id = guid();
			window.localStorage.setItem('cartify-cart_id', JSON.stringify(id));
		}
		else {
			id = window.localStorage.getItem('cartify-cart_id');
		}
		return id;
	}
	var getCart = function() {
		var cart = [];
		getCartId();
		if(!var_check(window.localStorage.getItem('cartify-cart'))) {
			window.localStorage.setItem('cartify-cart', JSON.stringify(cart));
		}
		cart = JSON.parse(window.localStorage.getItem('cartify-cart'));
		return cart;
	}
	var saveCart = function(cart) {
		window.localStorage.setItem('cartify-cart', JSON.stringify(cart));
		return getCart();
	}
	data.cart = getCart();
	
	data.categories = function() {
		return $.ajax({
			type:"GET",
			url: base_url+"categories/all",
			headers: token,
			data: {

			}
		});
	}
	data.single_category = function(id) {
		return $.ajax({
			type:"GET",
			url: base_url+"categories/get",
			headers: token,
			data: {
				id: id
			}
		});
	}
	data.products = function() {
		return $.ajax({
			type:"GET",
			url: base_url+"products/all",
			headers: token,
			data: {

			}
		});
	}
	data.single_product = function(id) {
		return $.ajax({
			type:"GET",
			url: base_url+"products/get",
			headers: token,
			data: {
				id: id
			}
		});
	}
	data.collections = function() {
		return $.ajax({
			type:"GET",
			url: base_url+"collections/all",
			headers: token,
			data: {

			}
		});
	}
	data.single_collection = function(id) {
		return $.ajax({
			type:"GET",
			url: base_url+"collections/get",
			headers: token,
			data: {
				id: id
			}
		});
	}
	data.addToCart = function(id) {
		return data.single_product(id)
		.then(function(res) {
			var res2 ={};
			if(res.status==true) {
				if(res.product.publish == true) {
					if(res.product.track_inventory==false || res.product.quantity > 0) {
						var existsCheck=false;
						$.each(data.cart, function(k,v) {
							if(v.id==id) {
								existsCheck=true;
								data.cart[k].qty++;
							}
						});
						if(existsCheck==false) {
							var cp = {};
							cp.name = res.product.name;
							cp.price = res.product.price;
							cp.id = res.product.id;
							cp.sku = res.product.sku;
							cp.qty=1;
							if(var_check(res.product.images[0]))
								cp.image = res.product.images[0];
							else 
								cp.image = "";
							data.cart.push(cp);
							// console.log(data.cart);
						}
						res2.status=true;
						res2.message="Product added to cart";
						saveCart(data.cart);
					}
					else {
						res2.status=false;
						res2.message="Product out of stock";
					}
				}
				else {
					res2.status=false;
					res2.message="Product not published";
				}
			}
			else {
				res2.status=false;
				res2.message="Something went wrong";
			}
			var d = $.Deferred();
	     	d.resolve(res2);
	     	return d;
		});
	}
	data.getCart=function() {
		var res = {};
		res.items = data.cart;
		var total = 0;
		$.each(res.items, function(k,v) {
			total += v.qty*v.price;
		});
		res.total = total;
		res.totalItems = res.items.length;
		var d=$.Deferred();
		d.resolve(res);
		return d;
	}
	data.removeFromCart=function(id) {
		// debugger;
		$.each(data.cart, function(k,v) {
			if(v.id==id) {
				data.cart.splice(k, 1);
				console.log(data.cart);
				return false;
			}
		})
		saveCart(data.cart);
		res = {
			status:true,
			message: "Removed from cart"
		};
		var d=$.Deferred();
		d.resolve(res);
		return d;
	}

	// CUSTOMER ENDPOINTS
	data.customer = Object();
	data.customer.login = (email, password) => {
		return $.ajax({
			type:"post",
			url: base_url+"customers/login",
			headers: token,
			data: {
				email,
				password
			}
		});
	}

	data.checkout = () => {
		var d=$.Deferred();
		var res = Object();
		if(!data.cart.length>0) {
			res = {
				status : false,
				message: "Cart is empty"
			}
			d.resolve(res);
		}
		else {
			let products = Array();
			data.cart.forEach(e => {
				products.push({
					id: e.id,
					qty: e.qty
				});
			})
			let data = {
				cart_id : getCartId(),
				products : products
			}
			d.resolve(data);
		}
		return d;
	}
	return data;
}