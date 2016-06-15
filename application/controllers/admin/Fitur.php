<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class fitur extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola Fitur | '.$judul;
			$data['heading'] 		= "Fitur";
			$data['page']			= 'admin/fitur/page_list';
			$data['fitur_list']	= $this->model_utama->get_order('create_date','desc','fitur');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat fitur";
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
			$data['title'] 			= 'Halaman Tambah Fitur | '.$judul;
			$data['heading'] 		= 'Add Fitur List';
			$data['form_action'] 	= site_url('index.php/admin/fitur/add_process');
			$data['fitur_list']	= $this->model_utama->get_order('create_date','desc','fitur');
			$data['page']			= 'admin/fitur/page_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data fitur';
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
			$data['title'] 			= 'Halaman Tambah Fitur | '.$judul;
			$data['heading'] 		= 'Add Fitur List';
			$data['fitur_list']	= $this->model_utama->get_order('create_date','desc','fitur');
			$data['form_action'] 	= site_url('index.php/admin/fitur/add_process');
			$data['page']			= 'admin/fitur/page_form';

			
			$this->form_validation->set_rules('fitur_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('fitur_function', 'Fitur', 'required|min_length[1]|max_length[255]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$weleh = array (
								'fitur_title' 			=> $this->input->post('fitur_title'),
								'fitur_slug' 			=> url_title($this->input->post('fitur_title'), 'dash', TRUE),
								'fitur_function' 		=> $this->input->post('fitur_function'),
								'create_date'				=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->insert_data('fitur', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data fitur';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/fitur/add', 'refresh');
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
			$log['activity']			= 'hapus data fitur dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'fitur_id','fitur');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/fitur');
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
			$data['title'] 			= 'Halaman Ubah Fitur | '.$judul;
			$data['heading'] 		= 'Update Fitur';
			$data['form_action'] 	= site_url('index.php/admin/fitur/update_process');

			$wew = $this->model_utama->get_detail($kode, 'fitur_id', 'fitur')->row();
			$this->session->set_userdata('kd_weleh', $wew->fitur_id);
			
			$data['default']['fitur_title'] 		= $wew->fitur_title;		
			$data['default']['fitur_id'] 			= $wew->fitur_id;
			
			$data['page']			= 'admin/fitur/page_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data fitur dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah Fitur | '.$judul;
			$data['heading'] 		= 'Update Fitur';
			$data['form_action'] 	= site_url('index.php/admin/fitur/update_process');

			
			$this->form_validation->set_rules('fitur_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('fitur_function', 'Fitur', 'required|min_length[1]|max_length[255]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$weleh = array (
								'fitur_title' 			=> $this->input->post('fitur_title'),
								'fitur_slug' 			=> url_title($this->input->post('fitur_title'), 'dash', TRUE),
								'fitur_function' 		=> $this->input->post('fitur_function'),
								'update_date'				=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->update_data($this->input->post('fitur_id'),'fitur_id','fitur',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data fitur dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/fitur/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/fitur/');
			}
			else
			{
				$data['page']			= 'admin/fitur/page_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	

}

