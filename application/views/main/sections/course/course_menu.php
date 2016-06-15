<section class="course-menu blink_me">
	<div class="container">

		<div class="menu-inner">
			<div class="menu-group">
				<div class="owl-menu-prev">
					<i class="fa fa-angle-left"></i>
				</div>

				<div id="owl-course-menu" class="owl-carousel">

					<div class="item">
						<a class="menu <?php if($this->uri->segment(2) == 'kursus-website') : ?>active<?php endif; ?>" href="<?php echo site_url('training/kursus-website')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (1).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Kursus Website</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(2) == 'kursus-web-design') : ?>active<?php endif; ?>" href="<?php echo site_url('training/kursus-web-design')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (2).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Kursus Web Design</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(2) == 'kursus-php') : ?>active<?php endif; ?>" href="<?php echo site_url('training/kursus-php')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (1).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Kursus PHP</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(1) == 'kursus-komputer') : ?>active<?php endif; ?>" href="<?php echo site_url('kursus-komputer')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (3).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Kursus Komputer</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(1) == 'training' && $this->uri->segment(2) == 'kursus-internet-marketing') : ?>active<?php endif; ?>" href="<?php echo site_url('training/kursus-internet-marketing/')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (4).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Internet Marketing</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(1) == 'kursus-seo') : ?>active<?php endif; ?>" href="<?php echo site_url('kursus-seo/')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (5).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Kursus SEO</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(1) == 'kursus-animasi-drawing') : ?>active<?php endif; ?>" href="<?php echo site_url('kursus-animasi-drawing/')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (6).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Animasi Drawing</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(1) == 'kursus-flash-animasi') : ?>active<?php endif; ?>" href="<?php echo site_url('kursus-flash-animasi/')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (6).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Kursus Flash Animasi</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(1) == 'kursus-game') : ?>active<?php endif; ?>" href="<?php echo site_url('kursus-game/')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (3).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Kursus Game</div>
								</div>
							</div>
						</a>
					</div>

					<div class="item">
						<a class="menu <?php if($this->uri->segment(1) == 'kursus-desain-grafis') : ?>active<?php endif; ?>" href="<?php echo site_url('kursus-desain-grafis/')?>">
							<div class="icon">
								<img src="<?php echo base_url()?>assets/front_page/img/icon/course_menu/icon (2).png">
							</div>
							<div class="title">
								<div class="vc-table">
									<div class="vc-cell">Kursus Desain Grafis</div>
								</div>
							</div>
						</a>
					</div>

				</div>	

				<div class="owl-menu-next">
					<i class="fa fa-angle-right"></i>
				</div>	
			</div>
			
		</div>
		
	</div>
</section>

<style type="text/css">
	.blink_me {
		z-index: 500;
	}
</style>
<script type="text/javascript">
	function blinker() {
	    $('.blink_me').fadeOut(250);
	    $('.blink_me').fadeIn(250);
	    $('.blink_me').fadeOut(250);
	    $('.blink_me').fadeIn(250);
	}

	setTimeout(blinker, 5000);
	setTimeout(blinker, 10000);
	// clearInterval(intervalId);

</script>