<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class klien extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola klien | '.$judul;
			$data['heading'] 		= "klien list";
			$data['page']			= 'admin/klien/page_list';
			$data['klien_list']	= $this->model_utama->get_order('create_date','desc','klien');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat klien";
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
			$data['title'] 			= 'Halaman Tambah klien | '.$judul;
			$data['heading'] 		= 'Add klien List';
			$data['form_action'] 	= site_url('admin/klien/add_process');
			$data['klien_list']	= $this->model_utama->get_order('create_date','desc','klien');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']			= 'admin/klien/page_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data klien';
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
			$data['title'] 			= 'Halaman Tambah klien | '.$judul;
			$data['heading'] 		= 'Add klien List';
			$data['klien_list']		= $this->model_utama->get_order('create_date','desc','klien');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/klien/add_process');
			$data['page']			= 'admin/klien/page_form';

			
			$this->form_validation->set_rules('klien_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('klien_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('klien_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('klien_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('klien_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$config['upload_path'] 		= './uploads/klien';
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
								'klien_title' 		=> $this->input->post('klien_title'),
								'klien_slug' 		=> url_title($this->input->post('klien_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'klien_link' 		=> $this->input->post('klien_link'),
								'klien_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'klien_description' 	=> $this->input->post('klien_description'),
								'klien_type' 		=> $this->input->post('klien_type'),
								'klien_date' 		=> date('Y-m-d',strtotime($this->input->post('klien_date'))),
								'create_date' 		=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->insert_data('klien', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data klien';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/klien/add', 'refresh');
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
			$log['activity']			= 'hapus data klien dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'klien_id','klien');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/klien');
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
			$log['activity']			= 'ubah data klien dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$wew = $this->model_utama->get_detail($kode, 'klien_id', 'klien')->row_array();
			$hide 	= 'yes';
			if($wew['klien_hide'] == 'yes') {
				$hide = 'no';
			}
			$data['klien_hide']			= $hide;
			$this->model_utama->update_data($kode, 'klien_id','klien',$data);
			$this->session->set_flashdata('success', 'Data berhasil diubah!');
			redirect('admin/klien');
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
			$data['title'] 			= 'Halaman Ubah klien | '.$judul;
			$data['heading'] 		= 'Update klien';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/klien/update_process');

			$wew = $this->model_utama->get_detail($kode, 'klien_id', 'klien')->row_array();
			$this->session->set_userdata('kd_weleh', $wew['klien_id']);
			
			$data['default'] 			= $wew;
			
			$data['page']			= 'admin/klien/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data klien dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah klien | '.$judul;
			$data['heading'] 		= 'Update klien';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/klien/update_process');

			
			$this->form_validation->set_rules('klien_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('klien_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('klien_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('klien_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('klien_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');

			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'klien_id', 'klien')->row();	
				
				$config['upload_path'] 		= './uploads/klien';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= $wew->klien_picture;
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array ('klien_title' 		=> $this->input->post('klien_title'),
								'klien_slug' 		=> url_title($this->input->post('klien_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'klien_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'klien_link' 		=> $this->input->post('klien_link'),
								'klien_description' 	=> $this->input->post('klien_description'),
								'klien_type' 		=> $this->input->post('klien_type'),
								'klien_date' 		=> date('Y-m-d',strtotime($this->input->post('klien_date')))
								);
				
				$this->model_utama->update_data($this->input->post('klien_id'),'klien_id','klien',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data klien dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/klien/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/klien/');
			}
			else
			{
				$data['page']			= 'admin/klien/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

