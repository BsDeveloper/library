<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class kursus extends MY_Controller {

	// public function index()
	// {	
	// 	$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
	// 	$data['judul'] 		= 'Daftar Kursus Gratis | '.$judul;
	// 	$data['header']		= 'Daftar Kursus';
	// 	$data['page']		= 'main/kursus/page_content';
	// 	$this->minify();
	// 	$data['kursus_list']	= $this->model_utama->get_order('create_date','desc','kursus');


	// 	$this->load->view('main/template', $data);

	// 	$this->load->library('user_agent');
		
	// 	if ($this->agent->is_referral())
	// 	{
	// 		$log['ip_address']		= $this->input->ip_address();
	// 		$log['activity']		= "lihat halaman kursus gratis ";
	// 	    $log['referral']		= $this->agent->referrer();
	// 		$log['browser']			= $this->agent->browser();
	// 		$log['version']			= $this->agent->version();
	// 		$log['mobile']			= $this->agent->mobile();
	// 		$log['robot']			= $this->agent->robot();
	// 		$log['platform']		= $this->agent->platform();
	// 		$this->model_utama->insert_data('log_visitor', $log);
	// 	}
		
	// }

	function index()
	{
		echo 'Under maintenance';
	}

	function learn($slug)
	{
		if($this->session->userdata('login_user') == true)
		{
			$user_id 				= $this->session->userdata('id_user');

			$cek_kursus 			= $this->model_utama->cek_data($slug,'kursus_slug','kursus');
			if($cek_kursus->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', 'Periksa kembali url yang Anda masukkan!');	
				redirect('dashboard');
			}

			$kursus 				= $cek_kursus->row();

			$cek_user_kursus		= $this->model_utama->cek_data2($kursus->kursus_id,$user_id,'kursus_id','user_id','user_kursus');
			if($cek_user_kursus->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', 'Anda belum mengambil kursus ini, ambil terlebih dahulu!');	
				redirect('detail/'.$kursus->kursus_slug);
			}

			
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['judul'] 			= ucwords($kursus->kursus_title).' | '.$judul;
			$data['header'] 		= ucwords($kursus->kursus_title);
			$data['page']			= 'main/kursus/page_list';

			$data['modul_list']		= $this->model_utama->cek_order($kursus->kursus_id,'kursus_id','modul_order','asc','modul');

			$this->load->view('main/template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat materi list kursus ".$slug." kode : ".$kursus->kursus_id;
			$this->model_utama->insert_data('log_user', $log);

		}
		else
		{
			redirect('login');
		}
	}

	function view($slug)
	{
		if($this->session->userdata('login_user') == true)
		{
			$user_id 				= $this->session->userdata('id_user');

			$cek_sub_modul 			= $this->model_utama->cek_data($slug,'sub_modul_slug','sub_modul');
			if($cek_sub_modul->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', 'Periksa kembali url yang Anda masukkan!');	
				redirect('dashboard');
			}

			$sub_modul = $cek_sub_modul->row();

			$cek_modul 			= $this->model_utama->cek_data($sub_modul->modul_id,'modul_id','modul');
			if($cek_modul->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', 'Periksa kembali url yang Anda masukkan!');	
				redirect('dashboard');
			}

			$modul 				= $cek_modul->row();

			$cek_user_kursus		= $this->model_utama->cek_data2($modul->kursus_id,$user_id,'kursus_id','user_id','user_kursus');
			if($cek_user_kursus->num_rows() == 0)
			{
				$this->session->set_flashdata('danger', 'Anda belum mengambil kursus ini, ambil terlebih dahulu!');	
				redirect('detail/'.$kursus->kursus_slug);
			}

			
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['judul'] 			= ucwords($sub_modul->sub_modul_title).' - '.ucwords($modul->modul_title).' | '.$judul;
			$data['header'] 		= ucwords($sub_modul->sub_modul_title).' - '.ucwords($modul->modul_title);
			$data['page']			= 'main/kursus/page_view';

			$data['sub_modul']		= $sub_modul;
			$data['modul_list']		= $this->model_utama->cek_order($modul->kursus_id,'kursus_id','modul_order','asc','modul');

			$this->load->view('main/template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat sub_modul ".$sub_modul->sub_modul_id. " pada modul : ".$modul->modul_id;
			$this->model_utama->insert_data('log_user', $log);

		}
		else
		{
			redirect('login');
		}
	}

	function load()
	{
		echo 'Under maintenance';
	}
}