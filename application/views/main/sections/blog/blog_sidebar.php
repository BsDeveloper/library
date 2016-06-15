<div class="sidebar-toggle">
	<i class="fa fa-angle-double-right"></i>
</div>

<div class="sidebar-content">
	<header class="sidebar-title">
		<h5>NAVIGATION</h5>
	</header>

	<header class="sidebar-header">
		<h5>CATEGORY</h5>
	</header>
	
	<?php if($category_list->num_rows() > 0) : ?>
	<div class="side-menu ">

		<ul class="dropdown-menu">
			<?php foreach($category_list->result() as $row) : ?>
				<li><a href="<?php echo site_url($row->category_slug)?>"><?php echo $row->category_title; ?></a></li>
			<?php endforeach; ?>			
		</ul>
	</div>
	<?php endif; ?>

	<?php if($popular_blog_list->num_rows() > 0) { ?>
	<div class="side-post">
		<header>
			<h5>POPULAR POSTS</h5>
		</header>
		<ul class="post-list">
			<?php foreach ($popular_blog_list->result() as $row) { ?>
			<?php $cek_blog = $this->model_utama->cek_data($row->judul_blog,'blog_title','blog'); ?>

			<?php if($cek_blog->num_rows() > 0) : $blog = $cek_blog->row(); ?>
			<?php $category = isset($blog->category_id) && $blog->category_id != '' ? ucwords($this->model_utama->get_detail($blog->category_id,'category_id','category')->row()->category_title) : ''; ?>
			<li>
				<a class="post-thumb" href="<?php echo site_url(url_title($category, 'dash', TRUE).'/'.url_title($row->judul_blog, 'dash', TRUE))?>">
					<div class="thumb">
						<img src="<?php echo base_url()?>uploads/blog/<?php echo isset($blog->blog_picture) && $blog->blog_picture != '' ? $blog->blog_picture : 'default-min.jpg'; ?>">
					</div>
				</a>
				<div class="post-desc">
					<div class="post-meta">
						<span class="date"><?php echo date('d F Y',strtotime($blog->create_date)); ?></span>
					</div>
					<a class="post-title" href="<?php echo site_url(url_title($category, 'dash', TRUE).'/'.$blog->blog_slug); ?>">
						<?php echo $row->judul_blog?>
					</a>
					<?php if($category != '') : ?>
					<a class="post-category" href="<?php echo isset($blog->category_id) && $blog->category_id != '' ? site_url($this->model_utama->get_detail($blog->category_id,'category_id','category')->row()->category_slug) : '#';?>">
						<?php echo $category?>
					</a>
					<?php endif; ?>
				</div>
			</li>
			<?php endif; ?>
			<?php } ?>

		</ul>
	</div>	
	<?php } ?>
</div>