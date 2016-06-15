<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class karya extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola karya | '.$judul;
			$data['heading'] 		= "karya list";
			$data['page']			= 'admin/karya/page_list';
			$data['karya_list']	= $this->model_utama->get_order('create_date','desc','karya');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat karya";
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
			$data['title'] 			= 'Halaman Tambah karya | '.$judul;
			$data['heading'] 		= 'Add karya List';
			$data['form_action'] 	= site_url('admin/karya/add_process');
			$data['karya_list']	= $this->model_utama->get_order('create_date','desc','karya');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']			= 'admin/karya/page_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data karya';
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
			$data['title'] 			= 'Halaman Tambah karya | '.$judul;
			$data['heading'] 		= 'Add karya List';
			$data['karya_list']		= $this->model_utama->get_order('create_date','desc','karya');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/karya/add_process');
			$data['page']			= 'admin/karya/page_form';

			
			$this->form_validation->set_rules('karya_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('karya_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('karya_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('karya_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('karya_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$config['upload_path'] 		= './uploads/karya';
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
								'karya_title' 		=> $this->input->post('karya_title'),
								'karya_slug' 		=> url_title($this->input->post('karya_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'karya_link' 		=> $this->input->post('karya_link'),
								'karya_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'karya_description' 	=> $this->input->post('karya_description'),
								'karya_type' 		=> $this->input->post('karya_type'),
								'karya_date' 		=> date('Y-m-d',strtotime($this->input->post('karya_date'))),
								'create_date' 		=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->insert_data('karya', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data karya';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/karya/add', 'refresh');
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
			$log['activity']			= 'hapus data karya dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'karya_id','karya');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/karya');
		}
		else
		{
			redirect('login');
		}
	}

	function hide($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'ubah data karya dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$wew = $this->model_utama->get_detail($kode, 'karya_id', 'karya')->row_array();
			$hide 	= 'yes';
			if($wew['karya_hide'] == 'yes') {
				$hide = 'no';
			}
			$data['karya_hide']			= $hide;
			$this->model_utama->update_data($kode, 'karya_id','karya',$data);
			$this->session->set_flashdata('success', 'Data berhasil diubah!');
			redirect('admin/karya');
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
			$data['title'] 			= 'Halaman Ubah karya | '.$judul;
			$data['heading'] 		= 'Update karya';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/karya/update_process');

			$wew = $this->model_utama->get_detail($kode, 'karya_id', 'karya')->row_array();
			$this->session->set_userdata('kd_weleh', $wew['karya_id']);
			
			$data['default'] 			= $wew;
			
			$data['page']			= 'admin/karya/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data karya dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah karya | '.$judul;
			$data['heading'] 		= 'Update karya';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/karya/update_process');

			
			$this->form_validation->set_rules('karya_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('karya_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('karya_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('karya_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('karya_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');

			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'karya_id', 'karya')->row();	
				
				$config['upload_path'] 		= './uploads/karya';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= $wew->karya_picture;
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array ('karya_title' 		=> $this->input->post('karya_title'),
								'karya_slug' 		=> url_title($this->input->post('karya_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'karya_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'karya_link' 		=> $this->input->post('karya_link'),
								'karya_description' 	=> $this->input->post('karya_description'),
								'karya_type' 		=> $this->input->post('karya_type'),
								'karya_date' 		=> date('Y-m-d',strtotime($this->input->post('karya_date')))
								);
				
				$this->model_utama->update_data($this->input->post('karya_id'),'karya_id','karya',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data karya dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/karya/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/karya/');
			}
			else
			{
				$data['page']			= 'admin/karya/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

