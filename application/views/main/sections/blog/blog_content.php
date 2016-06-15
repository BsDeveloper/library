<header class="content-title">
	<h5><?php echo strtoupper($header)?> <span class="light">WHAT'S NEW?</span></h5>
</header>
<?php /*
<?php if($this->uri->segment(1) == 'blog') : ?>
<div class="post-top">
	<article class="post">
		<div class="post-inner">
			<div class="post-owl-controls">
				<!-- Owl Controls Here -->
			</div>
			<a href="#">
				<div id="owl-post-top" class="owl-carousel">

					<div class="item">
						<div class="post-thumb">
							<div class="thumb">
								<img alt="kursus website, kursus internet marketing, kursus SEO" src="<?php echo base_url()?>assets/front_page/img/content/blog/blog (11).jpg">
							</div>	
						</div>
					</div>

					<div class="item">
						<div class="post-thumb">
							<div class="thumb">
								<img alt="kursus website, kursus internet marketing, kursus SEO" src="<?php echo base_url()?>assets/front_page/img/content/blog/blog (10).JPG">
							</div>	
						</div>
					</div>

					<div class="item">
						<div class="post-thumb">
							<div class="thumb">
								<img alt="kursus website, kursus internet marketing, kursus SEO" src="<?php echo base_url()?>assets/front_page/img/content/blog/blog (9).JPG">
							</div>	
						</div>
					</div>

				</div>
			</a>

			<!-- <div class="post-desc">
				<div class="post-meta">
					<span class="date">
						<i class="fa fa-clock-o"></i>08 JANUARI 2016 08:20
					</span>
					<span class="author">
						<i class="fa fa-pencil"></i>AUTHOR NAME
					</span>
				</div>
				<a class="post-title" href="#">
					<h4>Workshop Promosi Potensi Daerah Untuk Seluruh Kabupaten Di Sumatra</h4>
				</a>
				<div class="post-entry">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur.
				</div>	
			</div> -->

		</div>
	</article>
</div>
<?php endif; ?>
*/?>

<?php if($blog_list->num_rows() > 0) : ?>
<div class="post-list">
	<?php foreach($blog_list->result() as $row) : ?>
	<?php $category = isset($row->category_id) && $row->category_id != '' && $this->model_utama->cek_data($row->category_id,'category_id','category')->num_rows() > 0 ? $this->model_utama->get_detail($row->category_id,'category_id','category')->row()->category_slug : ''; ?>
	<article class="post">
		<div class="post-inner">
			<?php if($row->blog_picture != '') : ?>
			<div class="post-thumb">
				<a href="<?php echo site_url($category.'/'.$row->blog_slug)?>">
					<div class="thumb post-pic">
						<?php /*<!-- <img class="" src="<?php echo base_url()?>uploads/blog/<?php echo $row->blog_picture?>"> -->*/ ?>
						<img id="" class="bttrlazyloading img-responsive" data-bttrlazyloading-md-src="<?php echo base_url()?>uploads/blog/<?php echo $row->blog_picture?>" />
					</div>
				</a>
			</div>
			<?php endif; ?>
			<div class="post-desc">
				<div class="post-meta">
					<span class="date">
						<i class="fa fa-clock-o"></i><?php echo date('d F Y',strtotime($row->create_date)); ?>
					</span>
					<span class="author">
						<i class="fa fa-pencil"></i>ADMIN
					</span>
				</div>
				<a class="post-title" href="<?php echo site_url($category.'/'.$row->blog_slug)?>">
					<h4><?php echo ucwords($row->blog_title)?></h4>
				</a>
				<div class="post-entry">
					<?php echo isset($category) && $category == 'student' ? $row->blog_description : word_limiter(strip_tags($row->blog_description),40); ?>
					<br><br>
					<a class="btn btn-success" href="<?php echo site_url($category.'/'.$row->blog_slug)?>">See more</a>
				</div>	
			</div>
		</div>
	</article>
	<?php endforeach; ?>

</div>

<div class="pagination">
	<?php /*
	<!-- <div class="title">
		<i class="fa fa-file-text-o"></i>
		<span class="range">Page 2 of 10</span>
	</div> -->
	<!-- <ul class="page">
		<li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
		<li><a href="#">1</a></li>
		<li><a class="active" href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">...</a></li>
		<li><a href="#"><i class="fa fa-angle-double-right"></i></a></a></li>
		<li><a href="#">Last</a></li>
	</ul> -->
	*/ ?>
	<?php echo $this->pagination->create_links();?>
</div>
<?php endif; ?>