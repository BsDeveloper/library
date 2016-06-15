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
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/jquery-2.0.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/front_page/js/jquery.steps.min.js"></script>
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
			<form id="example-form" action="#">
			    <div>
			        <h3>Account</h3>
			        <section>
			            <label for="userName">User name *</label>
			            <input id="userName" name="userName" type="text" class="required">
			            <label for="password">Password *</label>
			            <input id="password" name="password" type="text" class="required">
			            <label for="confirm">Confirm Password *</label>
			            <input id="confirm" name="confirm" type="text" class="required">
			            <p>(*) Mandatory</p>
			        </section>
			        <h3>Profile</h3>
			        <section>
			            <label for="name">First name *</label>
			            <input id="name" name="name" type="text" class="required">
			            <label for="surname">Last name *</label>
			            <input id="surname" name="surname" type="text" class="required">
			            <label for="email">Email *</label>
			            <input id="email" name="email" type="text" class="required email">
			            <label for="address">Address</label>
			            <input id="address" name="address" type="text">
			            <p>(*) Mandatory</p>
			        </section>
			        <h3>Hints</h3>
			        <section>
			            <ul>
			                <li>Foo</li>
			                <li>Bar</li>
			                <li>Foobar</li>
			            </ul>
			        </section>
			        <h3>Finish</h3>
			        <section>
			            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
			        </section>
			    </div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(function ()
        {

			var form = $("#example-form");
			form.validate({
			    errorPlacement: function errorPlacement(error, element) { element.before(error); },
			    rules: {
			        confirm: {
			            equalTo: "#password"
			        }
			    }
			});
			form.children("div").steps({
			    headerTag: "h3",
			    bodyTag: "section",
			    transitionEffect: "slideLeft",
			    onStepChanging: function (event, currentIndex, newIndex)
			    {
			        form.validate().settings.ignore = ":disabled,:hidden";
			        return form.valid();
			    },
			    onFinishing: function (event, currentIndex)
			    {
			        form.validate().settings.ignore = ":disabled";
			        return form.valid();
			    },
			    onFinished: function (event, currentIndex)
			    {
			        alert("Submitted!");
			    }
			});
		});
	</script>
</body>
</html>