<section class="navbar">

	<div class="top-nav">
		<div class="bg-top-nav"></div>
		<div class="container">
			<?php $this->load->view('main/sections/top_nav')?>
		</div>
	</div>
			
	<div class="main-nav">
		<?php $this->load->view('main/sections/main_nav')?>
	</div>	

	<?php /*
	<div class="breadcrumb">
		<div class="container">
			<ul>
				<li><a href="<?php echo base_url()?>">Beranda</a></li>
				<li><a href="#"><?php echo isset($header) && $header != '' ? $header : ''; ?></a></li>
			</ul>			
		</div>
	</div>
	*/ ?>

</section>
