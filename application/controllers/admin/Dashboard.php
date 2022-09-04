<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
            redirect(env('ADMIN_FOLDER').'/login' ,'refresh');
		}
		//if(!isset($this->data['view_permissions']->dashboard)){show_404();}
	}

	public function index()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Dashboard',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Dashboard',
			'breadcrumb' => array(
				array('link'=>'dashboard','title'=>'Dashboard','active'=>true,),
			),
		);


		$this->data['current_slug']='dashboard';
		$this->common->layout('admin/dashboard',$this->data);		
	}
	public function error_page()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin - Page Not Found',
			'meta_description' => '',
			'meta_keywords' => '',
		);
		$this->data['current_slug']='error_page';
		$this->common->layout('admin/404',$this->data);	
	}
	public function ajax_img_save()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-type: application/json');
        $data = array();
        if( isset( $_POST['image_upload'] ) && !empty( $_FILES['images'] )){
            
            $image = $_FILES['images'];
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            
            
            $image_name = $image['name'];
            //get image extension
            $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            //assign unique name to image
            $name = time().'.'.$ext;
            //$name = $image_name;
            //image size calcuation in KB
            $image_size = $image["size"] / 1024;
            $image_flag = true;
            //max image size
            $max_size = 512;
            if( in_array($ext, $allowedExts) && $image_size < $max_size ){
                $image_flag = true;
            } else {
                $image_flag = false;
                $data['error'] = 'Maybe '.$image_name. ' exceeds max '.$max_size.' KB size or incorrect file extension';
            } 
            
            if( $image["error"] > 0 ){
                $image_flag = false;
                $data['error'] = '';
                $data['error'].= '<br/> '.$image_name.' Image contains error - Error Code : '.$image["error"];
            }
            
            if($image_flag){
                //$root_dir = $_SERVER['DOCUMENT_ROOT'].str_replace(array($_SERVER['DOCUMENT_ROOT'],'/'.$this->config->item('folder')), '', dirname($_SERVER['SCRIPT_FILENAME']));

                move_uploaded_file($image["tmp_name"], root_dir()."/uploads/cache/".$name);
                $src = "uploads/cache/".$name;
                $data['success'] = $name;
                
                //mysql save here
            }
            
            
            echo json_encode($data);
            
        } else {
            $data[] = 'No Image Selected..';
        }
    }
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */