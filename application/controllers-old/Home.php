<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Home extends MY_Controller {
	
	public function index()
	{	
		$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['judul'] 		= 'Beranda | '.$judul;
		$data['page']		= 'main/home/page_content';
		$this->minify();

		$data['category_list']	= $this->model_utama->get_order_limit('create_date','desc',3,'category');
		$data['slider_list']	= $this->model_utama->get_order_limit('slider_id','asc',3,'slider');
		$data['blog_list']	= $this->model_utama->get_order_limit('create_date','desc',3,'blog');

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
	
	
	
}