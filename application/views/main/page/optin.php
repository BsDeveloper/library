<?php
	if($this->session->userdata('nama_bro') == '')
	{
		redirect(site_url());
	}
?>
<?php $this->load->view('main/sections/course/course_menu'); ?>
<?php $this->load->view('main/sections/optin/free_trial'); ?>

<link rel="stylesheet" href="<?php echo base_url()?>assets/front_page/css/remodal.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/front_page/css/remodal-default-theme.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/front_page/js/remodal.min.js"></script>

<div class="remodal" data-remodal-id="modal" data-remodal-options="	hashTracking: false, 
																	closeOnOutsideClick: false, 	
																	closeOnCancel:false, 
																	closeOnEscape:false, 
																	closeOnOutsideClick: false" style="text-align:left;">
	<?php /* <button data-remodal-action="close" class="remodal-close"></button>  */ ?>
	<div id="form_isian">
  	  
		  <h4>Sambil Menunggu Password dan akses, Sekarang kalo <?php echo $this->session->userdata('nama_bro'); ?> punya WA atau BB, maka 
			<?php echo $this->session->userdata('nama_bro'); ?> berhak dapetin Power Bank Lenovo 12 Ribu Mah dari babastudio.</h4>
		  <p>
		    <div class="radio-group">
				<h4><b><?php echo $this->session->userdata('nama_bro'); ?> lebih sering pakai WA atau BB?</b></h4>
				<div class="input-group">
					<input type="radio" class="" id="bbm" name="messenger" value="bbm" onclick="pilih_messenger('bbm')">
					<label for="bbm">BBM (Blackberry Messenger)</label>	
				</div>
				<div class="input-group">
					<input type="radio" class="" id="wa" name="messenger" value="wa" onclick="pilih_messenger('wa')">
					<label for="wa">WA (WhatsApp)</label>	
				</div>
				<div class="input-group">
					<input type="radio" class="" id="ga_punya" name="messenger" value="ga_punya" onclick="pilih_messenger('ga_punya')">
					<label for="ga_punya">Ga punya</label>	
				</div>
			</div>
		  </p>
		  <br>
		  <?php /*<button data-remodal-action="cancel" class="remodal-cancel">Cancel</button> 
		  <button data-remodal-action="confirm" class="remodal-confirm">OK</button>*/?>
	</div>
	<div id="bbm_messenger" style="display:none;">
		<div class="form">
			<div class="radio-group">
			<h5>Masukkan Pin BBM kamu</h5>
			<input id="pin_bbm" type="text" name="pin_bbm" required placeholder="Silakan isi pin BBM Anda" style="width:80%">	<br>		
			<button class="remodal-confirm" onclick="save_bbm()">Simpan</button>
		</div>  			
		</div>
	</div>
	<div id="wa_messenger" style="display:none;">
		<div class="form">
			<div class="radio-group">
			<h5><?php echo $this->session->userdata('nama_bro'); ?>, nanti kamu tinggal Accept Invitasi dari Group <?php echo $this->session->userdata('materi'); ?></h5>
			<p>O yah jangan2 Nomor HP <?php echo $this->session->userdata('nama_bro'); ?> salah, mau di ganti?</p>
			<input id="phone" type="text" name="phone" readonly="readonly" value="<?php echo $this->session->userdata('hp_bro'); ?>" style="width:80%">	
			<br>
			<button class="remodal-confirm" onclick="show_phone()">Yes</button>
			<button class="remodal-cancel" data-remodal-action="confirm">No</button>
		</div>  			
		</div>
	</div>
	<div id="finish_messenger" style="display:none;">
		<div class="form">
			<h4>Masukkan Data Dirimu di Bawah</h4>
			<b>Namalengkap </b>
		<input id="namalengkap2" type="text" name="namalengkap2" required placeholder="Silakan isi nama lengkap Anda" value="<?php echo $this->session->userdata('nama_bro'); ?>" style="width:80%">
		<b>Email</b>
		<input type="email" id="email_add2" name="email_add2" required placeholder="Masukkan email yang sering Anda gunakan" value="<?php echo $this->session->userdata('email_bro'); ?>" style="width:80%">
		<b>Telepon / HP		</b>
		<input type="text" id="telp2" name="telp2" required placeholder="Silahkan isi no telp Anda" value="<?php echo $this->session->userdata('hp_bro'); ?>" style="width:80%"><br>
		<button class="remodal-confirm" onclick="save_finish()">Submit</button>
		</div>
	</div>
	<div id="thanks" style="display:none;">
		<div class="form">
			<h4>Terima Kasih Akses Trial paling lambat akan kamu dapatkan dalam 1 X 24 Jam</h4>
			<button data-remodal-action="confirm" class="remodal-confirm">OK</button>
		</div>
	</div>	
</div>

<script type="text/javascript">
var baseurl = '<?php echo base_url()?>';
$(document).ready(function(){
	$('.remodal').remodal();
});


function pilih_messenger(kode)
{

    if(kode === 'bbm')
    {    	
	    $("#form_isian").hide(); //hide loading image	
    	$("#bbm_messenger").show(); 
    }
    if(kode === 'wa')
    {    	
	    $("#form_isian").hide(); //hide loading image	
    	$("#wa_messenger").show(); 
    }
    if(kode === 'ga_punya')
    {    	
	    $("#form_isian").hide(); //hide loading image	
    	$("#finish_messenger").show(); 
    }    
}


function show_phone()
{
  $("#wa_messenger").hide(); 
	$("#finish_messenger").show(); 
}

function save_bbm()
{

	var pin_bbm = $("#pin_bbm").val();
	if(pin_bbm === '' )
    {
    	alert('Silahkan isi pin BBM terlebih dahulu');
    	return true;
    }
    jQuery.ajax({
        type: "POST", // HTTP method POST or GET
        url: baseurl+"save_bbm", //Where to make Ajax calls
        data:'pin_bbm='+pin_bbm,
        success:function(response){
            // $("#hasil_ajax").html(response);
          $("#bbm_messenger").hide(); //hide loading image	
  	    	$("#wa_messenger").show(); 
        },
        error:function (xhr, ajaxOptions, thrownError){
            $("#buttonJawaban").show(); //show submit button
            $("#LoadingImage").hide(); //hide loading image
            alert(thrownError);
        }
    });
}

function save_finish()
{

	var namalengkap = $("#namalengkap2").val();
  	var email_add = $("#email_add2").val();
  	var telp = $("#telp2").val();
	if(namalengkap === '' || email_add === '' || telp === '' )
    {
    	alert('Silahkan isi pin BBM terlebih dahulu');
    	return true;
    }
    jQuery.ajax({
        type: "POST", // HTTP method POST or GET
        url: baseurl+"save_finish", //Where to make Ajax calls
        data:'nama='+namalengkap+'&email='+email_add+'&telp='+telp,
        success:function(response){
            // $("#hasil_ajax").html(response);
            $("#finish_messenger").hide(); //hide loading image	
	    	$("#thanks").show(); 
        },
        error:function (xhr, ajaxOptions, thrownError){
            $("#buttonJawaban").show(); //show submit button
            $("#LoadingImage").hide(); //hide loading image
            alert(thrownError);
        }
    });
}
</script>