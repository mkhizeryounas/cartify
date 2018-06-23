<?php

function pwd($s) {
	return sha1($s.'ff4a930256fc215f4a7ab126df868494');
}

function authenticate() {
	if(isset($_SESSION['shopdesk']) && $_SESSION['shopdesk']['logged_in'] == true) {
		return $_SESSION['shopdesk'];
	}
	else {
		return false;
	}
}
function token($full_object = false, $passed_token = null) {	
	$headers = getallheaders();
    if ((array_key_exists('Public-Key', $headers) && !empty($headers['Public-Key'])) || $passed_token != null) {
        $public_key = isset($headers['Public-Key']) ? $headers['Public-Key'] : $passed_token;
        if($full_object) {
            // Return full store object;
            $ci =& get_instance();
            $ci->load->database();
            $store = $ci->db->query("SELECT `store_id`, `store_name`, `store_email`, `store_password`, `store_key`, `store_full_name`, `store_shipping_int`, `store_shipping_int_first`, `store_shipping_int_each` FROM `stores` WHERE store_key = ?", [$public_key])->row_array();
            if(count($store) == 0) {
                return false;
            }
            else {
                return $store;
            }
        }
        else {
            return $public_key;
        }
    }
    else {
    	return false;
    }
}
if (!function_exists('getallheaders'))  {
    function getallheaders()
    {
        if (!is_array($_SERVER)) {
            return array();
        }

        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

function auth_error() {
	return $auth_error = array(
		'status' => false,
		'message' => 'Authentication failed'
	);
}

function pagination($arr,$page,$limit) {
    $offset = ($page-1)*$limit;
    $res = array();
    $res['page']['pageNumber'] = (int)$page;
    $res['page']['numberOfElements'] = $limit;
    $res['page']['totalElements'] = count($arr);
    $res['page']['totalPages']=ceil($res['page']['totalElements']/$limit);
    $res['data']=array_slice($arr,$offset,$limit);
    return $res;
}