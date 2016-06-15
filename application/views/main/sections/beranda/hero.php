<?php if($banner_list->num_rows() > 0) : ?>
<section class="hero">
	<div id="owl-hero" class="owl-carousel">

		<?php foreach($banner_list->result() as $row) : ?>	
		<?php if($row->banner_hide == 'no') : ?>		
		<div class="item">
	    	<div class="hero-image thumb">
	    		<img class="thumb-img img-for-mobile" src="<?php echo isset($row->banner_picture) && $row->banner_picture != '' ? base_url().'uploads/banner/'.$row->banner_picture : base_url().'assets/front_page/img/full/slide-banner-min.jpg'; ?>" alt="kursus website, kursus internet marketing, kursus SEO"  width="1024" height="600">
	    		<!-- <img id="" class="bttrlazyloading img-responsive" data-bttrlazyloading-md-src="<?php //echo base_url()?>assets/front_page/img/full/slide02_@laptop-min.jpg" alt="image-slider" /> -->
	    	</div>
	    	<?php if($row->banner_type == 'in') : ?>
	    	<div class="hero-overlay">
	            <div class="container">
		        	<div class="vc-table">
		                <div class="vc-cell">
			                <div class="hero-caption">
		                        <h1><?php echo $row->banner_title?></h1>
		                        <h2><?php echo $row->banner_description?></h2>  
		                    </div>	
	                	</div>
	                </div>
	            </div>	
        	</div>
	        <?php endif; ?>
	    </div>
	    <?php endif; ?>
		<?php endforeach; ?>

	</div>
</section>
<?php endif; ?>