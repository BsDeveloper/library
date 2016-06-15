<?php $this->load->view('main/sections/course/course_menu'); ?>
<section class="main-gallery bg-ticks ptb-60">
	<div class="container">
		<header class="bs-header1">
			<h1>Album Galeri Foto "<span class="hilight"><?php echo $galeri->galeri_title?></span>"</h1>
			
		</header>
		<div class="row">
			<center>
			<div class="photo-img">
				<img class="img-responsive" src="<?php echo base_url()?>uploads/galeri/<?php echo $galeri->galeri_slug?>/<?php echo $galeri->galeri_picture?>" alt="<?php echo ucwords($galeri->galeri_title)?>" />
			</div>
			<p>
				<?php echo $galeri->galeri_description?>
			</p>
			</center>
		</div>

		<?php if($galeri_picture_list->num_rows() > 0) : ?>
		<div class="row masonry-grid">
			<?php foreach($galeri_picture_list->result() as $row) : ?>
			<div class="col col-4">
				<div class="photo-gallery">
					<div class="photo-img">
						<div class="thumb">
							<img src="<?php echo base_url()?>uploads/galeri/<?php echo $galeri->galeri_slug?>/<?php echo $row->galeri_picture_picture; ?>">
						</div>
					</div>
					<div class="photo-desc">
						<img class="icon" src="<?php echo base_url()?>assets/front_page/img/icon/general/gallery_photo.png">
						<?php echo $row->galeri_picture_title?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>