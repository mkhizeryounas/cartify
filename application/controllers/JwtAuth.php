<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */

class JwtAuth extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function token_get()
    {
        $tokenData = array();
        $tokenData['ck'] = "ck_4189da7e73f7eaef2a40614875f1bb0b56dd27fb"; //TODO: Replace with data for token
        $tokenData['cs'] = "cs_5e1d3b8d055d1286b8555495821035e6b0a0d116"; //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function detoken_get()
    {
        $token = $this->input->get('token');

        if (!empty($token)) {
            $decodedToken = AUTHORIZATION::validateToken($token);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }
        // $headers = $this->input->request_headers();

        // if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        //     $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        //     if ($decodedToken != false) {
        //         $this->set_response($decodedToken, REST_Controller::HTTP_OK);
        //         return;
        //     }
        // }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}