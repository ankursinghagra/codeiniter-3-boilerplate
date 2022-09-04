<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		if(!isset($this->data['view_permissions']->users)){show_404();}
		echo $this->config->item('root_dir');
	}
	public function index(){
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Users',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Users',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users','title'=>'Users','active'=>true,),
			),
		);
		$this->data['current_slug']='users';
		$this->common->layout('admin/users',$this->data);		
	}
	public function add_user()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Users/AddUser',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Users',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users','title'=>'Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/all_users','title'=>'All Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/add_user','title'=>'Add User','active'=>true,),
			),
		);

		if ($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('admin_name', 'Admin Name', 'trim|required');
			$this->form_validation->set_rules('admin_email', 'Admin Email', 'trim|valid_email|is_unique[admin_users.admin_email]|required');
			$this->form_validation->set_rules('password', 'Password', '');
			//$this->form_validation->set_rules('password2', 'Repeat Password', 'matches[password]');
			$this->form_validation->set_rules('admin_group', 'Group', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['admin_name'] = $this->input->post('admin_name');
				$data_db['admin_email'] = $this->input->post('admin_email');
				if($this->input->post('password')){
					$data_db['admin_password']=md5($this->input->post('password'));
				}
				if($this->input->post('file_name')){
					$data_db['admin_photo'] = $this->common->upload_photo('admins/');
				}
				$data_db['admin_group'] = $this->input->post('admin_group');
				$data_db['author_name'] = $this->input->post('author_name');
				$data_db['author_short_description'] = $this->input->post('author_short_description');
				$data_db['author_facebook_link'] = $this->input->post('author_facebook_link');
				$data_db['author_twitter_link'] = $this->input->post('author_twitter_link');

				$data_db['admin_hash_for_email_verification'] = $this->functions->admin_hash_for_email_verification();
				
				if ($this->db->insert('admin_users',$data_db)) {

					$this->functions->send_email_first_verification($data_db);
					$this->session->set_flashdata('message',alert('success','User Added'));
					redirect(env('ADMIN_FOLDER').'/users/all_users/','refresh');
				}else{
					$this->session->set_flashdata('message',alert('error','Error Occured'));
					redirect(env('ADMIN_FOLDER').'/users/all_users/','refresh');
				}
			}
		}
		$sql = $this->db->query("SELECT * FROM admin_groups WHERE admin_group_id>'".($this->data['user_data']['admin_group']-1)."' ");
		$this->data['possible_admin_groups']=$sql->result_array();

		$this->data['cropping_ratio']=1/1;
		$this->data['current_slug']='add_user';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/users_add_user',$this->data);		
	}
	public function edit_user($id){

		$sql = $this->db->query("SELECT * FROM admin_users WHERE admin_id=$id LIMIT 1 ");
		$this->data['user'] = $sql->row_array();

		//if its your profile
		if ($this->data['user_data']['admin_id'] == $id){
			redirect(env('ADMIN_FOLDER').'/profile','refresh');
		}

		//if admin group is lesser than yours		
		if(	($this->data['user_data']['admin_group'] > $this->data['user']['admin_group']) ){
			show_error('You dont have enough permission.');
		}

		$this->data['page_data']=array(
			'meta_title' => 'Admin/Users/EditUsers',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Users',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users','title'=>'Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/all_users','title'=>'All Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/edit_user','title'=>'Edit User','active'=>true,),
			),
		);		

		if ($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('admin_name', 'Admin Name', 'trim|required');
			if($this->input->post('password')||$this->input->post('password2')){
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password]');
			}
			$this->form_validation->set_rules('admin_group', 'Group', 'trim|required');

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
				$data_db['admin_group'] = $this->input->post('admin_group');
				$data_db['author_name'] = $this->input->post('author_name');
				$data_db['author_short_description'] = $this->input->post('author_short_description');
				$data_db['author_facebook_link'] = $this->input->post('author_facebook_link');
				$data_db['author_twitter_link'] = $this->input->post('author_twitter_link');
			}
			if (($this->form_validation->run() == TRUE)&&($this->db->update('admin_users',$data_db,array('admin_id'=>$id)))) {
				$this->session->set_flashdata('message',alert('success','Information Updated'));
				redirect(env('ADMIN_FOLDER').'/users/edit_user/'.$id,'refresh');
			} else {
				$this->session->set_flashdata('message',alert('danger','Error Updating'));
				redirect(env('ADMIN_FOLDER').'/users/edit_user/'.$id,'refresh');
			}
		}

		$sql = $this->db->query("SELECT * FROM admin_users WHERE admin_id=$id LIMIT 1 ");
		$this->data['user'] = $sql->row_array();

		//possible admin_groups
		$sql = $this->db->query("SELECT * FROM admin_groups WHERE admin_group_id>'".($this->data['user_data']['admin_group']-1)."' ");
		$this->data['possible_admin_groups']=$sql->result_array();


		$this->data['cropping_ratio']=1/1;
		/**/
		$this->data['message']=$this->session->flashdata('message');
		$this->data['current_slug']='edit_user';
		$this->common->layout('users_edit_user',$this->data);		
	}
	public function all_users(){
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Users/AllUsers',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Users',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users','title'=>'Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/all_users','title'=>'All Users','active'=>true,),
			),
		);
		/**/
		$sql = $this->db->query("
			SELECT * FROM admin_users AS A 
			JOIN admin_groups AS G 
			ON A.admin_group = G.admin_group_id 
			ORDER BY admin_group ASC, admin_id ASC");
		$this->data['all_users'] = $sql->result_array();
		/**/
		$this->data['current_slug']='all_users';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/users_all_users',$this->data);		
	}
	public function add_group(){
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Users/AddGroup',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Users',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users','title'=>'Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/all_groups','title'=>'All Groups','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/add_group','title'=>'Add Group','active'=>true,),
			),
		);

		if ($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('group_name', 'Group Name', 'trim|is_unique[admin_groups.group_name]|required');
			$this->form_validation->set_rules('group_color', 'Group Color', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['group_name'] = $this->input->post('group_name');
				$data_db['group_color'] = $this->input->post('group_color');
			}
			if (($this->form_validation->run() == TRUE)&&($this->db->insert('admin_groups',$data_db))) {
				$this->session->set_flashdata('message',alert('success','Group Added'));
				redirect(env('ADMIN_FOLDER').'/users/all_groups/','refresh');
			}
		}

		$this->data['cropping_ratio']=1/1;
		$this->data['current_slug']='add_user';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/users_add_group',$this->data);	
	}
	public function edit_group($id){
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Users/EditGroup',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Users',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users','title'=>'Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/all_groups','title'=>'All Groups','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/edit_group','title'=>'Edit Group','active'=>true,),
			),
		);
		/**/

		if ($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required');
			$this->form_validation->set_rules('group_color', 'Group Color', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['group_name'] = $this->input->post('group_name');
				$data_db['group_color'] = $this->input->post('group_color');
			}
			if (($this->form_validation->run() == TRUE)&&($this->db->update('admin_groups',$data_db,array('admin_group_id'=>$id)))) {
				$this->session->set_flashdata('message',alert('success','Information Updated'));
				redirect(env('ADMIN_FOLDER').'users/edit_group/'.$id,'refresh');
			}
		}

		$sql = $this->db->query("SELECT * FROM admin_groups WHERE admin_group_id=$id LIMIT 1 ");
		$this->data['group'] = $sql->row_array();

		/**/
		$this->data['current_slug']='edit_group';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/users_edit_group',$this->data);	
	}
	public function all_groups(){
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Users/Groups',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Users',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users','title'=>'Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/all_groups','title'=>'User Groups','active'=>true,),
			),
		);
		/**/
		$sql = $this->db->query("SELECT * FROM admin_groups WHERE admin_group_id!=1 ORDER BY admin_group_id ASC");
		$this->data['all_groups'] = $sql->result_array();
		/**/
		$this->data['current_slug']='all_groups';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/users_all_groups',$this->data);
	}
	public function permissions(){
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Users/Permissions',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Users',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users','title'=>'Users','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/users/permissions','title'=>'Users Permissions','active'=>true,),
			),
		);
		/**/
		$sql=$this->db->query("SELECT * FROM admin_groups WHERE admin_group_id='".$this->data['user_data']['admin_group']."' ");
		$group = $sql->row_array();

		$this->data['universal_permissions'] = $this->config->item('default_permissions');

		if( ($this->data['user_data']['admin_group']==1)||$this->data['user_data']['admin_id']==1 ){
			$this->data['default_view_permissions'] = $this->config->item('default_permissions');
			$this->data['default_modify_permissions'] = $this->config->item('default_permissions');
			$sql=$this->db->query("SELECT * FROM admin_groups ORDER BY admin_group_id ASC");	
		}else{
			$this->data['default_view_permissions'] = json_decode($group['view_permissions'],TRUE);
			$this->data['default_modify_permissions'] = json_decode($group['modify_permissions'],TRUE);
			foreach ($this->data['default_view_permissions'] as $key => $value) {
				if(isset($this->data['universal_permissions'][$key])){
					$this->data['default_view_permissions'][$key]=$this->data['universal_permissions'][$key];
				}
			}
			foreach ($this->data['default_modify_permissions'] as $key => $value) {
				if(isset($this->data['universal_permissions'][$key])){
					$this->data['default_modify_permissions'][$key]=$this->data['universal_permissions'][$key];
				}
			}
			$sql=$this->db->query("SELECT * FROM admin_groups WHERE `admin_group_id`>'".$this->data['user_data']['admin_group']."' ORDER BY admin_group_id ASC");	
		}
		$this->data['user_groups'] = $sql->result_array();
		/**/
		$this->data['current_slug']='users_permissions';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/users_permissions',$this->data);		
	}
	public function api_permissions(){
		$this->data['universal_permissions'] = $this->config->item('default_permissions');
		if( ($this->data['user_data']['admin_group']==1)||$this->data['user_data']['admin_id']==1 ){
			$this->data['default_view_permissions'] = $this->config->item('default_permissions');
			$this->data['default_modify_permissions'] = $this->config->item('default_permissions');	
		}else{
			$this->data['default_view_permissions'] = json_decode($group['view_permissions'],TRUE);
			$this->data['default_modify_permissions'] = json_decode($group['modify_permissions'],TRUE);
			foreach ($this->data['default_view_permissions'] as $key => $value) {
				if(isset($this->data['universal_permissions'][$key])){
					$this->data['default_view_permissions'][$key]=$this->data['universal_permissions'][$key];
				}
			}
			foreach ($this->data['default_modify_permissions'] as $key => $value) {
				if(isset($this->data['universal_permissions'][$key])){
					$this->data['default_modify_permissions'][$key]=$this->data['universal_permissions'][$key];
				}
			}	
		}
		header('Content-type: application/json');
		$response = array();
		$change=false;

		$checked = $this->input->post('checked');
		$permission_text = $this->input->post('permission_text');
		$type = $this->input->post('type');
		$group_id = $this->input->post('group_id');

		//echo json_encode(array("checked"=>$checked,"permission_text"=>$permission_text,"type"=>$type,"group_id"=>$group_id));exit();

		$sql = $this->db->query("SELECT ".$type." FROM admin_groups WHERE admin_group_id=".$group_id." ");
		$row=$sql->row_array();

		$permissions = json_decode($row[$type],TRUE);

		if(isset($checked)&&($checked=='true')){
			if($type == 'view_permissions'){
				if(isset($this->data['default_view_permissions'][$permission_text])){
					$change=true;
				}else{
					$change=false;
					$response['message'] = "You dont have permission to change this.";
				}
			}else{
				if(isset($this->data['default_modify_permissions'][$permission_text])){
					$change=true;
				}else{
					$change=false;
					$response['message'] = "You dont have permission to change this.";
				}
			}
			$permissions[$permission_text] = true;
		}else{
			unset($permissions[$permission_text]);
		}
		if(isset($this->data['modify_permissions']->permissions)&&($this->data['modify_permissions']->permissions)){
		}else{
			$change=false;
			$response['message'] = "You dont have permission to change this.";
		}
		if(true){
			$sql = $this->db->query("UPDATE admin_groups SET ".$type."='".(json_encode($permissions))."' WHERE admin_group_id=".$group_id." ");
		}
		if($sql){$change=true;}else{$change=false;$response['message'] = "DB Connect Error";}

		if($change){
			$response['status'] = 'success';
			$response['title'] = 'Saved';
			if(isset($checked)&&($checked=='true')){
				$response['message'] = "Permission is Added";
			}else{
				$response['message'] = "Permission is Removed";
			}
		}else{
			$response['status'] = 'danger';
			$response['title'] = 'Error';
			$response['message'] = "Error Updating Permissions";
		}

		echo json_encode($response);
	}
	public function api_delete_user(){
		header('Content-type: application/json');
		$response = array();

		if(isset($this->data['modify_permissions']->users)&&($this->data['modify_permissions']->users)){

			if($this->input->post('id')){

				$this->db->delete('admin_users',array('admin_id'=>$this->input->post('id')));
			
				$response['status'] = 'success';
				$response['title'] = 'Deleted';
				$response['message'] = "User is Deleted";
			}else{
				$response['status'] = 'failure';
				$response['title'] = 'Deleted';
				$response['message'] = "User is Deleted";
			}


		}else{
			$response['status'] = 'failure';
			$response['title'] = 'Error';
			$response['message'] = "Error Deleting User";
		}

		

		echo json_encode($response);
	}
	public function api_delete_group(){
		header('Content-type: application/json');
		$response = array();

		if(isset($this->data['modify_permissions']->groups)&&($this->data['modify_permissions']->groups)){

			if($this->input->post('id')){

				$sql = $this->db->query("SELECT * FROM admin_users WHERE admin_group='".$this->input->post('id')."' ");
				if($sql->num_rows()>0){
					$response['status'] = 'failure';
					$response['title'] = 'Error';
					$response['message'] = "There are existing users in this group. Delete them first.";
				}else{
					$this->db->delete('admin_groups',array('admin_group_id'=>$this->input->post('id')));
					$response['status'] = 'success';
					$response['title'] = 'Deleted';
					$response['message'] = "Group is Deleted";
				}
			
			}else{
				$response['status'] = 'failure';
				$response['title'] = 'Error';
				$response['message'] = "Error Deleting Group";
			}


		}else{
			$response['status'] = 'failure';
			$response['title'] = 'Error';
			$response['message'] = "Error Deleting Group";
		}

		

		echo json_encode($response);
	}
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */