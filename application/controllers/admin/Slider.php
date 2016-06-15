<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class slider extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola slider | '.$judul;
			$data['heading'] 		= "slider list";
			$data['page']			= 'admin/slider/page_list';
			$data['slider_list']	= $this->model_utama->get_order('create_date','desc','slider');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat slider";
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
			$data['title'] 			= 'Halaman Tambah slider | '.$judul;
			$data['heading'] 		= 'Add slider List';
			$data['form_action'] 	= site_url('admin/slider/add_process');
			$data['slider_list']	= $this->model_utama->get_order('slider_id','asc','slider');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']			= 'admin/slider/page_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data slider';
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
			$data['title'] 			= 'Halaman Tambah slider | '.$judul;
			$data['heading'] 		= 'Add slider List';
			$data['slider_list']		= $this->model_utama->get_order('create_date','desc','slider');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/slider/add_process');
			$data['page']			= 'admin/slider/page_form';

			
			$this->form_validation->set_rules('slider_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('slider_description', 'Description', 'min_length[5]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$config['upload_path'] 		= './uploads/slider';
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
								'slider_title' 			=> $this->input->post('slider_title'),
								'slider_slug' 			=> url_title($this->input->post('slider_title'), 'dash', TRUE),
								'user_id'	 			=> $user_id,
								'slider_picture' 		=> $file_dokumen,
								'slider_description' 	=> $this->input->post('slider_description')
								);
				
				$this->model_utama->insert_data('slider', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data slider';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/slider/add', 'refresh');
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
			$log['activity']			= 'hapus data slider dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'slider_id','slider');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/slider');
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
			$data['title'] 			= 'Halaman Ubah slider | '.$judul;
			$data['heading'] 		= 'Update slider';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/slider/update_process');

			$wew = $this->model_utama->get_detail($kode, 'slider_id', 'slider')->row();
			$this->session->set_userdata('kd_weleh', $wew->slider_id);
			
			$data['default']['slider_title'] 		= $wew->slider_title;		
			$data['default']['slider_description']	= $wew->slider_description;	
			$data['default']['slider_picture'] 		= $wew->slider_picture;
			$data['default']['slider_id'] 			= $wew->slider_id;
			
			$data['page']			= 'admin/slider/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data slider dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah slider | '.$judul;
			$data['heading'] 		= 'Update slider';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/slider/update_process');

			
			$this->form_validation->set_rules('slider_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('slider_description', 'Description', 'min_length[5]');
			
			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'slider_id', 'slider')->row();	
				
				$config['upload_path'] 		= './uploads/slider';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= $wew->slider_picture;
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array ('slider_title' 			=> $this->input->post('slider_title'),
								'slider_slug' 			=> url_title($this->input->post('slider_title'), 'dash', TRUE),
								'user_id'	 			=> $user_id,
								'slider_picture' 		=> $file_dokumen,
								'slider_description' 	=> $this->input->post('slider_description')
								);
				
				$this->model_utama->update_data($this->input->post('slider_id'),'slider_id','slider',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data slider dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/slider/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/slider/');
			}
			else
			{
				$data['page']			= 'admin/slider/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

