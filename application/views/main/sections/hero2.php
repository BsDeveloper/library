<?php if(isset($pages->page_picture) && $pages->page_picture != '') : ?>		
	<section class="hero">
		<div class="hero2-image thumb">
			<img class="thumb-img" src="<?php echo isset($pages->page_picture) && $pages->page_picture != '' ? base_url().'uploads/page/'.$pages->page_picture : base_url().'assets/front_page/img/baba/banner-v2.jpg'; ?>" alt="image-slider">
		</div>
		<div class="hero2-overlay">
		    <div class="container">
		    	<div class="vc-table">
		            <div class="vc-cell">
		                <div class="hero2-caption">
		                    <h1><?php echo $pages->page_title?></h1>
		                    <h2><?php echo $pages->page_subtitle?></h2>  
		                </div>	
		        	</div>
		        </div>
		    </div>	
		</div>
	</section>
<?php else : ?>
	<section class="hero">
		<div class="hero2-image thumb">
			<img class="thumb-img" src="<?php echo base_url()?>assets/front_page/img/baba/banner-v2.jpg" alt="image-slider">
		</div>
		<?php /*
		<!-- <div class="hero2-overlay">
		    <div class="container">
		    	<div class="vc-table">
		            <div class="vc-cell">
		                <div class="hero2-caption">
		                    <h1>TEMPAT KURSUS WEB TERBAIK</h1>
		                    <h2>Telah 13 tahun berpengalaman memberikan kursus web pada lebih dari 10 ribu peserta</h2>  
		                </div>	
		        	</div>
		        </div>
		    </div>	
		</div> -->
		*/ ?>
	</section>
<?php endif; ?>