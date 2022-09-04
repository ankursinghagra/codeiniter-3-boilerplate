<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siteoptions extends CI_Controller {

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
		if(!isset($this->data['view_permissions']->siteoptions)){show_404();}
	}

	public function index()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/SiteOptions',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Site Options',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions','title'=>'Site Options','active'=>true,),
			),
		);
		$this->data['current_slug']='siteoptions';
		$this->common->layout('admin/siteoptions',$this->data);		
	}
	public function information()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/SiteOptions/Information',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Site Options',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions','title'=>'Site Options','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions/information','title'=>'Information','active'=>true,),
			),
		);
		if($this->input->post()){
			$this->form_validation->set_rules('site_name', 'site_name', 'trim|required');
			$this->form_validation->set_rules('address_1', 'address_1', 'trim');
			$this->form_validation->set_rules('address_2', 'address_2', 'trim');
			$this->form_validation->set_rules('phone_number', 'phone_number', 'trim');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['site_name'] = $this->input->post('site_name');
				$data_db['address_1'] = $this->input->post('address_1');
				$data_db['address_2'] = $this->input->post('address_2');
				$data_db['phone_number'] = $this->input->post('phone_number');

				$this->db->update('cms_options',$data_db);
				$this->session->set_flashdata('message',alert('success','Information Updated'));
				redirect(env('ADMIN_FOLDER').'/siteoptions/information/','refresh');
			}
		}

		$sql=$this->db->get_where('cms_options',array('id'=>1));
		$this->data['siteoptions']=$sql->row_array();
		$this->data['current_slug']='siteoptions_information';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/siteoptions_information',$this->data);		
	}
	public function settings()
	{
		$this->load->helper('directory');
		/*$this->data['list_dir'] = directory_map(APPPATH.'../../application/views/themes/', 1);
		foreach ($this->data['list_dir'] as $key => $value) {
			$this->data['list_dir'][$key] = str_replace('\\', '', $value);
		}*/

		$this->data['page_data']=array(
			'meta_title' => 'Admin/SiteOptions/Settings',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Site Options',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions','title'=>'Site Options','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions/settings','title'=>'Settings','active'=>true,),
			),
		);
		if($this->input->post()){
			//$this->form_validation->set_rules('theme_desktop', 'theme_desktop', 'trim|required');
			//$this->form_validation->set_rules('theme_mobile', 'theme_mobile', 'trim');
			$this->form_validation->set_rules('maintainence_mode', 'maintainence_mode', 'trim');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				/*$data_db['theme_desktop'] = $this->input->post('theme_desktop');
				$data_db['theme_mobile'] = $this->input->post('theme_mobile');*/
				$data_db['maintainence_mode'] = $this->input->post('maintainence_mode');

				$this->db->update('cms_options',$data_db);
				$this->session->set_flashdata('message',alert('success','Information Updated'));
				redirect(env('ADMIN_FOLDER').'/siteoptions/settings/','refresh');
			}
		}

		$sql=$this->db->get_where('cms_options',array('id'=>1));
		$this->data['siteoptions']=$sql->row_array();
		$this->data['current_slug']='siteoptions_settings';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/siteoptions_settings',$this->data);		
	}
	public function seo_settings()
	{

		$this->data['page_data']=array(
			'meta_title' => 'Admin/SiteOptions/SeoSettings',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Site Options',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions','title'=>'Site Options','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions/seo_settings','title'=>'Seo Settings','active'=>true,),
			),
		);
		if($this->input->post()){
			$this->form_validation->set_rules('maintainence_mode', 'maintainence_mode', 'trim');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['maintainence_mode'] = $this->input->post('maintainence_mode');

				$this->db->update('cms_options',$data_db);
				$this->session->set_flashdata('message',alert('success','Information Updated'));
				redirect(env('ADMIN_FOLDER').'/siteoptions/seo_settings/','refresh');
			}
		}

		$sql=$this->db->get_where('cms_options',array('id'=>1));
		$this->data['siteoptions']=$sql->row_array();
		$this->data['current_slug']='siteoptions_seosettings';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/siteoptions_seosettings',$this->data);		
	}
	public function email()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/SiteOptions/EmailOptions',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Site Options',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions','title'=>'Site Options','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions/email','title'=>'Email','active'=>true,),
			),
		);
		if($this->input->post()){
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('email_function', 'email_function', 'trim|required');
			$this->form_validation->set_rules('email_smtp_from', 'email_smtp_from', 'trim');
			$this->form_validation->set_rules('email_smtp_hostname', 'email_smtp_hostname', 'trim');
			$this->form_validation->set_rules('email_smtp_port', 'email_smtp_port', 'trim');
			$this->form_validation->set_rules('email_smtp_username', 'email_smtp_username', 'trim');
			$this->form_validation->set_rules('email_smtp_password', 'email_smtp_password', 'trim');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['email_function'] = $this->input->post('email_function');
				$data_db['email_smtp_from'] = $this->input->post('email_smtp_from');
				$data_db['email_smtp_hostname'] = $this->input->post('email_smtp_hostname');
				$data_db['email_smtp_port'] = $this->input->post('email_smtp_port');
				$data_db['email_smtp_username'] = $this->input->post('email_smtp_username');
				$data_db['email_smtp_password'] = $this->input->post('email_smtp_password');

				$this->db->update('cms_options',$data_db);
				$this->session->set_flashdata('message',alert('success','Information Updated'));
				redirect(env('ADMIN_FOLDER').'/siteoptions/email/','refresh');
			}
		}

		$sql=$this->db->get_where('cms_options',array('id'=>1));
		$this->data['siteoptions']=$sql->row_array();
		$this->data['current_slug']='siteoptions_email';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/siteoptions_email',$this->data);		
	}
	public function email_test(){
		$this->data['page_data']=array(
			'meta_title' => 'Admin/SiteOptions/EmailTest',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Site Options',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions','title'=>'Site Options','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/siteoptions/email','title'=>'Email','active'=>true,),
			),
		);
		if($this->input->post()){
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('test_email_to', 'test_email_to', 'trim|required');
			$this->form_validation->set_rules('test_email_subject', 'test_email_subject', 'trim|required');
			$this->form_validation->set_rules('test_email_body', 'test_email_body', 'trim|required');

			if ($this->form_validation->run() == TRUE) {

				$email_status = $this->common->send_email(
					$this->input->post('test_email_to'),
					'',
					$this->input->post('test_email_subject'),
					$this->input->post('test_email_body')
				);
				if($email_status){
					$this->session->set_flashdata('message',alert('success','Email Sent'));
				}else{
					$this->session->set_flashdata('message',alert('danger','Error Occured'));
				}
				redirect(env('ADMIN_FOLDER').'/siteoptions/email_test/','refresh');
			}
		}

		$this->data['current_slug']='siteoptions_email_test';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/siteoptions_email_test',$this->data);		
	}

}

/* End of file Siteoptions.php */
/* Location: ./application/controllers/Siteoptions.php */