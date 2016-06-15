<?php //$this->load->view('main/sections/course/course_menu'); ?>

<section class="main-blog bg-ticks">
	<div class="container">
		<div class="main-inner">
			<div class="content">
				<div class="post-list">
					<article class="post">
						<div class="post-inner">
							
							<?php
								$category_slug 	= '';
								$category 		= '';
								$cek_category = $this->model_utama->cek_data($blog->category_id,'category_id','category');
								if($cek_category->num_rows() > 0) {
									$category 		= $cek_category->row()->category_title;
									$category_slug 	= $cek_category->row()->category_slug;
								}

							?>
							<div class="post-desc">
								<div class="post-meta">
									<span class="date">
										<i class="fa fa-clock-o"></i> <?php echo date('d F Y',strtotime($blog->create_date)); ?>
									</span>
									<span class="author">
										<i class="fa fa-pencil"></i> ADMIN
									</span>
									<?php if($category_slug == 'blog' || $category_slug == 'video-tutorial') : ?>
									<span>
										<a href="https://twitter.com/share"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-success" style="color:white !important;background-color:#00a0d1;padding:5px;"><i class="fa fa-twitter"></i> Bagikan di Twitter</a>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo site_url($category_slug.'/'.$blog->blog_slug); ?>?>"  onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-desuccessfault" style="color:white !important;background-color:#3b5998;padding:5px;"><i class="fa fa-facebook"></i> Bagikan di Facebook</a>
                                        <a href="https://plus.google.com/share?url={<?php echo site_url($category_slug.'/'.$blog->blog_slug); ?>}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-success" style="color:white !important;background-color:#d94a39;padding:5px;"><i class="fa fa-google-plus"></i> Bagikan di Google+</a>
									</span>
									<?php endif; ?>
								</div>
								<div class="post-title" href="">
									<h4><?php echo ucwords($blog->blog_title)?></h4>
								</div>
								<?php if($blog->blog_picture != '') : ?>
								<div class="post-thumb">
									<div class="thumb">
										<img src="<?php echo base_url()?>uploads/blog/<?php echo $blog->blog_picture?>">
									</div>
								</div>
								<?php endif; ?>
								<div class="post-entry">
									<?php echo $blog->blog_description; ?>
								</div>	
							</div>
						</div>
					</article>
				</div>
				<?php if($category_slug == 'blog' || $category_slug == 'video-tutorial') : ?>
				<div class="post-list">
					<div class="form" style="padding: 20px;">						
						<h3>Komentar</h3>
						<form role="form" action="" method="post" name="comment_bro">
				          <div class="form-group">
				            <label for="namalengkap">Nama Lengkap:</label>
				            <input type="text" class="form-control" id="namalengkap" name="namalengkap" required placeholder="Silahkan isi nama lengkap Anda">
				          </div>
				          <div class="form-group">
				            <label for="email_add">Email:</label>
				            <input type="email" class="form-control" id="email_add" name="email_add" required placeholder="Masukkan email yang sering Anda gunakan">
				          </div>
				          <div class="form-group">
				            <label for="telp">Pesan:</label>
				            <textarea name="content" placeholder="Masukkan Pesan Anda" class="form-control"></textarea>
				          </div>
				          <div class="form-group">				          	
				            <label for="telp">Captcha:</label>
							<?php echo $this->recaptcha->render(); ?>
				          </div>
				          <button type="submit" class="btn btn_basic" style="background-color:green;color:white;" id="buttonJawaban">Kirim</button>
			        	</form>
					</div>
					<hr>
					<?php if($comment_list->num_rows() > 0) : ?>
					<div style="padding:20px">
						<?php foreach($comment_list->result() as $row) : ?>
							<article class="post" style="border:1px solid grey;">
								<div class="post-inner">
									<div class="post-desc">
										<div class="post-meta">
											<span class="date">
												<i class="fa fa-clock-o"></i><?php echo date('d F Y',strtotime($row->create_date)); ?>
											</span>
										</div>
										<h4 class="post-title"><?php echo ucwords($row->comment_name)?></h4>
										<div class="post-entry">
											<?php echo strip_tags($row->comment_content); ?>
										</div>	
									</div>
								</div>
							</article>
							<br>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="sidebar">
				<?php $this->load->view('main/sections/blog/blog_sidebar'); ?>
			</div>
		</div>
	</div>
</section>