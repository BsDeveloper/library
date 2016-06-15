<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class entries extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola entries | '.$judul;
			$data['heading'] 		= "Data entries ";
			$data['page']			= 'admin/page_entries';
			$data['entries_list']	= $this->model_utama->get_order('create_date','desc','entries');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat entries";
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
			$data['title'] 			= 'Halaman Tambah entries | '.$judul;
			$data['heading'] 		= 'Tambah entries ';
			$data['form_action'] 	= site_url('index.php/admin/entries/add_process');
			$data['entries_list']	= $this->model_utama->get_order('create_date','desc','entries');
			$data['page']			= 'admin/page_entries_form';
			$this->load->view('template', $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data entries';
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
			$data['title'] 			= 'Halaman Tambah entries | '.$judul;
			$data['heading'] 		= 'Tambah entries ';
			$data['entries_list']	= $this->model_utama->get_order('create_date','desc','entries');
			$data['form_action'] 	= site_url('index.php/admin/entries/add_process');
			$data['page']			= 'admin/page_entries_form';

			
			$this->form_validation->set_rules('entries_title', 'Title', 'required|min_length[3]');
			$this->form_validation->set_rules('entries_content', 'Description', 'min_length[5]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				

				$weleh = array (
								'entries_title' 		=> $_POST['entries_title'],
								'entries_content' 		=> $_POST['entries_content']
								);
				
				$this->model_utama->insert_data('entries', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data entries';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/entries/add', 'refresh');
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
			$log['activity']			= 'hapus data entries dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'entries_id','entries');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/entries');
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
			$data['title'] 			= 'Halaman Ubah entries | '.$judul;
			$data['heading'] 		= 'Ubah entries';
			$data['form_action'] 	= site_url('index.php/admin/entries/update_process');

			$wew = $this->model_utama->get_detail($kode, 'entries_id', 'entries')->row();
			$this->session->set_userdata('kd_weleh', $wew->entries_id);
			
			$data['default']['entries_title'] 			= $wew->entries_title;		
			$data['default']['entries_content']	= $wew->entries_content;
			
			$data['page']			= 'admin/page_entries_form';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data entries dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah entries | '.$judul;
			$data['heading'] 		= 'Ubah entries';
			$data['form_action'] 	= site_url('index.php/admin/entries/update_process');

			
			$this->form_validation->set_rules('entries_title', 'Title', 'required|min_length[3]');
			$this->form_validation->set_rules('entries_content', 'Description', 'min_length[5]');
			
			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'entries_id', 'entries')->row();	
				
			
				$weleh = array ('entries_title' 		=> $_POST['entries_title'],
								'entries_content' 	=> $_POST['entries_content']
								);
				
				$this->model_utama->update_data($this->session->userdata('kd_weleh'),'entries_id','entries',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data entries dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/entries/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/entries/');
			}
			else
			{
				$data['page']			= 'admin/page_entries_form';
				$this->load->view('template', $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function view($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Lihat entries | '.$judul;
			$data['heading'] 		= 'Lihat entries';
			$data['form_action'] 	= site_url('index.php/admin/pages/update_process');

			$wew = $this->model_utama->get_detail($kode, 'entries_id', 'entries')->row();
			$this->session->set_userdata('kd_weleh', $wew->entries_id);
			
			$data['default']['entries_title'] 			= $wew->entries_title;		
			$data['default']['entries_content']	= $wew->entries_content;	
			$data['default']['entries_picture'] 		= $wew->entries_picture;
			$data['default']['update_date'] 			= $wew->update_date;
			$data['default']['user_id'] 				= $wew->user_id;
			$data['default']['entries_persentase'] 		= $wew->entries_persentase;

			
			$data['page']			= 'admin/page_entries_view';
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik lihat data entries dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
		

}

