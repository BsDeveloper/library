<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class feed extends MY_Controller {
	
	function index()
    {
    	$this->load->helper('xml');
        $this->load->helper('text');

        $data['feed_name']			= 'BabaStudio.com';
        $data['encoding'] 			= 'utf-8';
        $data['feed_url'] 			= site_url('feed');
        $data['page_description'] 	= 'What my site is about comes here';
        $data['page_language'] 		= 'en-en';
        $data['creator_email'] 		= 'info@babastudio.com';
        $data['posts'] 				= $this->model_utama->get_limit(10,'blog');
        $this->output->set_header("Content-Type: application/rss+xml");
         
        $this->load->view('main/rss', $data);
    }


	
	
}