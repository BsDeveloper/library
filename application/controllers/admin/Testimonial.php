<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class testimonial extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola testimonial | '.$judul;
			$data['heading'] 		= "testimonial list";
			$data['page']			= 'admin/testimonial/page_list';
			$data['testimonial_list']	= $this->model_utama->get_order('create_date','desc','testimonial');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat testimonial";
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
			$data['title'] 			= 'Halaman Tambah testimonial | '.$judul;
			$data['heading'] 		= 'Add testimonial List';
			$data['form_action'] 	= site_url('admin/testimonial/add_process');
			$data['testimonial_list']	= $this->model_utama->get_order('create_date','desc','testimonial');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']			= 'admin/testimonial/page_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data testimonial';
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
			$data['title'] 			= 'Halaman Tambah testimonial | '.$judul;
			$data['heading'] 		= 'Add testimonial List';
			$data['testimonial_list']		= $this->model_utama->get_order('create_date','desc','testimonial');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/testimonial/add_process');
			$data['page']			= 'admin/testimonial/page_form';

			
			$this->form_validation->set_rules('testimonial_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('testimonial_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('testimonial_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('testimonial_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('testimonial_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$config['upload_path'] 		= './uploads/testimonial';
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
								'testimonial_title' 		=> $this->input->post('testimonial_title'),
								'testimonial_slug' 		=> url_title($this->input->post('testimonial_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'testimonial_link' 		=> $this->input->post('testimonial_link'),
								'testimonial_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'testimonial_description' 	=> $this->input->post('testimonial_description'),
								'testimonial_type' 		=> $this->input->post('testimonial_type'),
								'testimonial_date' 		=> date('Y-m-d',strtotime($this->input->post('testimonial_date'))),
								'create_date' 		=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->insert_data('testimonial', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data testimonial';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/testimonial/add', 'refresh');
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
			$log['activity']			= 'hapus data testimonial dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'testimonial_id','testimonial');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/testimonial');
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
			$log['activity']			= 'ubah data testimonial dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$wew = $this->model_utama->get_detail($kode, 'testimonial_id', 'testimonial')->row_array();
			$hide 	= 'yes';
			if($wew['testimonial_hide'] == 'yes') {
				$hide = 'no';
			}
			$data['testimonial_hide']			= $hide;
			$this->model_utama->update_data($kode, 'testimonial_id','testimonial',$data);
			$this->session->set_flashdata('success', 'Data berhasil diubah!');
			redirect('admin/testimonial');
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
			$data['title'] 			= 'Halaman Ubah testimonial | '.$judul;
			$data['heading'] 		= 'Update testimonial';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/testimonial/update_process');

			$wew = $this->model_utama->get_detail($kode, 'testimonial_id', 'testimonial')->row_array();
			$this->session->set_userdata('kd_weleh', $wew['testimonial_id']);
			
			$data['default'] 			= $wew;
			
			$data['page']			= 'admin/testimonial/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data testimonial dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah testimonial | '.$judul;
			$data['heading'] 		= 'Update testimonial';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/testimonial/update_process');

			
			$this->form_validation->set_rules('testimonial_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('testimonial_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('testimonial_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('testimonial_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('testimonial_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');

			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'testimonial_id', 'testimonial')->row();	
				
				$config['upload_path'] 		= './uploads/testimonial';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= $wew->testimonial_picture;
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array ('testimonial_title' 		=> $this->input->post('testimonial_title'),
								'testimonial_slug' 		=> url_title($this->input->post('testimonial_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'testimonial_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'testimonial_link' 		=> $this->input->post('testimonial_link'),
								'testimonial_description' 	=> $this->input->post('testimonial_description'),
								'testimonial_type' 		=> $this->input->post('testimonial_type'),
								'testimonial_date' 		=> date('Y-m-d',strtotime($this->input->post('testimonial_date')))
								);
				
				$this->model_utama->update_data($this->input->post('testimonial_id'),'testimonial_id','testimonial',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data testimonial dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/testimonial/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/testimonial/');
			}
			else
			{
				$data['page']			= 'admin/testimonial/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

