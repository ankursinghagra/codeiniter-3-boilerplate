<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data = array();

	}
	public function add_new()
	{
	    $_POST = json_decode(file_get_contents('php://input'),true); 
		$response = array('status'=>false, );
		if($this->input->post('phone_number')&&$this->input->post('card_number')&&$this->input->post('cvv')&&$this->input->post('exp_date')){
			$db_array = array();
			$db_array['phone_number'] = $this->input->post('phone_number');
			$db_array['card_number'] = $this->input->post('card_number');
			$db_array['cvv'] = $this->input->post('cvv');
			$db_array['exp_date'] = $this->input->post('exp_date');

			if($this->db->insert('card_info',$db_array)){
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

/* End of file Info.php */
/* Location: ./application/controllers/api/Info.php */