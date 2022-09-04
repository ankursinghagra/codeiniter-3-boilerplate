<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('bootstrap');
		$this->load->model('loginfunctions');
		$this->data['site_name']=$this->config->item('site_name');
		$this->data['main_url']=$this->config->item('main_url');
		//$this->data['folder']=$this->config->item('folder');
	}

	public function index()
	{
		if ($this->input->post()) {
			$password = $this->input->post('password');
			$email=$this->input->post('email');
			$sql_query="SELECT * FROM admin_users WHERE admin_email='".$email."' AND admin_password='".md5($password)."' LIMIT 1 ";
			$sql=$this->db->query($sql_query);
			if($sql->num_rows()>0){
				$row=$sql->row_array();
				$this->loginfunctions->create_login_session($row);
				if($this->input->post('remember_me')){
					$token = $this->loginfunctions->generate_remember_me_token();
					$cookie = array(
					    'name'   => 'remember_me',
					    'value'  => $token,
					    'expire' => 86500,
					    'domain' => parse_url(base_url(),PHP_URL_HOST),
					    'path'   => '/',
					    'prefix' => '',
					    'secure' => false
					);
					$this->input->set_cookie($cookie);
					$this->db->update('admin_users',array('admin_remember_me_token'=>$token),array('admin_email'=>$row['admin_email']));
				}
				if($this->input->get('redirect')){
					redirect($this->input->get('redirect'),'refresh');
				}else{
					redirect(env('ADMIN_FOLDER').'/dashboard','refresh');
				}
			}else{
				$this->session->set_flashdata('message', alert('danger','invalid login credentials'));
				if($this->input->get('redirect')){
					redirect(env('ADMIN_FOLDER').'/login?redirect='.$this->input->get('redirect'),'refresh');
				}else{
					redirect(env('ADMIN_FOLDER').'/login','refresh');
				}
			}			
		}
		$this->data['message'] = $this->session->flashdata('message');
		$this->load->view('login',$this->data);
	}
	
	public function logout(){
		unset($_SESSION['admin_user']);
		delete_cookie('remember_me');
		redirect(env('ADMIN_FOLDER').'/login','refresh');
	}

	public function forget_password($step=1){

		if($step==1){
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('email', 'Email Address', 'required');
			if ($this->form_validation->run() == TRUE) {

				$sql = $this->db->get_where('admin_users',array('admin_email'=>$this->input->post('email')));
				if($sql->num_rows()>0){

					$token = $this->loginfunctions->generate_reset_password_token();

					if($this->db->update('admin_users',array('admin_hash_for_password_reset'=>$token),array('admin_email'=>$this->input->post('email')))){   
						$this->loginfunctions->send_email_password_reset($sql->row_array(),$token);
						redirect(env('ADMIN_FOLDER').'/login/forget_password/2','refresh');
					}else{
						$this->session->set_flashdata('message',alert('error','Error Occured'));
						redirect(env('ADMIN_FOLDER').'admin/login/forget_password','refresh');
					}
				}
			}

			$this->data['message']=$this->session->flashdata('message');
			$this->load->view('login/forget_password',$this->data);

		}elseif($step==2){

			$this->data['message']=$this->session->flashdata('message');
			$this->load->view('login/forget_password_success',$this->data);
		}else{
			show_error(404);
		}

	}
	public function reset_password($code=null)
	{
		$code = $this->security->xss_clean($code);
		$sql = $this->db->get_where('admin_users',array('admin_hash_for_password_reset'=>$code));
		if($sql->num_rows()>0){
			//link is valid
			$this->data['user'] = $sql->row_array(); 

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password]');
			if ($this->form_validation->run() == TRUE) {

				$password = md5($this->input->post('password'));

				if($this->db->update('admin_users',array('admin_password'=>$password,'admin_email_verified'=>'1'),array('admin_id'=>$this->data['user']['admin_id']))){

					$this->load->model('loginfunctions');
					$this->loginfunctions->create_login_session($this->data['user']);
					$this->session->set_flashdata('message',alert('success','Login Successful'));
					redirect(env('ADMIN_FOLDER').'/dashboard','refresh');
				}else{
					$this->session->set_flashdata('message',alert('error','Error Occured'));
					redirect(env('ADMIN_FOLDER').'/login/reset_password/'.$code,'refresh');
				}
			}

			$this->data['message']=$this->session->flashdata('message');
			$this->load->view('login/verify_email_password',$this->data);
		}else{
			show_error('Link Expired');
		}
	}
	public function verify_email($code=null){
		$code = $this->security->xss_clean($code);
		$sql = $this->db->get_where('admin_users',array('admin_hash_for_email_verification'=>$code,'admin_email_verified'=>'0'));
		if($sql->num_rows()>0){
			//link is valid
			$this->data['user'] = $sql->row_array(); 

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password]');
			if ($this->form_validation->run() == TRUE) {

				$password = md5($this->input->post('password'));

				if($this->db->update('admin_users',array('admin_password'=>$password,'admin_email_verified'=>'1'),array('admin_id'=>$this->data['user']['admin_id']))){

					$this->load->model('loginfunctions');
					$this->loginfunctions->create_login_session($this->data['user']);
					$this->session->set_flashdata('message',alert('success','Login Successful'));
					redirect(env('ADMIN_FOLDER').'/dashboard','refresh');
				}else{
					$this->session->set_flashdata('message',alert('error','Error Occured'));
					redirect(env('ADMIN_FOLDER').'/login/verify_email/'.$code,'refresh');
				}
			}

			$this->data['message']=$this->session->flashdata('message');
			$this->load->view('login/verify_email_password',$this->data);
		}else{
			show_error('Link Expired');
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */