<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class blog extends CI_Controller {
	
	public function index()
	{	
		$limit 			= 6;
		$judul			= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		
		$data['judul'] 		= 'Halaman blog | '.$judul;
		$data['page']		= 'main/blog/page_content';
		$log['activity']	= "lihat halaman blog ";
		
		$data['category_list']	= $this->model_utama->get_order_limit('create_date','desc',3,'category');
		$data['blog_list']	= $this->model_utama->get_order_limit('create_date','desc',$limit,'blog');

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

		$config['base_url'] 		= base_url().'blog';
		$config['total_rows'] 		= $this->db->query("select count(*) as total from blog ")->row()->total;
		$config['per_page'] 		= $limit; 
		$config['uri_segment'] 		= 2;

		$this->pagination->initialize($config); 

		if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
		{
			$start 					= $this->security->xss_clean($this->uri->segment(2));
			$data['blog_list']		= $this->db->query("select * from blog order by create_date desc limit $start,$limit");
			$log['activity']		= "lihat halaman blog halaman ke $start";
		}
		else
		{
			$blog_slug	= $this->security->xss_clean($this->uri->segment(2));
			$blog 		= $this->model_utama->cek_data($blog_slug,'blog_slug','blog');

			if($blog->num_rows() > 0)
			{
				$data['blog']		= $blog = $blog->row();
				$data['previous']	= $this->db->query("select * from blog where blog_id < '$blog->blog_id' order by blog_id desc limit 1");
				$data['next']		= $this->db->query("select * from blog where blog_id > '$blog->blog_id'  order by blog_id asc limit 1");
				$data['comment_list']	= $this->db->query("select * from comment where blog_id = '$blog->blog_id'  order by create_date desc");
				$data['comment_count']	= $this->db->query("select count(*) as total from comment where blog_id = '$blog->blog_id' ")->row()->total;
				$data['judul'] 		= ''.ucwords($blog->blog_title).' | '.$judul;
				$data['page']		= 'main/blog/page_content_view';
				$log['activity']	= "lihat halaman blog - $blog->blog_title ";
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