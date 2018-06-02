<?php

	if(!function_exists('site_var')) {
		function site_var($desc=NULL) {
			$var = array();
			$var['name'] = "Sehar Atif";
			$var['logo'] = "sa.png";
			$var['seo_description'] = "Sahar Atif";
			if($desc!=NULL)
				$var['seo_description'] = $desc;
			return $var;
		}

	}
	if(!function_exists('get_key')) {
		function get_key() {
			return "640a063a243c4cd741b4a4df045a9198";
		}

	}
	if(!function_exists('img_config')) {
		function img_config($type, $hw) {
			if($type == 'cover') {
				if($hw=='w') {
					return 800;
				}
				if($hw=='h') {
					// return 1200;
					return 992;
				}
			}
			if($type == 'thumb') {
				if($hw=='w') {
					return 450;
				}
				if($hw=='h') {
					// return 675;
					return 558;
				}
			}

		}
	}
	if(!function_exists('get_cred')) {
		function get_cred() {
			return array(
				'username'=>'admin',
				'pwd'=>'admin',
			);
		}
	}
	if(!function_exists('get_skin')) {
		function get_skin() {
			return 'leaf';
		}
	}
	if(!function_exists('no_admin')) {
		function no_admin() {
			//return 'shopdesk';
			redirect('auth/signin');
		}
	}
	if(!function_exists('admin_status')) {
		function admin_status() {
			if(isset($_SESSION['admin_signin_status']))
				return true;
			else
				return false;
		}
	}
	if(!function_exists('pwd')) {
		function pwd($p) {
			return md5(get_key().$p);
		}
	}
	if(!function_exists('get_currency')) {
		function get_currency($c) {
			return (new NumberFormatter('en_'.$c, NumberFormatter::CURRENCY))->getTextAttribute(NumberFormatter::CURRENCY_CODE);
		}
	}
	if(!function_exists('set_str')) {
		function set_str($s) {
			return ucfirst(strtolower($s));
		}
	}
	