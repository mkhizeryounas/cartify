<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Open extends REST_Controller {
	public function index_get() {
		$this->set_response(array(
			'status' => true,
			'message' => 'cartify is an eCommerce multi-tanent back-office software ~ powered by www.shopdesk.co'
		));
	}
	public function me_post() {
		if(authenticate()) { 
			$this->set_response(array('logged_in'=>true, 'store_key' => authenticate()['store_key']));
		}
		else {
			$this->set_response(array('logged_in'=>false));
		}
	}
	public function do_upload_post()
    {
        $config['upload_path']          = './files/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $data = array('status'=> false,'message'=>'Image upload fail', 'error' => $this->upload->display_errors());
            $this->set_response($data);
        }
        else {
            $ext = pathinfo($_FILES["image"]["name"])['extension'];
            $name=uniqid().".".$ext;
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $_FILES['image']['tmp_name'];
            $config2['new_image'] = $config['upload_path'].$name;
            $config2['maintain_ratio'] = TRUE;
            $config2['width']    = 400;
            $config2['height']   = 400;

            $this->load->library('image_lib');
            $this->image_lib->initialize($config2);
            if (!$this->image_lib->resize()) {
                $data = array('status'=> false,'message'=>'Image upload fail', 'error' => $this->image_lib->display_errors());
            }
            else {
                $data = array('status'=> true,'message'=>'Image uploaded successfully', 'upload_data' => $name);
            }
            unlink($this->upload->data()['full_path']);
            $this->set_response($data);
            $this->image_lib->clear();
        }
    }

}
