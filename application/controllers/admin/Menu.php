<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

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
		if(!isset($this->data['view_permissions']->menu)){show_404();}
	}

	public function index()
	{
		$this->data['page_data']=array(
			'meta_title' => 'Admin/Menu',
			'meta_description' => '',
			'meta_keywords' => '',
			'page_title' => 'Menu',
			'breadcrumb' => array(
				array('link'=>env('ADMIN_FOLDER').'/dashboard','title'=>'Dashboard','active'=>false,),
				array('link'=>env('ADMIN_FOLDER').'/menu','title'=>'Menu','active'=>true,),
			),
		);

		if($this->input->post('add'))
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-fill">', '</div>');
			$this->form_validation->set_rules('menu_title', 'menu title', 'trim|required');
			$this->form_validation->set_rules('menu_slug', 'menu_slug', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$data_db=array();
				$data_db['menu_title'] = $this->input->post('menu_title');
				$data_db['menu_slug'] = $this->input->post('menu_slug');

				if($this->db->insert('cms_menu',$data_db)){
					$this->session->set_flashdata('message',alert('success','Information Updated'));
					redirect(env('ADMIN_FOLDER').'/menu','refresh');
				}else{
					$this->session->set_flashdata('message',alert('error','Error Occured'));
					redirect(env('ADMIN_FOLDER').'/menu','refresh');
				}
			}
		}


		$sql=$this->db->order_by('menu_sort_order','ASC')->get_where('cms_menu');
		$all_menu_items = $this->data['all_menu_items']=$sql->result_array();

		if($this->input->post('json_order'))
		{
			$new_array = array(); 
			$order = 1;
			$child_order = 1;
			$post_menu_array = $this->data['post_menu_array'] = json_decode($this->input->post('json_order'),1);
			foreach ($post_menu_array as $key => $menu_item) {
				$new_array[$menu_item['id']] = array(
					'menu_id' => $menu_item['id'],
					'menu_sort_order' => $order,
					'menu_parent' => null,
				);
				//update in db 
				$this->db->update('cms_menu',array('menu_sort_order'=>$order, 'menu_parent'=>null),array('menu_id'=>$menu_item['id']));

				if(isset($menu_item['children'])){
					foreach ($menu_item['children'] as $key => $child) {
						$new_array[$child['id']] = array(
							'menu_id' => $child['id'],
							'menu_sort_order' => $child_order,
							'menu_parent' => $menu_item['id'],
						);
						//update in db with parent
						$this->db->update('cms_menu',array('menu_sort_order'=>$child_order,'menu_parent'=>$menu_item['id']),array('menu_id'=>$child['id']));
						$child_order++;
					}
					$child_order = 1;
				}
				$order++;
			}

			//items to delete
			$delete_array = array();
			foreach ($all_menu_items as $key => $item) {
				if(!array_key_exists($item['menu_id'], $new_array)){
					$delete_array[] = $item['menu_id'];
					$this->db->delete('cms_menu',array('menu_id'=>$item['menu_id']));
				}
			}
			$this->session->set_flashdata('message',alert('success','Menu Updated'));
			redirect(env('ADMIN_FOLDER').'/menu','refresh');
		}


		$this->data['current_slug']='menu';
		$this->data['message']=$this->session->flashdata('message');
		$this->common->layout('admin/menu',$this->data);		
	}
}

/* End of file Siteoptions.php */
/* Location: ./application/controllers/Siteoptions.php */