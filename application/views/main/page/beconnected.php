<section class="main-blog bg-ticks ptb-40">
	<div class="container">				
		<div class="content">
			<div class="post-list">
				<div class="form" style="padding: 20px;">	
					<center><h1>Pendaftaran Alumni Babastudio - Beconnected</h1></center>												
					<form role="form" action="<?php echo site_url('home/save_beconnected')?>" method="post" style="background-color:white;padding:20px;" >						
						<div class="row">		
							<div class="col col-6">
								
						        <div class="form-group">
						            <label for="nama"><b>Nama Lengkap</b></label>
						            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Silahkan isi nama lengkap Anda">
						        </div>
						        <div class="form-group">
						            <label for="email"><b>Email</b></label>
						            <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email yang sering Anda gunakan">
						        </div>
						        <div class="form-group">
						            <label for="telp"><b>Telepon</b></label>
						            <input type="text" class="form-control" id="telp" name="telp" required placeholder="Masukkan telepon yang sering Anda gunakan">
						        </div>
						          
					        	<div class="radio-group">
									<label for="telp"><b>Domisili:</b></label>
									<div class="input-group">
										<input type="radio" class="" id="jakarta_tangerang" name="tinggal" value="Jakarta dan Tangerang" required>
										<label for="jakarta_tangerang">Jakarta dan Tangerang</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="bekasi_cikarang" name="tinggal" value="Bekasi dan Cikarang" required>
										<label for="bekasi_cikarang">Bekasi dan Cikarang</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="jateng_jatim" name="tinggal" value="Jawa Tengah dan Jawa Timur" required>
										<label for="jateng_jatim">Jawa Tengah dan Jawa Timur</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="luar" name="tinggal" value="Luar Jawa" required>
										<label for="luar">Luar Jawa</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="lainnya" name="tinggal" value="Lainnya" required>
										<label for="lainnya">Lainnya</label>	
									</div>
								</div>	
					        </div>
					        <div class="col col-6"> 					  
						        <div class="radio-group">
									<label for="karya"><b>Karya</b></label>
									<div class="input-group">
										<input type="radio" class="" id="Website" name="karya" value="Website" required>
										<label for="Website">Website</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="Desain Grafis" name="karya" value="Desain Grafis" required>
										<label for="Desain Grafis">Desain Grafis</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="Animasi" name="karya" value="Animasi" required>
										<label for="Animasi">Animasi</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="Tempat" name="karya" value="Internet Marketing" required>
										<label for="Internet Marketing">Internet Marketing</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="Mobile Application" name="karya" value="Mobile Application" required>
										<label for="Mobile Application">Mobile Application</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="Mobile Application" name="karya" value="Video Editing" required>
										<label for="Video Editing">Video Editing</label>	
									</div>
									<div class="input-group">
										<input type="radio" class="" id="Lain-lain" name="karya" value="Lain-lain" required>
										<label for="Lain-lain">Lain-lain</label>	
									</div>
								</div>
								<br>
						        <div class="form-group">
						            <label for="telp"><b>Link Karya</b></label>
						            <textarea name="link_karya" placeholder="Masukkan Link Karya Anda" class="form-control"></textarea>
						        </div>
						        <div class="form-group">				          				            
									<?php echo $this->recaptcha->render(); ?>
						        </div>
						        <button type="submit" class="btn btn_basic pull-right" style="background-color:green;color:white;" id="buttonJawaban">Kirim</button>
					        </div>
				       </div>
		        	</form>
				</div>
			</div>
		</div>
	</div>
</section>