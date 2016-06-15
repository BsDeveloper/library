
<!-- BATAS -->


<section class="bs-leader-say ptb-60 bg-ticks">
	<div class="container">
		<header class="bs-header1">
			<h1>Kontak</h1>
		</header>

		<div class="row masonry-grid">
		
			<div class="col col-6">
				<?php
                    $message = $this->session->flashdata('success');
                    echo $message == '' ? '' : '<div class="alert alert-success" style="background-color:green;color:white"><i class="fa fa-check"></i> ' . $message . '</div><br>';
                ?>
                <?php
                    $message = $this->session->flashdata('info');
                    echo $message == '' ? '' : '<div class="alert alert-info" style="background-color:blue;color:white;"><i class="fa fa-info"></i> ' . $message . '</div><br>';
                ?>
                <?php
                    $message = $this->session->flashdata('warning');
                    echo $message == '' ? '' : '<div class="alert alert-warning" style="background-color:yellow;color:white;"><i class="fa fa-exclamation"></i> ' . $message . '</div><br>';
                ?>
                <?php
                    $message = $this->session->flashdata('danger');
                    echo $message == '' ? '' : '<div class="alert alert-danger" style="background-color:red;color:white;"><i class="fa fa-ban"></i> ' . $message . '</div><br>';
                ?>
                <div class="form">
                    <h4>Masukkan Pesan Anda pada Form dibawah ini</h4>
                    <form method="post" action="<?php echo $form_action?>" >
                        <div class="form-group <?php if(form_error('nama') != '') { echo 'has-error'; } ?>">
                            <label for="nama" class="control-label">Nama Lengkap</label>
                            <input style="width:100%" type="text" required class="form-control" id="nama" name="nama" placeholder="Silakan isi nama lengkap Anda." required value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>">
                            <?php echo form_error('nama', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i> ', '</span>'); ?>                        
                        </div>
                        <div class="form-group <?php if(form_error('email') != '') { echo 'has-error'; } ?>">
                            <label for="email" class="control-label">Email</label>                       
                            <input style="width:100%" type="email" required class="form-control" id="email" name="email" placeholder="Silakan isi email. Anda" required value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>">
                            <?php echo form_error('email', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i> ', '</span>'); ?>                        
                        </div>
                        <div class="form-group <?php if(form_error('message') != '') { echo 'has-error'; } ?>">
                            <label for="message" class="control-label">Pesan</label>
                            <textarea style="height: 100px;width:100%" name="message" class="form-control" id="message" placeholder="Silakan isi pesan Anda." required><?php echo set_value('message', isset($default['message']) ? $default['message'] : ''); ?></textarea>
                            <?php echo form_error('message', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i> ', '</span>'); ?>
                        </div>
                        <div class="form-group <?php if(form_error('message') != '') { echo 'has-error'; } ?>">
                            <label for="captcha" class="control-label">Ketikkan jawaban dibawah</label>&nbsp;&nbsp;
                            <input type="text" id="captchaEquotation" value="<?php echo $captcha; ?>" disabled>
                            <input style="width:100%" type="text" autocomplete="off" placeholder="<?php echo isset($captcha_salah) ? 'Hasil Salah' : 'Silahkan Masukkan Jawaban Yang Benar'; ?>" name="login_equotation" class="form-control" value="" />
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
			</div>
		
			<div class="col col-6">
				<?php echo $pages->page_description?>
			</div>
		</div>
		
	</div>
</section> 