<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class blog extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola blog | '.$judul;
			$data['heading'] 		= "blog list";
			$data['page']			= 'admin/blog/page_list';
			$data['blog_list']	= $this->model_utama->get_order('create_date','desc','blog');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat blog";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	
	
	function add()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah blog | '.$judul;
			$data['heading'] 		= 'Add blog List';
			$data['form_action'] 	= site_url('index.php/admin/blog/add_process');
			$data['blog_list']	= $this->model_utama->get_order('create_date','desc','blog');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']			= 'admin/blog/page_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data blog';
			$this->model_utama->insert_data('log_user', $log);

		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah blog | '.$judul;
			$data['heading'] 		= 'Add blog List';
			$data['blog_list']		= $this->model_utama->get_order('create_date','desc','blog');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('index.php/admin/blog/add_process');
			$data['page']			= 'admin/blog/page_form';

			
			$this->form_validation->set_rules('blog_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('blog_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('blog_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('blog_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('blog_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$config['upload_path'] 		= './uploads/blog';
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
								'blog_title' 		=> $this->input->post('blog_title'),
								'blog_slug' 		=> url_title($this->input->post('blog_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'blog_link' 		=> $this->input->post('blog_link'),
								'blog_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'blog_description' 	=> $this->input->post('blog_description'),
								'blog_type' 		=> $this->input->post('blog_type'),
								'blog_date' 		=> date('Y-m-d',strtotime($this->input->post('blog_date')))
								);
				
				$this->model_utama->insert_data('blog', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data blog';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/blog/add', 'refresh');
			}
			else
			{
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function delete($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data blog dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'blog_id','blog');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/blog');
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah blog | '.$judul;
			$data['heading'] 		= 'Update blog';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('index.php/admin/blog/update_process');

			$wew = $this->model_utama->get_detail($kode, 'blog_id', 'blog')->row();
			$this->session->set_userdata('kd_weleh', $wew->blog_id);
			
			$data['default']['blog_title'] 			= $wew->blog_title;		
			$data['default']['blog_description']	= $wew->blog_description;	
			$data['default']['blog_link']			= $wew->blog_link;	
			$data['default']['blog_type']			= $wew->blog_type;	
			$data['default']['blog_picture'] 		= $wew->blog_picture;
			$data['default']['blog_id'] 			= $wew->blog_id;
			$data['default']['category_id']			= $wew->category_id;
			$data['default']['subcategory_id'] 		= $wew->subcategory_id;
			$data['default']['blog_date'] 			= date('m/d/Y',strtotime($wew->blog_date));
			
			$data['page']			= 'admin/blog/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data blog dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah blog | '.$judul;
			$data['heading'] 		= 'Update blog';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('index.php/admin/blog/update_process');

			
			$this->form_validation->set_rules('blog_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('blog_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('blog_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('blog_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('blog_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');

			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'blog_id', 'blog')->row();	
				
				$config['upload_path'] 		= './uploads/blog';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= $wew->blog_picture;
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array ('blog_title' 		=> $this->input->post('blog_title'),
								'blog_slug' 		=> url_title($this->input->post('blog_title'), 'dash', TRUE),
								'user_id'	 		=> $user_id,
								'blog_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->input->post('category_id'),
								'subcategory_id' 	=> $this->input->post('subcategory_id'),
								'blog_link' 		=> $this->input->post('blog_link'),
								'blog_description' 	=> $this->input->post('blog_description'),
								'blog_type' 		=> $this->input->post('blog_type'),
								'blog_date' 		=> date('Y-m-d',strtotime($this->input->post('blog_date')))
								);
				
				$this->model_utama->update_data($this->input->post('blog_id'),'blog_id','blog',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data blog dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/blog/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/blog/');
			}
			else
			{
				$data['page']			= 'admin/blog/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	

}

