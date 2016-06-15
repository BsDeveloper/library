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
		if($this->session->userdata('login_admin') == true)
		{
			$admin_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Beranda | '.$judul;
			$data['heading'] 		= 'Dashboard Beranda';
			$data['page']			= 'admin/page_dashboard';
			$data['visitor_list']	= $this->db->query("select *,count(*) as total from log_visitor where month(create_date) = month(now()) group by date(create_date)");
			$data['new_user_list']	= $this->db->query("select * from user order by user_id desc limit 10");
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat dashboard";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function bonus_voucher()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$admin_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Beranda | '.$judul;
			$data['heading'] 		= 'Dashboard Beranda';
			$data['page']			= 'admin/dashboard/page_bonus';
			$data['bulan_ini_list']	= $this->model_utama->cek_order('bulan_ini','tipe','create_date','desc','bonus_voucher');
			$data['bulan_depan_list']	= $this->model_utama->cek_order('bulan_depan','tipe','create_date','desc','bonus_voucher');
			$data['banner_gratis_list']	= $this->model_utama->cek_order('banner_gratis_materi','tipe','create_date','desc','bonus_voucher');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat dashboard";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
}

