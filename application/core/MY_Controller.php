<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set ('Asia/Jakarta');
/*===============================================
	3.	LOG VISITOR
	4.	SEND EMAIL
	6.	MINIFY
===============================================*/
class MY_Controller extends CI_Controller {
	
	
	
	/*===============================================
		3.	LOG VISITOR
	===============================================*/
	function log_visitor($action){
		$this->load->model('model_utama','',TRUE);
		$this->load->helper('date');
		$this->load->library('user_agent');
		$table 		= 'log_visitor';
		$array_data = 	array(
							'ip_address'		=> 	$_SERVER['HTTP_USER_AGENT'],
							'activity'			=> 	$action,
							'browser'			=> 	$this->agent->browser(), 
  							'version'			=> 	$this->agent->version(), 
							'mobile'			=> 	$this->agent->mobile(), 
							'robot'				=>	$this->agent->robot(),
							'platform'			=>  $this->agent->platform(),
							'create_date'		=> 	date('Y-m-d H:i:s',now()),
							'user_id'			=> 	$this->session->userdata('user_id')
							);
		$query = $this->model_utama->insert_data($table,$array_data);
	}
	
	
	/*===============================================
		4.	SEND EMAIL
	===============================================*/
	function send_email($from,$recipient,$subject,$message){
		
		$config = Array(
						'mailtype'  => 'html'
						);
		
		$this->load->library('email',$config);
		$this->email->from($from, 'Babastudio');
		$this->email->to($recipient);
		$this->email->subject($subject);
		
		$this->email->message($message);
		
		
		if( $this->email->send() ){
			return true;	
		}else{
			return false;	
		}
	}

	/*===============================================
		6.	MINIFY
	===============================================*/
	public function minify($empty_cache=false){
		
		/*====================================================
			1.	LOAD LIBRARY
		====================================================*/
		$this->load->library('carabiner');
		
		$carabiner_config = array(
								'script_dir' => 'assets/front_page/js/', 
								'style_dir'  => 'assets/front_page/',
								'cache_dir'  => 'assets/cache/',
								'base_uri'	 => base_url(),
								'dev' 		 => FALSE,
								'combine'	 => TRUE,
								'minify_js'  => TRUE,
								'minify_css' => TRUE
							);
		$this->carabiner->config($carabiner_config);
		
		/*====================================================
			2. 	CLEAR CACHE
		====================================================*/
		if( $empty_cache ){
			$this->carabiner->empty_cache();
		}
		
		/*====================================================
			3.	MINIFY CSS
		====================================================*/
		$this->carabiner->css('css/normalize.css');
		$this->carabiner->css('css/font-awesome.min.css');
		$this->carabiner->css('css/animate.min.css');
		$this->carabiner->css('css/bttrlazyload.css');
		$this->carabiner->css('css/style.css');	
		$this->carabiner->css('css/custom.css');		

		$this->carabiner->css('js/plugin/carousel/owl.carousel.css');
		$this->carabiner->css('js/plugin/colorbox/colorbox.css');
		$this->carabiner->css('js/plugin/tooltipster/tooltipster.css');
	
		/*====================================================
			4.	MINIFY JS
		====================================================*/
		$this->carabiner->js('jquery.min.js');
		$this->carabiner->js('script.js');
		$this->carabiner->js('bttrlazyload.js');
		$this->carabiner->js('bttrlazyload-init.js');

		$this->carabiner->js('plugin/imagesloaded.pkgd.min.js');
		$this->carabiner->js('plugin/carousel/owl.carousel.min.js');	
		$this->carabiner->js('plugin/jquery.stellar.min.js');
		$this->carabiner->js('plugin/jquery.viewportchecker.js');
		$this->carabiner->js('plugin/jquery.scrollTo.min.js');
		$this->carabiner->js('plugin/jquery.nicescroll.min.js');
		$this->carabiner->js('plugin/colorbox/jquery.colorbox-min.js');
		$this->carabiner->js('plugin/tooltipster/jquery.tooltipster.min.js');
		$this->carabiner->js('plugin/masonry.pkgd.min.js');
		$this->carabiner->js('plugin/modulo-columns.js');

		// ie fix
		// $array_js 	= array('ie/html5shiv.min.js','ie/respond.min.js','ie/selectivizr-min.js');
		// $array_css 	= array();
		// $this->carabiner->group('iefix',array('js' => $array_js, 'css' => $array_css));


		/*====================================================
			5.	DISPLAY CSS / JS
				ON , VIEW
				<?php echo $this->carabiner->display('css'); ?>
				<?php echo $this->carabiner->display('js'); ?>
				
				result
				=====================
				<link ... />
		====================================================*/
	}
	
}