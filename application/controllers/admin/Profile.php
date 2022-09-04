<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('bootstrap');
		$this->data['site_name']=$this->config->item('site_name');
		$this->data['main_url']=$this->config->item('main_url');
		//$this->data['folder']=$this->config->item('folder');
		$this->data['cms_options']=$this->common->cms_options();
		$this->data['modules']=$this->functions->modules();

		if($this->functions->login_checker()){
			$this->data['user_data']=$this->session->userdata('admin_user');
			$this->data['user_data']=$this->functions->all_user_data($this->data['user_data']['admin_email']);
			$this->data['view_permissions']=$this->functions->all_view_permissions_of_current_group();
			$this->data['modify_permissions']=$this->functions->all_modify_permissions_of_current_group();
		}else{
			redirect(env('ADMIN_FOLDER').'/login?redirect='.base_url(uri_string()) ,'refresh');
		}
	}

	public function index()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Profile',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Profile',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/profile','title'=>'Profile','active'=>true,),
			),
		);

		$sql = $this->db->query("SELECT * FROM admin_users WHERE admin_id=".$this->data['user_data']['admin_id']." LIMIT 1 ");
		$this->data['user'] = $sql->row_array();

		if ($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('admin_name', 'Admin Name', 'trim|required');
			if($this->input->post('password')||$this->input->post('password2')){
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password]');
			}
			//$this->form_validation->set_rules('admin_group', 'Group', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['admin_name'] = $this->input->post('admin_name');
				//$admin_email = $this->input->post('admin_email');
				if($this->input->post('password')){
					$data_db['admin_password']=md5($this->input->post('password'));
				}
				//$admin_photo = $this->input->post('admin_photo');
				if($this->input->post('file_name')){
					$data_db['admin_photo'] = $this->common->upload_photo('admins/');
				}
				//$data_db['admin_group'] = $this->input->post('admin_group');
				$data_db['author_name'] = $this->input->post('author_name');
				$data_db['author_short_description'] = $this->input->post('author_short_description');
				$data_db['author_facebook_link'] = $this->input->post('author_facebook_link');
				$data_db['author_twitter_link'] = $this->input->post('author_twitter_link');

				if ($this->db->update('admin_users',$data_db,array('admin_id'=>$this->data['user_data']['admin_id']))) {
					$this->session->set_flashdata('message',alert('success','Information Updated'));
					redirect(env('ADMIN_FOLDER').'/profile','refresh');
				} else {
					$this->session->set_flashdata('message',alert('danger','Error Updating'));
					redirect(env('ADMIN_FOLDER').'/profile','refresh');
				}
			}
		}

		$sql = $this->db->query("SELECT * FROM admin_users WHERE admin_id=".$this->data['user_data']['admin_id']." LIMIT 1 ");
		$this->data['user'] = $sql->row_array();

		//possible admin_groups
		$sql = $this->db->query("SELECT * FROM admin_groups WHERE admin_group_id>'".($this->data['user_data']['admin_group']-1)."' ");
		$this->data['possible_admin_groups']=$sql->result_array();

		$this->data['cropping_ratio']=1/1;

		$this->data['message']=$this->session->flashdata('message');
		$this->data['current_slug']='profile';
		$this->common->layout('admin/profile',$this->data);		
	}
}

/* End of file Siteoptions.php */
/* Location: ./application/controllers/Siteoptions.php */