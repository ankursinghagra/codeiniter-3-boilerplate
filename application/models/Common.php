<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Calcutta');
		setlocale(LC_MONETARY, 'en_IN');
		$this->data=array();
		$this->data['cms_options']=$this->cms_options();
		/*if($this->agent->is_mobile()){
			$this->data['theme'] = $this->data['cms_options']['theme_mobile'];
		}else{
			$this->data['theme'] = $this->data['cms_options']['theme_desktop'];
		}*/
	}
	public function generateRandomString($length = 10) {
	    /*$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;*/
	    return sha1(microtime().rand(1000000,9999999));
	}
	public function cms_options(){
        $sql=$this->db->get_where('cms_options',array('id'=>'1'));
        return $sql->row_array();
    }
	public function navbar_array(){
		$sql_navbar = $this->db->order_by('menu_sort_order','ASC')->get_where('cms_menu',array('menu_active'=>'1'));
    	return $sql_navbar->result_array();
	}
	public function partial($file,$data)
	{
		return $this->load->view('partials/'.$file, $data, TRUE);
	}
	public function layout($file,$data)
	{
		$data['header'] = $this->partial('header',$data,TRUE);
		$data['navbar'] = $this->partial('navbar',$data,TRUE);
		$data['content'] = $this->load->view('templates/'.$file,$data,TRUE);
		$data['footer'] = $this->partial('footer',$data,TRUE);
		$this->load->view('partials/layout',$data);
	}
	//create results and pagination
    public function results_generator($query,$base_path,$itemsPerPage,$page_no=1,$url_options=null){
        $sql_all=$this->db->query($query);
        if($sql_all->num_rows()>0){
            $offset = ($page_no - 1) * $itemsPerPage;
            $totalitems = $sql_all->num_rows();
            $end = $totalitems;
            if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}
            $page_str = ($offset+1).'-'.$end.' of '.$totalitems.' Results';
            $total_pages = ceil($totalitems / $itemsPerPage); 
            $pagination=$this->custom_pagination($base_path,$total_pages,$page_no,$url_options);

            $sql_results=$this->db->query($query." LIMIT ".$offset.",".$itemsPerPage." ");
            if($sql_results->num_rows()>0){
                $results=$sql_results->result_array();
            }else{
                $page_str=false;
                $results=false;
                $pagination=false;
            }
        }else{
            $page_str=false;
            $results=false;
            $pagination=false;
        }
        return array(
            'page_str' => $page_str,
            'results' => $results,
            'pagination' => $pagination,
            );
    }
    public function pager($base_path,$total_pages,$page_no,$itemsPerPage)
    {
    	if($total_pages=='1'){
    		return false;
    	}else{
	    	if($page_no=='1'){
	    		$first_btn=array('PREV','disabled','javascript:void();');
	    		$second_btn=array('NEXT','',$base_path.($page_no+1));
	    	}elseif($page_no==$total_pages){
	    		$first_btn=array('PREV','',$base_path.($page_no-1));
	    		$second_btn=array('NEXT','disabled','javascript:void();');
	    	}else{
	    		if($page_no=='2'){
	    			$first_btn=array('PREV','',$base_path);
	    		}else{
	    			$first_btn=array('PREV','',$base_path.($page_no-1));
	    		}
	    		$second_btn=array('NEXT','',$base_path.($page_no+1));
	    	}
    	}
    	return array($first_btn,$second_btn);
    }
    public function custom_pagination($base_path,$total_pages,$page_no)
    {
        $HTML='';
        if ($total_pages>1) {
            $HTML.= '<div class="styled-pagination text-center margin-bott-40">
            			<ul class="pagination">
                        <li class="page-item"><a class="prev page-link" href="'.$base_path.'1"><span class="fa fa-angle-left"></span>&ensp;Prev</a></li>';
            for($i=1; $i<=$total_pages; $i++) {
                if($i==$page_no){
                    $HTML.= '<li class="page-item active"><a class="page-link" href="javascript:void(0);">'.$i.'</a></li>'; 
                }else{
                    $HTML.= '<li class="page-item"><a class="page-link" href="'.$base_path.$i.'">'.$i.'</a></li>'; 
                }
            }   
            $HTML.= '   <li  class="page-item"><a class="next page-link" href="'.$base_path.$total_pages.'">Next&ensp;<span class="fa fa-angle-right"></span></a></li>
                    </ul></div>';
        }
        return $HTML;
    }
    public function upload_photo($folder)
	{
		//This function Just CROP the file and save it in the $folder
		$x = $this->input->post('x');
		$y = $this->input->post('y');
		$h = $this->input->post('h');
		$w = $this->input->post('w');
		$orignal_path = $this->input->post('orignal_path');
		$file_name = $this->input->post('file_name');

		include APPPATH.'third_party/php-image-resize/lib/ImageResize.php';
    	$image = new \Gumlet\ImageResize(root_dir()."/uploads/cache/".$file_name);
		$image->freecrop($w, $h, $x, $y);
		$image->save(root_dir().'/uploads/'.$folder.$file_name);
		unlink(root_dir().'/uploads/cache/'.$file_name);
		return $file_name;

	}
	
	public function upload_photo_make_thumb($folder)
	{	
		//This function copy orignal file into $folder and create a thumb file too.
			//upload image
			$x = $this->input->post('x');
			$y = $this->input->post('y');
			$h = $this->input->post('h');
			$w = $this->input->post('w');
			$orignal_path = $this->input->post('orignal_path');
			$file_name = $this->input->post('file_name');

			$config['image_library'] = 'GD2';
	        $config['source_image'] = "uploads/cache/".$file_name; 
	       	$config['create_thumb'] = FALSE;
	        $config['new_image'] = 'uploads/'.$folder;
	        $config['dynamic_output'] = FALSE;
	        $config['maintain_ratio'] = FALSE;
	        $config['width']  = $w;
	        $config['height'] = $h;
	        $config['x_axis'] = $x;
	        $config['y_axis'] = $y;

	        // Image Saved in $folder , And CROP
	        $this->load->library('image_lib',$config);
	        $this->image_lib->crop();

	        $this->image_lib->clear();
	        unset($config);
	        $config=array();

	        $config['image_library'] = 'GD2';
			$config['source_image']	= 'assets/uploads/'.$folder.$file_name;
			$config['new_image'] = 'assets/uploads/'.$folder;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['thumb_marker'] = '_thumb';
			$config['width']	= 500;
			$config['height']	= 350;

			// Create a TINY thumb of the cropped photo
			$this->load->library('image_lib', $config); 
			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			$this->image_lib->clear();
	        unset($config);
	        $config=array();

			/*$config['source_image']	= 'uploads/'.$folder.$file_name;
			$config['wm_type'] = 'text';
			$config['wm_text'] = 'theWeddingShopee';
			$config['wm_font_path'] = 'assets/fonts/droidsans.ttf';
			$config['wm_font_size']	= '16';
			$config['wm_font_color'] = 'ffffff';
			$config['wm_vrt_alignment'] = 'bottom';
			$config['wm_hor_alignment'] = 'right';
			$config['wm_padding'] = '2';
			$config['create_thumb'] = FALSE;*/

			/*$config['source_image']	= 'uploads/'.$folder.$file_name;
			$config['wm_type'] = 'overlay';
			$config['wm_overlay_path'] = 'assets/img/logo1.png';
			$config['wm_opacity']       = 10;
			$config['wm_vrt_alignment'] = 'bottom';
			$config['wm_hor_alignment'] = 'right';
			$config['wm_padding'] = '2';
			$config['create_thumb'] = FALSE;

			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config); 
			$this->image_lib->watermark();*/

			// Move the Orignal Full Resolution File into $folder
            rename("assets/uploads/cache/".$file_name,"assets/uploads/".$folder.$file_name );

            $config=array();
	        $config['image_library'] = 'GD2';
			$config['source_image']	= 'assets/uploads/'.$folder.$file_name;
			$config['new_image'] = 'assets/uploads/'.$folder;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['thumb_marker'] = '_thumb';
			$config['width']	= 1024;
			$config['height']	= 786;

			// Create a TINY thumb of the cropped photo
			$this->load->library('image_lib', $config); 
			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			$this->image_lib->clear();
	        unset($config);
	        return $file_name;

	}
	public function send_sms($phone_number,$message){

 		$apiKey = urlencode('textlocalcode');
		$numbers = '91'.$phone_number;
		//$sender = 'TXTLCL';
		$sender = 'RNTEZO';
	 
		// Prepare data for POST request
		$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => ($message));
		// Send the POST request with cURL
		$ch = curl_init('https://api.textlocal.in/send/');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		//print_r($response);
		$this->load->helper('file');
		write_file('./uploads/smslog.txt', $response, 'r+');

		return true;
	}
	public function send_email($to_email,$email_name,$subject,$HTML){

		$sql=$this->db->query("SELECT `site_name`,`email_function`,`email_smtp_from`,`email_smtp_hostname`,`email_smtp_port`,`email_smtp_username`,`email_smtp_password` FROM cms_options WHERE id=1 LIMIT 1");
		$row=$sql->row_array();

		if($row['email_function']=='mail'){
			$this->load->library('email');

			$this->email->from($row['email_smtp_from'],$row['site_name']);
			$this->email->to($to_email);
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');

			$this->email->subject($subject);
			$this->email->message($HTML);

			return $this->email->send();
			
		}elseif($row['email_function']=='smtp'){

			$this->load->library('myphpmailer');
	        $mail = new PHPMailer();

	        if (isset($row['email_smtp_hostname'])&&!empty($row['email_smtp_hostname'])) {
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Debugoutput = 'html';
				$mail->Host = $row['email_smtp_hostname'];//"sapricami.com";
				$mail->Port = $row['email_smtp_port'];//25;
				$mail->SMTPAuth = true;
				$mail->Username = $row['email_smtp_username'];//"wingrow";
				$mail->Password = $row['email_smtp_password'];//"a9897716370A";
	        }
	        //if ssl
	        /*$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);*/
			$mail->setFrom($row['email_smtp_from'],$row['site_name']);
			/*if(!empty($reply_email)){
				if(!empty($reply_name)){
					$mail->addReplyTo($from_email, $from_name);
				}else{
					$mail->addReplyTo($from_email, '');
				}
			}*/
	        $mail->addAddress($to_email);
	        /*if(!empty($cc)){
	        	$mail->addCC($cc);
	        }*/
	        $mail->Subject = $subject;
	        $mail->msgHTML($HTML);
	        $mail->AltBody = $HTML;

	        return $mail->send();
		}else{
			return false;
		}
	}
}

/* End of file Common.php */
/* Location: ./application/models/Common.php */