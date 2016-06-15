<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Baba Studio</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front_page/css/style.css">
	<link href="<?php echo base_url()?>assets/front_page/css/smart_wizard.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/jquery-2.0.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/jquery.smartWizard.js"></script>
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
		</div>

		<div class="form">
			<!-- Tabs -->
		      <div id="wizard" class="swMain">
			        <ul>
			          <li><a href="#step-1">
			                <label class="stepNumber">1</label>
			                <span class="stepDesc"></span>
			            </a></li>
			          <li><a href="#step-2">
			                <label class="stepNumber">2</label>
			                <span class="stepDesc"></span>
			            </a></li>
			          <li><a href="#step-3">
			                <label class="stepNumber">3</label>
			                <span class="stepDesc"></span>
			             </a></li>
			          <li><a href="#step-4">
			                <label class="stepNumber">4</label>
			                <span class="stepDesc"></span>
			            </a></li>
			        </ul>
			        <div id="step-1"> 
			            <h2 class="StepTitle">Step 1: Account Details</h2>
			            <table cellspacing="3" cellpadding="3" align="center">
			                <tr>
			                      <td align="center" colspan="3">&nbsp;</td>
			                </tr>        
			                <tr>
			                      <td align="right">Username :</td>
			                      <td align="left">
			                        <input type="text" id="username" name="username" value="" class="txtBox">
			                      </td>
			                      <td align="left">&nbsp;</td>
			                </tr>
			                <tr>
			                      <td align="right">Password :</td>
			                      <td align="left">
			                        <input type="password" id="password" name="password" value="" class="txtBox">
			                      </td>
			                      <td align="left"><span id="msg_password"></span>&nbsp;</td>
			                </tr> 
			                <tr>
			                      <td align="right">Confirm Password :</td>
			                      <td align="left">
			                        <input type="password" id="cpassword" name="cpassword" value="" class="txtBox">
			                      </td>
			                      <td align="left"><span id="msg_cpassword"></span>&nbsp;</td>
			                </tr>                                         
			           </table>               
			        </div>
			        <div id="step-2">
			            <h2 class="StepTitle">Step 2: Profile Details</h2>  
			            <table cellspacing="3" cellpadding="3" align="center">
			                <tr>
			                      <td align="center" colspan="3">&nbsp;</td>
			                </tr>        
			                <tr>
			                      <td align="right">First Name :</td>
			                      <td align="left">
			                        <input type="text" id="firstname" name="firstname" value="" class="txtBox">
			                      </td>
			                      <td align="left"><span id="msg_firstname"></span>&nbsp;</td>
			                </tr>
			                <tr>
			                      <td align="right">Last Name :</td>
			                      <td align="left">
			                        <input type="text" id="lastname" name="lastname" value="" class="txtBox">
			                      </td>
			                      <td align="left"><span id="msg_lastname"></span>&nbsp;</td>
			                </tr> 
			                <tr>
			                      <td align="right">Gender :</td>
			                      <td align="left">
			                        <select id="gender" name="gender" class="txtBox">
			                          <option value="">-select-</option>
			                          <option value="Female">Female</option>
			                          <option value="Male">Male</option>                 
			                        </select>
			                      </td>
			                      <td align="left"><span id="msg_gender"></span>&nbsp;</td>
			                </tr>                                         
			           </table>        
			        </div>                      
			        <div id="step-3">
			            <h2 class="StepTitle">Step 3: Contact Details</h2>  
			            <table cellspacing="3" cellpadding="3" align="center">
			                <tr>
			                      <td align="center" colspan="3">&nbsp;</td>
			                </tr>        
			                <tr>
			                      <td align="right">Email :</td>
			                      <td align="left">
			                        <input type="text" id="email" name="email" value="" class="txtBox">
			                      </td>
			                      <td align="left"><span id="msg_email"></span>&nbsp;</td>
			                </tr>
			                <tr>
			                      <td align="right">Phone :</td>
			                      <td align="left">
			                        <input type="text" id="phone" name="phone" value="" class="txtBox">
			                      </td>
			                      <td align="left"><span id="msg_phone"></span>&nbsp;</td>
			                </tr>               
			                <tr>
			                      <td align="right">Address :</td>
			                      <td align="left">
			                            <textarea name="address" id="address" class="txtBox" rows="3"></textarea>
			                      </td>
			                      <td align="left"><span id="msg_address"></span>&nbsp;</td>
			                </tr>                                         
			           </table>                                 
			        </div>
			        <div id="step-4">
			            <h2 class="StepTitle">Step 4: Other Details</h2>  
			            <table cellspacing="3" cellpadding="3" align="center">
			                <tr>
			                      <td align="center" colspan="3">&nbsp;</td>
			                </tr>        
			                <tr>
			                      <td align="right">Hobbies :</td>
			                      <td align="left">
			                        <input type="text" id="phone" name="phone" value="" class="txtBox">
			                      </td>
			                      <td align="left"><span id="msg_phone"></span>&nbsp;</td>
			                </tr>               
			                <tr>
			                      <td align="right">About You :</td>
			                      <td align="left">
			                            <textarea name="address" id="address" class="txtBox" rows="5"></textarea>
			                      </td>
			                      <td align="left"><span id="msg_address"></span>&nbsp;</td>
			                </tr>                                         
			           </table>                       
			        </div>
		      </div>
			<!-- End SmartWizard Content -->    
			<?php /*
			<form id="feedbackform">

				<fieldset class="sectionwrap">
					<div class="radio-group">
						<h5>Klik Salah Satu Materi</h5>
						<div class="input-group">
							<input type="radio" class="" id="" name="pilihan" value="website" required>
							<label for="website">Kursus Web site & Web Design</label>	
						</div>
						<div class="input-group">
							<input type="radio" class="" id="" name="pilihan" value="animasi" required>
							<label for="animation">Kursus Animasi</label>	
						</div>
						<div class="input-group">
							<input type="radio" class="" id="" name="pilihan" value="internet_marketing" required>
							<label for="marketing">Kursus Internet Marketing</label>	
						</div>
					</div>
				</fieldset>

				<fieldset class="sectionwrap">
					<div class="radio-group">
						<h5>Oyah, Kamu tinggal dimana sekarang?</h5>
						<div class="input-group">
							<input type="radio" class="" id="" name="pilihan" value="website" required>
							<label for="website">Jabotabek & Depok</label>	
						</div>
						<div class="input-group">
							<input type="radio" class="" id="" name="pilihan" value="animasi" required>
							<label for="animation">Jawa tengah</label>	
						</div>
						<div class="input-group">
							<input type="radio" class="" id="" name="pilihan" value="internet_marketing" required>
							<label for="marketing">Jawa Timur</label>	
						</div>
						<div class="input-group">
							<input type="radio" class="" id="" name="pilihan" value="internet_marketing" required>
							<label for="marketing">Luar Jawa</label>	
						</div>
					</div>
				</fieldset>

				<fieldset class="sectionwrap">
					<h5>Password & Akses akan dikirimkan ke Email&HP</h5>
					<input id="namalengkap" type="text" name="namalengkap" required placeholder="Silakan isi nama lengkap Anda">
					<input type="email" id="email_add" name="email_add" required placeholder="Masukkan email yang sering Anda gunakan">
					<input type="text" id="telp" name="telp" required placeholder="Silahkan isi no telp Anda">
					<button class="btn" type="submit" >Kirim Password & AKses Trial Ke Email & HP Saya Sekarang</button>
				</fieldset>

			</form>
			
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


	<?php /*
	<script type="text/javascript">
	    var baseurl = 'http://www.babastudio.com/';

	    function simpan_murid()
	    {
	        var namalengkap = $("#namalengkap").val();
	        var email_add = $("#email_add").val();
	        var telp = $("#telp").val();
	        var pilihan = $('input[name=pilihan]:checked').val();

	        if(namalengkap === '' || email_add === '' || telp === '' || pilihan === '' )
	        {
	        	alert('Silahkan isi seluruh form.');
	        	return true;
	        }

	        $("#buttonJawaban").hide(); //hide submit button    
	        $("#LoadingImage").show(); //hide loading image
	        jQuery.ajax({
	            type: "POST", // HTTP method POST or GET
	            url: baseurl+"registrasi/simpan_murid", //Where to make Ajax calls
	            data:'nama='+namalengkap+'&email='+email_add+'&telp='+telp+'&pilihan='+pilihan, //Form variables
	            success:function(response){                
	                $("#buttonJawaban").show(); 
	                $("#LoadingImage").hide(); //hide loading image
	                // $("#hasil_ajax").html(response);
	                //closeModal();
	                
					window.location.replace("<?php echo site_url('terima-kasih')?>");
	            },
	            error:function (xhr, ajaxOptions, thrownError){
	                $("#buttonJawaban").show(); //show submit button
	                $("#LoadingImage").hide(); //hide loading image
	                alert(thrownError);
	            }
	        });
	    }
	</script>
	*/ ?>
	<script type="text/javascript">
	   
	    $(document).ready(function(){
	      // Smart Wizard       
	      $('#wizard').smartWizard({transitionEffect:'slideleft',onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback,enableFinishButton:true});

	      function leaveAStepCallback(obj){
	        var step_num= obj.attr('rel');
	        return validateSteps(step_num);
	      }
	      
	      function onFinishCallback(){
	       if(validateAllSteps()){
	        $('form').submit();
	       }
	      }
	            
	    });
	     
	    function validateAllSteps(){
	       var isStepValid = true;
	       
	       if(validateStep1() == false){
	         isStepValid = false;
	         $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});         
	       }else{
	         $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
	       }
	       
	       if(validateStep3() == false){
	         isStepValid = false;
	         $('#wizard').smartWizard('setError',{stepnum:3,iserror:true});         
	       }else{
	         $('#wizard').smartWizard('setError',{stepnum:3,iserror:false});
	       }
	       
	       if(!isStepValid){
	          $('#wizard').smartWizard('showMessage','Please correct the errors in the steps and continue');
	       }
	              
	       return isStepValid;
	    }   
	    
	    
	    function validateSteps(step){
	      var isStepValid = true;
	      // validate step 1
	      if(step == 1){
	        if(validateStep1() == false ){
	          isStepValid = false; 
	          $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
	          $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
	        }else{
	          $('#wizard').smartWizard('hideMessage');
	          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
	        }
	      }
	      
	      // validate step3
	      if(step == 3){
	        if(validateStep3() == false ){
	          isStepValid = false; 
	          $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
	          $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
	        }else{
	          $('#wizard').smartWizard('hideMessage');
	          $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
	        }
	      }
	      
	      return isStepValid;
	    }
	    
	    function validateStep1(){
	       var isValid = true; 
	       // Validate Username
	       var un = $('#username').val();
	       if(!un && un.length <= 0){
	         isValid = false;
	         $('#msg_username').html('Please fill username').show();
	       }else{
	         $('#msg_username').html('').hide();
	       }
	       
	       // validate password
	       var pw = $('#password').val();
	       if(!pw && pw.length <= 0){
	         isValid = false;
	         $('#msg_password').html('Please fill password').show();         
	       }else{
	         $('#msg_password').html('').hide();
	       }
	       
	       // validate confirm password
	       var cpw = $('#cpassword').val();
	       if(!cpw && cpw.length <= 0){
	         isValid = false;
	         $('#msg_cpassword').html('Please fill confirm password').show();         
	       }else{
	         $('#msg_cpassword').html('').hide();
	       }  
	       
	       // validate password match
	       if(pw && pw.length > 0 && cpw && cpw.length > 0){
	         if(pw != cpw){
	           isValid = false;
	           $('#msg_cpassword').html('Password mismatch').show();            
	         }else{
	           $('#msg_cpassword').html('').hide();
	         }
	       }
	       return isValid;
	    }
	    
	    function validateStep3(){
	      var isValid = true;    
	      //validate email  email
	      var email = $('#email').val();
	       if(email && email.length > 0){
	         if(!isValidEmailAddress(email)){
	           isValid = false;
	           $('#msg_email').html('Email is invalid').show();           
	         }else{
	          $('#msg_email').html('').hide();
	         }
	       }else{
	         isValid = false;
	         $('#msg_email').html('Please enter email').show();
	       }       
	      return isValid;
	    }
	    
	    // Email Validation
	    function isValidEmailAddress(emailAddress) {
	      var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	      return pattern.test(emailAddress);
	    } 
	    
	    
	</script>
</body>
</html>