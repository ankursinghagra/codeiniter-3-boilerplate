<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginfunctions extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Calcutta');
		$this->data=array();
		$this->data['cms_options']=$this->cms_options();
		/*if($this->agent->is_mobile()){
			$this->data['theme'] = $this->data['cms_options']['theme_mobile'];
		}else{
			$this->data['theme'] = $this->data['cms_options']['theme_desktop'];
		}*/
	}
	public function cms_options(){
        $sql=$this->db->get_where('cms_options',array('id'=>'1'));
        return $sql->row_array();
    }
    public function create_login_session($row){
		$array=array(
			'admin_user' => array(
	        	'admin_email'     	=> $row['admin_email'],
				'admin_name'		=> $row['admin_name'],
				'admin_group'		=> $row['admin_group'],
	        	'logged_in' 		=> TRUE
			)
		);
		return $this->session->set_userdata($array);
    }
    
    public function generate_remember_me_token(){
    	$token = $this->common->generateRandomString(32);
    	$sql = $this->db->get_where('admin_users',array('admin_remember_me_token'=>$token));
    	if($sql->num_rows()>0){
    		return $this->common->generate_remember_me_token();
    	}else{
    		return $token;
    	}
    }
    public function generate_reset_password_token(){
    	$token = $this->common->generateRandomString(32);
    	$sql = $this->db->get_where('admin_users',array('admin_hash_for_password_reset'=>$token));
    	if($sql->num_rows()>0){
    		return $this->common->generate_reset_password_token();
    	}else{
    		return $token;
    	}
    }

    public function send_email_password_reset($row,$code)
    {
        $email_data = array();
        $email_data['preheader'] = 'Password Reset Link';
        $email_data['html_array'] = array(
            array(
                'tag' => 'h2',
                'content' => 'Hello',
            ),
            array(
                'tag' => 'p',
                'content' => 'Dear '.$row['admin_name'].', You have requested to reset your password . If you didnt requested this, please ignore this mail.',
            ),
            array(
                'tag' => 'button',
                'url' => base_url().'login/reset_password/'.$row['admin_hash_for_password_reset'],
                'content' => 'Click Here to Change Password',
            ),
            array(
                'tag' => 'p',
                'content' => 'Thank You',
            ),
        );

        $HTML = $this->load->view('emails/default',$email_data,TRUE);
        return $this->common->send_email($row['admin_email'],$row['admin_name'],'Password Reset Request',$HTML);
    }

}

/* End of file Loginfunctions.php */
/* Location: ./application/models/Loginfunctions.php */