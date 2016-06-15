<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class category extends CI_Controller {
	
	public function index()
	{	
		$limit 			= 6;
		$judul			= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		
		$data['judul'] 		= 'Halaman Kategori | '.$judul;
		$data['page']		= 'main/blog/page_content';
		$log['activity']	= "lihat halaman blog ";
		
		$data['category_list']	= $this->model_utama->get_order_limit('create_date','desc',3,'category');

		$category_slug	= $this->security->xss_clean($this->uri->segment(2));
		$category 		= $this->model_utama->cek_data($category_slug,'category_slug','category');

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

		if($category->num_rows() > 0)
		{
			$category 			= $category->row();
			$data['judul'] 		= ''.ucwords($category->category_title).' | '.$judul;
			$log['activity']	= "lihat halaman category - $category->category_title ";
			

			$config['base_url'] 		= base_url().'category/'.$category->category_slug;
			$config['total_rows'] 		= $this->db->query("select count(*) as total from blog where category_id = '$category->category_id' ")->row()->total;
			$config['per_page'] 		= $limit; 
			$config['uri_segment'] 		= 3;

			if(is_numeric($this->security->xss_clean($this->uri->segment(3))))
			{
				$start 					= $this->security->xss_clean($this->uri->segment(3));
				$data['blog_list']		= $this->db->query("select * from blog where category_id = '$category->category_id' order by create_date desc limit $start,$limit");
				$log['activity']		= "lihat halaman blog halaman ke $start";
			}
			else
			{
				$data['blog_list']	= $this->model_utama->cek_order_limit($category->category_id,'category_id','create_date','desc',$limit,'blog');	
			}
		}
		else
		{
			$data['blog_list']	= $this->model_utama->get_order_limit('create_date','desc',$limit,'blog');

			$config['base_url'] 		= base_url().'blog';
			$config['total_rows'] 		= $this->db->query("select count(*) as total from blog ")->row()->total;
			$config['per_page'] 		= $limit; 
			$config['uri_segment'] 		= 2;
		}				

		$this->pagination->initialize($config); 

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