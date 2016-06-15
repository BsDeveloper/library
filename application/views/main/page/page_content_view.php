<?php if($pages->page_link != '' and $pages->page_type == 'out') : ?>
	<?php $this->load->view($pages->page_link)?>
<?php else : ?>
	<!-- <section class="main-blog bg-ticks">
		<div class="container">
			<div class="row">
				<div class="col-md-12"> -->
					<?php echo $pages->page_description?>
				<!-- </div>
			</div>
		</div>
	</section> -->
<?php endif; ?>