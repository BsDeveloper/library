<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class dashboard extends MY_Controller {

	
	public function index()
	{	
		if($this->session->userdata('login_user') == true)
		{
			$user_id 			= $this->session->userdata('id_user');
			$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['judul'] 		= 'Dashboard | '.$judul;
			$data['page']		= 'main/dashboard/page_view';
			$data['header']		= 'Dashboard';
			$this->minify();
			$data['kursus_list']= $this->model_utama->cek_data($user_id,'user_id','user_kursus');


			$this->load->view('main/template', $data);

			$this->load->library('user_agent');
			
			if ($this->agent->is_referral())
			{
				$log['ip_address']		= $this->input->ip_address();
				$log['activity']		= "lihat halaman Home ";
			    $log['referral']		= $this->agent->referrer();
				$log['browser']			= $this->agent->browser();
				$log['version']			= $this->agent->version();
				$log['mobile']			= $this->agent->mobile();
				$log['robot']			= $this->agent->robot();
				$log['platform']		= $this->agent->platform();
				$this->model_utama->insert_data('log_visitor', $log);
			}
		}
		else
		{
			redirect('login');
		}
		
	}


	
	
}