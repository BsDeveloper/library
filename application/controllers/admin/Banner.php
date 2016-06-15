<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class banner extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola banner | '.$judul;
			$data['heading'] 		= "banner list";
			$data['page']			= 'admin/banner/page_list';
			$data['banner_list']	= $this->model_utama->get_order('create_date','desc','banner');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat banner";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	
	
	function add()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah banner | '.$judul;
			$data['heading'] 		= 'Add banner List';
			$data['form_action'] 	= site_url('admin/banner/add_process');
			$data['banner_list']	= $this->model_utama->get_order('banner_id','asc','banner');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']			= 'admin/banner/page_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data banner';
			$this->model_utama->insert_data('log_user', $log);

		}
		else
		{
			redirect('login');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah banner | '.$judul;
			$data['heading'] 		= 'Add banner List';
			$data['banner_list']		= $this->model_utama->get_order('create_date','desc','banner');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/banner/add_process');
			$data['page']			= 'admin/banner/page_form';

			
			$this->form_validation->set_rules('banner_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('banner_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('banner_type', 'type', 'min_length[1]');	
			$this->form_validation->set_rules('banner_hide', 'hide', 'min_length[1]');				
				
			if ($this->form_validation->run() == TRUE)
			{
				$config['upload_path'] 		= './uploads/banner';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= '';
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array (
								'banner_title' 			=> $this->input->post('banner_title'),
								'banner_slug' 			=> url_title($this->input->post('banner_title'), 'dash', TRUE),
								'user_id'	 			=> $user_id,
								'banner_picture' 		=> $file_dokumen,
								'banner_description' 	=> $this->input->post('banner_description'),								
								'banner_hide'			=> $this->input->post('banner_hide'),	
								'banner_type' 			=> $this->input->post('banner_type')
								);
				
				$this->model_utama->insert_data('banner', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data banner';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/banner/add', 'refresh');
			}
			else
			{
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	function delete($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data banner dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'banner_id','banner');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/banner');
		}
		else
		{
			redirect('login');
		}
	}
	
	function update($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah banner | '.$judul;
			$data['heading'] 		= 'Update banner';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/banner/update_process');

			$wew = $this->model_utama->get_detail($kode, 'banner_id', 'banner')->row_array();
			$this->session->set_userdata('kd_weleh', $wew['banner_id']);
			
			$data['default'] 		= $wew;
			
			$data['page']			= 'admin/banner/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data banner dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function update_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah banner | '.$judul;
			$data['heading'] 		= 'Update banner';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/banner/update_process');

			
			$this->form_validation->set_rules('banner_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('banner_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('banner_type', 'type', 'min_length[1]');
			$this->form_validation->set_rules('banner_hide', 'hide', 'min_length[1]');							
			
			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'banner_id', 'banner')->row();	
				
				$config['upload_path'] 		= './uploads/banner';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= $wew->banner_picture;
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array ('banner_title' 			=> $this->input->post('banner_title'),
								'banner_slug' 			=> url_title($this->input->post('banner_title'), 'dash', TRUE),
								'user_id'	 			=> $user_id,
								'banner_picture' 		=> $file_dokumen,
								'banner_description' 	=> $this->input->post('banner_description'),
								'banner_hide'			=> $this->input->post('banner_hide'),	
								'banner_type' 			=> $this->input->post('banner_type')
								);
				
				$this->model_utama->update_data($this->input->post('banner_id'),'banner_id','banner',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data banner dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/banner/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/banner/');
			}
			else
			{
				$data['page']			= 'admin/banner/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

