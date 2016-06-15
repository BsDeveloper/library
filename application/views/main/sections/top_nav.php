<div class="inner-nav">
	<!-- Logo -->
	<div href="#" class="logo">
		<a href="<?php echo base_url()?>">
			<img class="img-logo" src="<?php echo base_url()?>assets/front_page/img/icon/logo.png" width="264" height="50">
		</a>
		<img class="shape-header" src="<?php echo base_url()?>assets/front_page/img/shape/shape_header-min.png">
	</div>
	<!-- End Logo -->
	<!-- Navigation -->
	<div class="search-form" >
		<?php /*
		<form class="search-box" action="#" method="POST">
			<div class="input-group">
				<i class="fa fa-search"></i>
				<input class="search-input" type="text" placeholder="To search type and hit enter">	
			</div>
			
		</form>
		<div class="search-nav" href="#">
			<i class="fa fa-search"></i>
		</div>
		*/ ?>

		<div class="navicon-group">
			<div id="navicon1" class="navicon" >
				<i class="fa fa-ellipsis-v"></i>
			</div>
			<?php /*
			<div id="navicon2" class="navicon">
				<i class="fa fa-phone"></i>
			</div>	*/ ?>
		</div>
	</div>

	<div class="nav">
		<ul class="nav-menu">
			<li><a href="<?php echo site_url('tentang-kami')?>">Tentang Kami</a></li>
			<?php /*
			<!-- <li><a href="<?php echo site_url('peta-situs')?>">PETA SITUS</a></li> -->
			<!-- <li><a href="<?php echo site_url('faq')?>">FAQ</a></li> -->
			*/ ?>
			<li><a href="http://www.babastudio.com/member/login">Login</a></li>
			<li><a href="javascript:;"><i class="fa fa-phone"></i>&nbsp;&nbsp;(021) 5366 4008</a></li>
		</ul>
		<ul class="btn-social">
			<li>
				<a id="btn-free" class="btn-free-course btn-hilight bs-tip" 
					href="<?php echo base_url()?>free_course"
					title="Klik &amp; Dapatkan Kursus Gratis!">
					Free E-learning
				</a>
			</li>
		</ul>
	</div>
	<!-- End Navigation -->
	<?php /*
	<div class="phone-number">
		<div class="phone-wrap">
			<span>Jakarta (021)5366 4008</span>
			<span>Bekasi (021)8241 9969</span>
			<span>Surabaya (031)5913 519</span>
		</div>
	</div>	*/ ?>
</div>