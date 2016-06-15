<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class agenda extends CI_Controller {
	
	public function index()
	{	
		$limit 			= 5;
		$judul			= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		
		$data['judul'] 		= 'Halaman Agenda | '.$judul;
		$data['page']		= 'main/agenda/page_content';
		$log['activity']	= "lihat halaman agenda ";
		
		$data['ticker_list']	= $this->model_utama->get_order_limit('create_date','desc',5,'ticker');
		$data['banner_list']	= $this->model_utama->cek_data('inside','banner_category','banner');
		$data['agenda_list']	= $this->model_utama->get_order_limit('create_date','desc',$limit,'agenda');

		$this->load->library('pagination');

		$config['full_tag_open'] 	= '<ul class="pagination pagination-sm"> ';
		$config['full_tag_close'] 	= '</ul>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a href="">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';

		$config['base_url'] 		= base_url().'agenda';
		$config['total_rows'] 		= $this->db->query("select count(*) as total from agenda ")->row()->total;
		$config['per_page'] 		= $limit; 
		$config['uri_segment'] 		= 2;

		$this->pagination->initialize($config); 

		if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
		{
			$start 					= $this->security->xss_clean($this->uri->segment(2));
			$data['agenda_list']	= $this->db->query("select * from agenda order by create_date desc limit $start,$limit");
			$log['activity']		= "lihat halaman agenda halaman ke $start";
		}
		else
		{
			$agenda_slug	= $this->security->xss_clean($this->uri->segment(2));
			$agenda 		= $this->model_utama->cek_data($agenda_slug,'agenda_slug','agenda');

			if($agenda->num_rows() > 0)
			{
				$data['agenda']		= $agenda = $agenda->row();
				$data['judul'] 		= ''.ucwords($agenda->agenda_title).' | '.$judul;
				$data['page']		= 'main/agenda/page_content_view';
				$log['activity']	= "lihat halaman agenda - $agenda->agenda_title ";
			}
		}


		$this->load->view('main/template', $data);

		$this->load->library('user_agent');
		if ($this->agent->is_referral())
		{
			$log['ip_address']		= $this->input->ip_address();
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