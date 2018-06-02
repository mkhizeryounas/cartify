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
function token() {	
	$headers = getallheaders();
    if (array_key_exists('Public-Key', $headers) && !empty($headers['Public-Key'])) {
    	return $headers['Public-Key'];
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