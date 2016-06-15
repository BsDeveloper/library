<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class login extends CI_Controller {
	
	public function index()
	{	
		if($this->session->userdata('login_admin') == true)
		{
			redirect(base_url().'admin/dashboard');
		}
		if($this->session->userdata('login_user') == true)
		{
			redirect(base_url().'user/dashboard');
		}
		if($this->session->userdata('login_manager') == true)
		{
			redirect(base_url().'manager/dashboard');
		}
		else
		{
			$this->login_form();
		}
	}

	function error_404()
	{
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Page Not Found - Error 404 | '.$judul;
		$data['heading'] 		= 'Error 404 ';
		$this->load->view('page_404', $data);
	}

	
	function login_form()
	{
		$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['judul'] 		= 'Halaman Login | '.$judul;
		$this->load->view('login_form', $data);

		$this->load->library('user_agent');
		$log['ip_address']		= $this->input->ip_address();
		$log['activity']		= "lihat halaman login admin";
		$referral 				= '-';
		if ($this->agent->is_referral())
		{
		    $referral =  $this->agent->referrer();
		}
		$log['referral']		= $referral;
		$log['browser']			= $this->agent->browser();
		$log['version']			= $this->agent->version();
		$log['mobile']			= $this->agent->mobile();
		$log['robot']			= $this->agent->robot();
		$log['platform']		= $this->agent->platform();
		$this->model_utama->insert_data('log_visitor', $log);
	}
	
	function login_process()
	{
		$user = $this->input->post('signin_username');
		$pass = md5($this->input->post('signin_password'));
		
		$query = $this->model_utama->cek_data2($user,$pass,'username','password','user');		
				
		if($query->num_rows() > 0)
		{
			$pengguna = $query->row();
			
			if($pengguna->user_status == 'user')
			{
				$sess_data = array(
							   'id_user'  		=> $pengguna->user_id,
							   'login_user' 	=> TRUE
						   );
			}
			elseif($pengguna->user_status == 'admin')
			{
				$sess_data = array(
							   'id_user'  		=> $pengguna->user_id,
							   'login_admin' 	=> TRUE
						   );
			}
			elseif($pengguna->user_status == 'manager')
			{
				$sess_data = array(
							   'id_user'  		=> $pengguna->user_id,
							   'login_user' 	=> TRUE
						   );
			}
			$this->session->set_userdata($sess_data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'login';
			$this->model_utama->insert_data('log_user', $log);

			redirect(base_url().'login/index', 'refresh');
		}
			else{
				$this->session->set_flashdata('danger', 'Username atau password yang Anda masukkan salah!');
				redirect(base_url().'login', 'refresh');
			}
		
	}
 
	function logout()
	{
		$log['user_id']			= $this->session->userdata('id_user');
		$log['activity']		= 'logout';
		$this->model_utama->insert_data('log_user', $log);

		$this->session->sess_destroy();
		redirect(base_url().'admin', 'refresh');
	}

	
}