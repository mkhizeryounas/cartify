<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
	public function index()	{
		$auth_data = authenticate();
		if($auth_data) {
			$this->load->view('app/index', $auth_data);
		}
		else {
			redirect('app/login');
		}
		$auth_data = authenticate();
		
	}
	public function logout() {
		unset($_SESSION['shopdesk']);
		redirect('app/login');
	}
	public function login() {
		$auth_data = authenticate();
		if($auth_data) {
			redirect('app');
			return;
		}
		$this->load->model('auth_model');
		$data['title'] = 'Log in';
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');
		if($this->form_validation->run()) {
			$res = $this->auth_model->login($this->input->post('email'), $this->input->post('pwd'));
			if($res) {
				$res['logged_in'] = true;
				$this->session->set_userdata('shopdesk', $res);
				redirect('app');
				return;
			}
			else {
				$this->session->set_flashdata('error_pwd', '<div class="alert alert-danger"><b>ERROR!</b> Invalid credentials</div>');
			}
		}
		$this->load->view('auth/login', $data);
	}
	public function signup() {
		$auth_data = authenticate();
		if($auth_data) {
			redirect('app');
			return;
		}
		$this->load->model('auth_model');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('store', 'Store', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');
		$this->form_validation->set_rules('repwd', 'Re-type Password', 'trim|required');
		$pwd_ch = true;
		$store_ch = true;
		$err = array();
		if($this->input->post('pwd') != $this->input->post('repwd')) {
			$pwd_ch = false;
			$this->session->set_flashdata('error_pwd', '<div class="alert alert-danger"><b>ERROR!</b> Password does not match</div>');
		}
		else if($this->input->post('email')) {
			$res = $this->auth_model->check_store($this->input->post('email'));
			if(count($res)>0) {
				$this->session->set_flashdata('error_pwd', '<div class="alert alert-danger"><b>ERROR!</b> Email already exists</div>');
				$store_ch = false;
			}			
		}
		if($this->form_validation->run() && $pwd_ch && $store_ch) {
			// echo 'run';
			$req = array (
				'store_full_name' => $this->input->post('name'),
				'store_name' => $this->input->post('store'),
				'store_email' => $this->input->post('email'),
				'store_password' => pwd($this->input->post('pwd')),
				'store_key' => "PK_".pwd(uniqid())
			);
			$this->auth_model->new_store($req);
			$this->session->set_flashdata('new_store', '<div class="alert alert-success"><b>SUCCESS!</b> Account created, please login</div>');
			redirect('app/login');
		}
		else {
			$data['title'] = 'Sign up';
			$this->load->view('auth/signup', $data);
		}
	}

}
