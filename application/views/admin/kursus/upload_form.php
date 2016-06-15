<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style type="text/css">
	#image_preview{
		font-size: 30px;
		width: 250px;
		height: 230px;
		text-align: center;
		line-height: 180px;
		font-weight: bold;
		color: #C0C0C0;
		background-color: #FFFFFF;
	}
	#selectImage{
		width: 414px;
		background-color: #FEFFED;
		border-radius: 10px;
	}
	.submit{
		font-size: 16px;
		background: linear-gradient(#ffbc00 5%, #ffdd7f 100%);
		border: 1px solid #e5a900;
		color: #4E4D4B;
		font-weight: bold;
		cursor: pointer;
		width: 300px;
		border-radius: 5px;
		padding: 10px 0;
		outline: none;
		margin-top: 20px;
		margin-left: 15%;
	}
	.submit:hover{
		background: linear-gradient(#ffdd7f 5%, #ffbc00 100%);
	}
	#file {
		color: red;
		padding: 5px;
		border: 5px solid #8BF1B0;
		background-color: #8BF1B0;
		margin-top: 10px;
		border-radius: 5px;
		box-shadow: 0 0 15px #626F7E;
		margin-left: 15%;
		width: 72%;
	}
	#success
	{
		color:green;
	}
	#invalid
	{
		color:red;
	}
	#error
	{
		color:red;
	}
	#error_message
	{
		color:blue;
	}
	#loading
	{
		display:none;
		font-size:25px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function (e) {
		var baseurl = '<?php echo base_url()?>';

		$("#uploadimage").on('submit',(function(e) {
			e.preventDefault();
			$("#message").empty();
			$('#loading').show();
			$.ajax({
				url: baseurl+"admin/level/upload_answer", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
					$('#loading').hide();
					$("#message").html(data);
				}
			});
		}));

		// Function to preview image after validation
		$(function() {
			$("#file").change(function() {
				$("#message").empty(); // To remove the previous error message
				var file = this.files[0];
				var imagefile = file.type;
				var match= ["image/jpeg","image/png","image/jpg"];
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
				{
					$('#previewing').attr('src','noimage.png');
					$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
					return false;
				}
				else
				{
					var reader = new FileReader();
					reader.onload = imageIsLoaded;
					reader.readAsDataURL(this.files[0]);
				}
			});
		});

		function imageIsLoaded(e) {
			$("#file").css("color","green");
			$('#image_preview').css("display", "block");
			$('#previewing').attr('src', e.target.result);
			$('#previewing').attr('width', '250px');
			$('#previewing').attr('height', '230px');
		};
	});
</script>

<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
	<div id="image_preview"><img id="previewing" src="<?php echo base_url()?>uploads/noimage.png" /></div>
	<h4 id='loading' >loading..</h4>
	<div id="message"></div>
	<hr id="line">
	<div id="selectImage">
		<label>Select Your Image</label><br/>
		<input type="text" value="<?php echo $kode; ?>" name="soal_option_id" id="soal_option_id">
		<input type="file" name="file" id="file" required /><br>
		<button type="submit" class="btn btn-success submit" >Upload</button>
	</div>
</form>


