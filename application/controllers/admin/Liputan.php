<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class liputan extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola liputan | '.$judul;
			$data['heading'] 		= "liputan list";
			$data['page']			= 'admin/liputan/page_list';
			$data['liputan_list']	= $this->model_utama->get_order('create_date','desc','liputan');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat liputan";
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
			$data['title'] 			= 'Halaman Tambah liputan | '.$judul;
			$data['heading'] 		= 'Add liputan List';
			$data['form_action'] 	= site_url('admin/liputan/add_process');
			$data['liputan_list']	= $this->model_utama->get_order('create_date','desc','liputan');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']			= 'admin/liputan/page_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data liputan';
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
			$data['title'] 			= 'Halaman Tambah liputan | '.$judul;
			$data['heading'] 		= 'Add liputan List';
			$data['liputan_list']		= $this->model_utama->get_order('create_date','desc','liputan');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/liputan/add_process');
			$data['page']			= 'admin/liputan/page_form';

			
			$this->form_validation->set_rules('liputan_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('liputan_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('liputan_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('liputan_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('liputan_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$config['upload_path'] 		= './uploads/liputan';
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
								'liputan_title' 		=> $this->input->post('liputan_title'),
								'liputan_slug' 		=> url_title($this->input->post('liputan_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'liputan_link' 		=> $this->input->post('liputan_link'),
								'liputan_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'liputan_description' 	=> $this->input->post('liputan_description'),
								'liputan_type' 		=> $this->input->post('liputan_type'),
								'liputan_date' 		=> date('Y-m-d',strtotime($this->input->post('liputan_date'))),
								'create_date' 		=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->insert_data('liputan', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data liputan';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/liputan/add', 'refresh');
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
			$log['activity']			= 'hapus data liputan dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'liputan_id','liputan');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/liputan');
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
			$log['activity']			= 'ubah data liputan dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$wew = $this->model_utama->get_detail($kode, 'liputan_id', 'liputan')->row_array();
			$hide 	= 'yes';
			if($wew['liputan_hide'] == 'yes') {
				$hide = 'no';
			}
			$data['liputan_hide']			= $hide;
			$this->model_utama->update_data($kode, 'liputan_id','liputan',$data);
			$this->session->set_flashdata('success', 'Data berhasil diubah!');
			redirect('admin/liputan');
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
			$data['title'] 			= 'Halaman Ubah liputan | '.$judul;
			$data['heading'] 		= 'Update liputan';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/liputan/update_process');

			$wew = $this->model_utama->get_detail($kode, 'liputan_id', 'liputan')->row_array();
			$this->session->set_userdata('kd_weleh', $wew['liputan_id']);
			
			$data['default'] 			= $wew;
			
			$data['page']			= 'admin/liputan/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data liputan dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah liputan | '.$judul;
			$data['heading'] 		= 'Update liputan';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/liputan/update_process');

			
			$this->form_validation->set_rules('liputan_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('liputan_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('liputan_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('liputan_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('liputan_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');

			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'liputan_id', 'liputan')->row();	
				
				$config['upload_path'] 		= './uploads/liputan';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= $wew->liputan_picture;
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array ('liputan_title' 		=> $this->input->post('liputan_title'),
								'liputan_slug' 		=> url_title($this->input->post('liputan_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'liputan_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'liputan_link' 		=> $this->input->post('liputan_link'),
								'liputan_description' 	=> $this->input->post('liputan_description'),
								'liputan_type' 		=> $this->input->post('liputan_type'),
								'liputan_date' 		=> date('Y-m-d',strtotime($this->input->post('liputan_date')))
								);
				
				$this->model_utama->update_data($this->input->post('liputan_id'),'liputan_id','liputan',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data liputan dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/liputan/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/liputan/');
			}
			else
			{
				$data['page']			= 'admin/liputan/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

