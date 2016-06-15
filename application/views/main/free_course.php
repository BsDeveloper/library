<html>
<head>
	<meta charset="UTF-8">
	<title>Baba Studio</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front_page/css/style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front_page/css/formwizard.css" />

	<script src="<?php echo base_url()?>assets/front_page/js/formwizard.js" type="text/javascript">

	/***********************************************
	* jQuery Form to Form Wizard- (c) Dynamic Drive (www.dynamicdrive.com)
	* Please keep this notice intact
	* Visit http://www.dynamicdrive.com/ for this script and 100s more.
	***********************************************/

	</script>

	<script type="text/javascript">

	var myform=new formtowizard({
		formid: 'feedbackform',
		// persistsection: true,
		validate: ['materi', 'tinggal'],
		revealfx: ['fade', 500] //slide, fade
	})

	</script>
</head>
<body>
	<div id="box-free-course">
		<div class="title">
			<h1 class="header">
			    <span class="light">KURSUS </span>GRATIS
			</h1>
			<h2 class="sub-header">
				KURSUS ONLINE GRATIS SENILAI
			</h2>
			<h1 class="price">1 JUTA</h1>
			<h2 class="baba-studio">DI BABA STUDIO</h2>
			<br><br><br>
		</div>

		<div class="form">
			<h3><b>Nikmati Online Trial Class Gratis</b></h3>
			<form id="feedbackform">

				<fieldset class="sectionwrap">
					<div class="radio-group">
						<h5>Pilih Materi yang Anda Inginkan</h5>
						<div class="input-group">
							<input type="radio" class="" id="Materi" name="materi" value="Website" required>
							<label for="website">Kursus Web site & Web Design</label>	
						</div><br>
						<div class="input-group">
							<input type="radio" class="" id="Materi" name="materi" value="Animasi" required>
							<label for="animation">Kursus Animasi</label>	
						</div><br>
						<div class="input-group">
							<input type="radio" class="" id="Materi" name="materi" value="Internet Marketing" required>
							<label for="marketing">Kursus Internet Marketing</label>	
						</div><br>
						<div class="input-group">
							<input type="radio" class="" id="Materi" name="materi" value="SEO" required>
							<label for="SEO">Kursus SEO (Search Engine Optimation)</label>	
						</div><br>
						<div class="input-group">
							<input type="radio" class="" id="Materi" name="materi" value="Kursus Komputer" required>
							<label for="kursus_komputer">Kursus Komputer</label>	
						</div>
					</div>
				</fieldset>

				<fieldset class="sectionwrap">
					<div class="radio-group">
						<h5>Oyah, Kamu tinggal dimana sekarang?</h5>
						<div class="input-group">
							<input type="radio" class="" id="Tempat" name="tinggal" value="Jakarta dan Tangerang" required>
							<label for="jakarta_tangerang">Jakarta dan Tangerang</label>	
						</div><br><div class="input-group">
							<input type="radio" class="" id="Tempat" name="tinggal" value="Bekasi dan Cikarang" required>
							<label for="bekasi_cikarang">Bekasi dan Cikarang</label>	
						</div><br>
						<div class="input-group">
							<input type="radio" class="" id="Tempat" name="tinggal" value="Jawa Tengah dan Jawa Timur" required>
							<label for="jateng_jatim">Jawa Tengah dan Jawa Timur</label>	
						</div><br>
						<div class="input-group">
							<input type="radio" class="" id="Tempat" name="tinggal" value="Luar Jawa" required>
							<label for="luar">Luar Jawa</label>	
						</div><br>
						<div class="input-group">
							<input type="radio" class="" id="Tempat" name="tinggal" value="Lainnya" required>
							<label for="lainnya">Lainnya</label>	
						</div>
					</div>
				</fieldset>

				<fieldset class="sectionwrap">
					<h5>Password & Akses akan dikirimkan ke Email & HP</h5>
					<input id="namalengkap" type="text" name="namalengkap" required placeholder="Silakan isi nama lengkap Anda">
					<input type="email" id="email_add" name="email_add" required placeholder="Masukkan email yang sering Anda gunakan">
					<input type="text" id="telp" name="telp" required placeholder="Silahkan isi no telp Anda">
					<button class="btn" type="button" onclick="simpan_murid()" >Kirim</button>
				</fieldset>

			</form>
			<?php /*
			<form action="" method="POST">
				<h4>Masukkan Data Dirimu di Bawah</h4>
				<input id="namalengkap" type="text" name="namalengkap" required placeholder="Silakan isi nama lengkap Anda">
				<input type="email" id="email_add" name="email_add" required placeholder="Masukkan email yang sering Anda gunakan">
				<input type="text" id="telp" name="telp" required placeholder="Silahkan isi no telp Anda">
				<div class="radio-group">
					<h5>Kursus yang Anda Mintai:</h5>
					<div class="input-group">
						<input type="radio" class="" id="" name="pilihan" value="website" required>
						<label for="website">Website</label>	
					</div>
					<div class="input-group">
						<input type="radio" class="" id="" name="pilihan" value="animasi" required>
						<label for="animation">Animasi</label>	
					</div>
					<div class="input-group">
						<input type="radio" class="" id="" name="pilihan" value="internet_marketing" required>
						<label for="marketing">Internet Marketing</label>	
					</div>
				</div>
				<button class="btn" type="button" onclick="simpan_murid()">Kirim Kursus Gratis Ke Email Saya</button>
				<!-- <a href="<?php echo site_url('terima-kasih')?>"><button class="btn" type="button">Kirim Kursus Gratis Ke Email Saya</button></a> -->
			</form>
			*/ ?>
		</div>
	</div>


	<script type="text/javascript">
	    var baseurl = 'http://www.babastudio.com/';

	    function simpan_murid()
	    {
	        var namalengkap = $("#namalengkap").val();
	        var email_add = $("#email_add").val();
	        var telp = $("#telp").val();
	        var tinggal = $('input[name=tinggal]:checked').val();
	        var materi = $('input[name=materi]:checked').val();

	        if(namalengkap === '' || email_add === '' || telp === '' || tinggal === '' || materi === '' )
	        {
	        	alert('Silahkan isi seluruh form.');
	        	return true;
	        }

	        $("#buttonJawaban").hide(); //hide submit button    
	        $("#LoadingImage").show(); //hide loading image
	        jQuery.ajax({
	            type: "POST", // HTTP method POST or GET
	            url: baseurl+"save", //Where to make Ajax calls
	            data:'nama='+namalengkap+'&email='+email_add+'&telp='+telp+'&tinggal='+tinggal+'&materi='+materi, //Form variables
	            success:function(response){                
	                $("#buttonJawaban").show(); 
	                $("#LoadingImage").hide(); //hide loading image
	                // $("#hasil_ajax").html(response);
	                //closeModal();
	                
					window.location.replace("<?php echo site_url('terima-kasih#modal'); //site_url('terima-kasih#modal')?>");
	            },
	            error:function (xhr, ajaxOptions, thrownError){
	                $("#buttonJawaban").show(); //show submit button
	                $("#LoadingImage").hide(); //hide loading image
	                alert(thrownError);
	            }
	        });
	    }
	</script>
</body>
</html>