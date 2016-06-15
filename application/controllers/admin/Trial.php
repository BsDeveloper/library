<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class trial extends MY_Controller {

	function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$admin_id 					= $this->session->userdata('id_user');
			$judul						= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 				= 'Halaman Trial | '.$judul;
			$data['heading'] 			= 'Daftar trial';
			$data['page']				= 'admin/trial/page_content';
			$data['popup_trial_list']	= $this->model_utama->get_order('create_date','desc','popup_trial');
			$this->load->view('template', $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat trial";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
}

