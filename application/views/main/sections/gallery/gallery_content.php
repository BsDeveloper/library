<header class="bs-header1">
	<h1>Album Galeri Foto <span class="hilight">Baba Studio</span></h1>
	<p>
		Mau tahu suasana nyamannya berlajar di Baba Studio? Siapa saja sih yang pernah kursus di Baba Studio?
	</p>
</header>

<?php if($galeri_list->num_rows() > 0) : ?>
<div class="row masonry-grid">
	<?php foreach($galeri_list->result() as $row) : ?>
	<div class="col col-4">
		<div class="photo-gallery">
			<div class="photo-img">
				<div class="thumb">
					<img src="<?php echo base_url()?>uploads/galeri/<?php echo $row->galeri_slug?>/thumb/<?php echo $row->galeri_picture; ?>">
				</div>
				<a href="<?php echo site_url('galeri/'.$row->galeri_slug)?>" class="photo-link">
					<i class="fa fa-plus"></i>
				</a>
			</div>
			<div class="photo-desc">
				<img class="icon" src="<?php echo base_url()?>assets/front_page/img/icon/general/gallery_photo.png">
				<a class="title" href="<?php echo site_url('galeri/'.$row->galeri_slug)?>"><?php echo $row->galeri_title?></a>
				<div class="time"><?php echo date('d F Y',strtotime($row->create_date))?></div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<div class="pagination">
	<?php echo $this->pagination->create_links();?>
</div>