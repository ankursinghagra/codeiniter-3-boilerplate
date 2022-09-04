<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->data=array();
		$this->load->library('common');		
		$this->data['user_data']=$this->session->userdata('admin_user');
	}
	public function all_user_data($email){
		$sql = $this->db->get_where("admin_users",array('admin_email'=>$email));
		return $sql->row_array();
	}
	public function all_view_permissions_of_current_group(){
		$sql=$this->db->get_where('admin_groups',array('admin_group_id'=>$this->data['user_data']['admin_group']));
		return json_decode($sql->row('view_permissions'));
	}
	public function all_modify_permissions_of_current_group(){
		$sql=$this->db->get_where('admin_groups',array('admin_group_id'=>$this->data['user_data']['admin_group']));
		return json_decode($sql->row('modify_permissions'));
	}
	public function modules(){
		$sql = $this->db->get('cms_modules');
		$array = array();
		foreach ($sql->result_array() as $key => $value) {
			$array[$value['module_slug']] = $value;
		}
		return $array;
	}
	public function login_checker(){
		if($this->session->has_userdata('admin_user')){
        	//session exists so 
        	//let it be
        	return true;
        }else{
        	//check if cookie exists 
			if($this->input->cookie('remember_me')){
				$cookie = $this->input->cookie('remember_me');
				//is cookie valid
				$sql_token=$this->db->query("SELECT * FROM admin_users WHERE admin_remember_me_token='".$cookie."' ");
				if($sql_token->num_rows()>0){
					//make session
					$this->load->model('loginfunctions');
					$this->loginfunctions->create_login_session($sql_token->row_array());
					//let it be
					$this->session->set_flashdata('message', alert('success','logged_in again'));
					redirect('login','refresh');
					return true;
				}else{
					//send to login
					return false;
	    		}
			}else{
				// cookie isnt set
				//send to login
				return false;
			}
        }
	}
	public function admin_hash_for_email_verification(){
		$code = $this->common->generateRandomString(32);
		$sql = $this->db->get_where('admin_users',array('admin_hash_for_email_verification'=>$code));
		if($sql->num_rows()>0){
			return $this->admin_hash_for_email_verification();
		}else{
			return $code;
		}
	}
	public function send_email_first_verification($data){

		$email_data = array();
		$email_data['preheader'] = 'Login to the admin panel';
		$email_data['html_array'] = array(
			array(
				'tag' => 'h2',
				'content' => 'Hello',
			),
			array(
				'tag' => 'p',
				'content' => 'Dear '.$data['admin_name'].', you are added to the admin panel of this website, please click the following link to create your password. if this link is not meant for you, please ignore this mail.',
			),
			array(
				'tag' => 'button',
				'url' => base_url().'login/verify_email/'.$data['admin_hash_for_email_verification'],
				'content' => 'Click Here to create password',
			),
			array(
				'tag' => 'p',
				'content' => 'Thank You',
			),
		);

		$HTML = $this->load->view('emails/default',$email_data,TRUE);
		return $this->common->send_email($data['admin_email'],$data['admin_name'],'Congrats! You are added to Admin',$HTML);
	}

	// input : $year = the year the month is in, eg 2010
	// input : $month = the month , eg 5 for may
	// input : $ignore = index of the day to ignore, eg 6 for sunday, 0 for monday
	public function calWorkingDays($year, $month,$ignore=array("Sun")) 
	{
	    $count = 0;
	    $day_count = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		for ($i = 1; $i <= $day_count; $i++) {

	        $date = $year.'/'.$month.'/'.$i; //format date
	        $get_name = date('l', strtotime($date)); //get week day
	        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

	        if(!in_array($day_name, $ignore)) {
	            $count++;
	        }

		}
	    return $count;
	}
}

/* End of file functions.php */
/* Location: ./application/models/functions.php */