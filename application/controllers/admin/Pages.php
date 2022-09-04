<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
		if(!isset($this->data['view_permissions']->pages)){show_404();}
	}

	public function index()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Pages',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Pages',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/pages','title'=>'Pages','active'=>true,),
			),
		);
		if($this->input->post()){
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('page_title', 'page title', 'trim|required');
			$this->form_validation->set_rules('page_slug', 'page slug', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['page_title'] = $this->input->post('page_title');
				$data_db['page_slug'] = $this->input->post('page_slug');

				$this->db->insert('cms_pages',$data_db);
				$this->session->set_flashdata('message',alert('success','Information Updated'));
				redirect(env('ADMIN_FOLDER').'/pages/edit_page/'.$this->db->insert_id(),'refresh');
			}
		}

		$sql=$this->db->get('cms_pages');
		$this->data['all_pages']=$sql->result_array();

		$this->data['current_slug']='pages';
		$this->common->layout('admin/pages',$this->data);		
	}
	public function edit_page($id=null)
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Pages/EditPage',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Pages',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/pages','title'=>'Pages','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/pages/all_pages','title'=>'All Pages','active'=>false,), 
				array('link'=>env('ADMIN_FOLDER').'/pages/all_pages','title'=>'Edit Page','active'=>true,), 
			),
		);

		if ($this->input->post()) {
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
			$this->form_validation->set_rules('page_subtitle', 'page_subtitle', 'trim|required');
			$this->form_validation->set_rules('meta_title', 'meta_title', 'trim|required');
			$this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'trim|required');
			$this->form_validation->set_rules('meta_description', 'meta_description', 'trim|required');
			$this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'trim|required');
			$this->form_validation->set_rules('og_title', 'og_title', 'trim|required');
			$this->form_validation->set_rules('og_type', 'og_type', 'trim|required');
			$this->form_validation->set_rules('og_description', 'og_description', 'trim|required');
			$this->form_validation->set_rules('tw_title', 'tw_title', 'trim|required');
			$this->form_validation->set_rules('tw_card', 'tw_card', 'trim|required');
			$this->form_validation->set_rules('tw_description', 'tw_description', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['page_title'] = $this->input->post('page_title');
				$data_db['page_subtitle'] = $this->input->post('page_subtitle');
				$data_db['meta_title'] = $this->input->post('meta_title');
				$data_db['meta_keywords'] = $this->input->post('meta_keywords');
				$data_db['meta_description'] = $this->input->post('meta_description');
				$data_db['meta_keywords'] = $this->input->post('meta_keywords');
				$data_db['og_title'] = $this->input->post('og_title');
				$data_db['og_type'] = $this->input->post('og_type');
				$data_db['og_description'] = $this->input->post('og_description');
				$data_db['tw_title'] = $this->input->post('tw_title');
				$data_db['tw_card'] = $this->input->post('tw_card');
				$data_db['tw_description'] = $this->input->post('tw_description');

				if($this->input->post('file_name')){
					$data_db['og_image'] =  $data_db['tw_image'] = $this->common->upload_photo('pages/');
				}
				if (($this->db->update('cms_pages',$data_db,array('page_id'=>$id)))) {
					$this->session->set_flashdata('message',alert('success','Information Updated'));
					redirect(env('ADMIN_FOLDER').'/pages/edit_page/'.$id,'refresh');
				} else {
					$this->session->set_flashdata('message',alert('danger','Error Updating'));
					redirect(env('ADMIN_FOLDER').'/pages/edit_page/'.$id,'refresh');
				}
			}
		}

		$sql=$this->db->get_where('cms_pages',array('page_id'=>$id));
		$this->data['page']=$sql->row_array();
		$this->data['cropping_ratio']=4/3;
		$this->data['current_slug']='pages_editpage';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/pages_editpages',$this->data);		
	}
	public function edit_page_content($id)
	{

		if ($this->input->post()) {
			
			$data_db=array();
			$data_db['page_content_json'] = $this->input->post('page_content_json');
			
			$this->load->library('Sioen');
			$converter = new Converter();
        	$data_db['page_content_html'] = $converter->toHtml($this->input->post('page_content_json'));

			if (($this->db->update('cms_pages',$data_db,array('page_id'=>$id)))) {
				$this->session->set_flashdata('message',alert('success','Information Updated'));
				redirect(env('ADMIN_FOLDER').'/pages/edit_page_content/'.$id,'refresh');
			} else {
				$this->session->set_flashdata('message',alert('danger','Error Updating'));
				redirect(env('ADMIN_FOLDER').'/pages/edit_page_content/'.$id,'refresh');
			}
		}

		$sql=$this->db->get_where('cms_pages',array('page_id'=>$id));
		$this->data['page']=$sql->row_array();
		$this->data['current_slug']='pages_editpagecontent';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('templates/admin/pages_editpagecontent',$this->data);	
	}

	public function api_delete_page(){
		header('Content-type: application/json');
		$response = array();

		if(isset($this->data['modify_permissions']->pages)&&($this->data['modify_permissions']->pages)){

			if($this->input->post('id')){

				$this->db->delete('cms_pages',array('page_id'=>$this->input->post('id')));
			
				$response['status'] = 'success';
				$response['title'] = 'Deleted';
				$response['message'] = "Page is Deleted";
			}else{
				$response['status'] = 'failure';
				$response['title'] = 'Deleted';
				$response['message'] = "Page is Deleted";
			}

		}else{
			$response['status'] = 'failure';
			$response['title'] = 'Error';
			$response['message'] = "Error Deleting Page";
		}		

		echo json_encode($response);
	}
	public function api_sir_trevor_image_upload()
	{
		$attachment = $this->input->post('attachment');
        $uploadedFile = $_FILES['attachment']['tmp_name']['file'];
        
        $path = root_dir().'/uploads/pages';
        $url = main_url().'uploads/pages';
        
        // create an image name
        $fileName = time().'_'.str_replace(' ', '_', $attachment['name']);
        
        // upload the image
        move_uploaded_file($uploadedFile, $path.'/'.$fileName);
        
        $this->output->set_output(json_encode(array('file' => array(
	        'url' => $url . '/' . $fileName,
	        'filename' => $fileName
        ))),
        200,
        array('Content-Type' => 'application/json')
        );
	}
}

/* End of file Siteoptions.php */
/* Location: ./application/controllers/Siteoptions.php */