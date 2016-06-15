<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo ucwords($judul)?></title>
	<meta name="description" content="Kursus Website Terbaik 2015 di Jakarta dan Bekasi dengan pilihan paket Kursus Website, Komputer, Office, Graphic Design, Web Design, Web Programming, SEO, Web Animation. Materi yang diajarkan adalah HTML, CSS, Javascript, Photoshop, PHP, Codeigniter, Ajax, jQuery, Flash, Actionscript 3.0, Search Engine Optimization, Java Fundamental, Java Android, J2SE, J2EE, Visual Basic (VB), Wordpress, Joomla, Exel, Word, Powerpoint, Adobe inDesign, Adobe Illustrator, Toko Online, Internet Marketing, Social Media, Facebook, Twitter, dan Online Branding."/>
	<meta name="keywords" content="Kursus Komputer Jakarta, Kursus Komputer, Kursus Javascript, Provider Pelatihan IT, Jasa Pembuatan Website di Jakarta, Kursus IT Training, Kursus Ajax, Kursus Multimedia, Kursus Web Programming, Kursus SEO, Kursus Internet Marketing, Kursus Photoshop, Kursus CSS, Kursus HTML, Kursus PHP, Kursus Games, Kursus Animasi Flash, Kursus Membuat Website, Kursus Web Design, Kursus Desain Web, Kursus IT, Kursus Komputer, Kursus Website"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!-- Faficon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>assets/front_page/img/icon/favicon.ico">
	<link rel="icon" type="image/png" href="<?php echo base_url()?>assets/front_page/img/icon/favicon.png">
	<link rel="apple-touch-icon" href="<?php echo base_url()?>assets/front_page/img/icon/favicon.png">
	<!-- End Faficon -->
	<!-- CSS -->
	<?php echo $this->carabiner->display('css'); ?>

</head>
<body>
	<div id="viewport-indicator"></div>
	<div id="preloader"></div>
	<!-- Site Wrapper -->
	<div class="wrapper remodal-bg">
		<!-- HEADER -->
		<section id="main-header">
		<?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') : ?>
			<?php $this->load->view('main/sections/navbar'); ?>
			<?php $this->load->view('main/sections/beranda/hero'); ?>
		<?php else : ?>
			<?php $this->load->view('main/sections/navbar2'); ?>
			<?php if($this->uri->segment(1) == 'terima-kasih') : ?>			
				<?php $this->load->view('main/sections/optin/hero_optin'); ?>
			<?php elseif($this->uri->segment(1) == 'jasa-website') : ?>
				<?php $this->load->view('main/sections/service2/hero_web'); ?>
			<?php elseif($this->uri->segment(1) == 'jasa-aplikasi') : ?>
				<?php $this->load->view('main/sections/service2/hero_app'); ?>
			<?php else : ?>
				<?php $this->load->view('main/sections/hero2'); ?>
			<?php endif; ?>
		<?php endif; ?>
		</section>
		<!-- END HEADER -->

		<!-- CONTENT -->
		<section id="main-content">
			<?php $this->load->view($page)?>
		</section>
		<!-- END CONTENT -->

		<!-- MAIN FOOTER -->
		<section id="main-footer">
			<!-- Footer -->
			<?php $this->load->view('main/sections/footer'); ?>
			<!-- End Footer -->
		</section>
		<!-- END MAIN FOOTER -->

	</div>


	<?php
	if($this->uri->segment(1) != 'terima-kasih') {
		$this->load->view('main/sections/course/popup_trial'); 
	}
	?>

	<!-- End Site Wrapper -->
	<!-- Javascript -->	
	
	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/ie/html5shiv.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/ie/respond.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/ie/selectivizr-min.js"></script>
	<![endif]-->
	<?php echo $this->carabiner->display('js'); ?>

	<?php /*
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/imagesloaded.pkgd.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/carousel/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/jquery.stellar.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/jquery.viewportchecker.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/jquery.scrollTo.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/jquery.nicescroll.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/colorbox/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/tooltipster/jquery.tooltipster.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/plugin/masonry.pkgd.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/script.js"></script>
	*/ ?>
	<!-- End Javascript -->
	<div class="clearfix"></div>
	<?php $this->load->view('main/analytics'); ?>
</body>
</html>