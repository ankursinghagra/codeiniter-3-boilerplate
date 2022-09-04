<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data = array();

	}
	public function add_message()
	{
	    $_POST = json_decode(file_get_contents('php://input'),true); 
		$response = array('status'=>false, );
		if($this->input->post('message') && $this->input->post('phone_number')){
			$message = $this->input->post('message');
			$phone_number = $this->input->post('phone_number');

			if($this->db->insert('messages',array('message'=>$message,'phone_number'=>$phone_number))){
				$response['status'] = true;
				$response['message'] = 'record_inserted';
			}else{
				$response['status'] = false;
				$response['message'] = 'db_query_error';
			}
		}
		echo json_encode($response);
	}

}

/* End of file Messages.php */
/* Location: ./application/controllers/api/Messages.php */