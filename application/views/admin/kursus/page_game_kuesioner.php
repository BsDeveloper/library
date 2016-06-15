<script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/javascripts/jquery.min.js">'+"<"+"/script>"); </script>
<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/javascripts/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/bootstrap.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
$( document ).ready(function() {
        $('.form_editable').editable();
		$('.select_editable').editable();
		/*$( ".ui-accordion" ).accordion({
                    heightStyle: "content",
                    header: "> div > h3",
                    active: false,
                    collapsible: true,
                });
				
		jQuery.ajax({
		url: baseurl+"admin/level/list_leadership_question/35", //Where to make Ajax calls
		success:function(response){
			$('.select_editable').editable({
				source : response
			});
		}
		});*/		
	});			

var baseurl = '<?php echo base_url()?>';
function tambahQuestion(kode)
{
	$("#tambahQuestionButton"+kode).hide(); //hide submit button
	$("#loadingQuestion"+kode).show(); //show loading image
	//console.log('masuk ke fungsinya bro');

	jQuery.ajax({
		url: baseurl+"admin/level/add_checklist/"+kode, //Where to make Ajax calls
		success:function(response){
			$("#boxQuestion"+kode).append(response);
			// $("#respond_item"+kode).html(response);
			$("#loadingQuestion"+kode).hide(); //hide loading image
			console.log('masuk ke ajax sukses');
		},
		error:function (xhr, ajaxOptions, thrownError){
			console.log(thrownError);
			$("#tambahQuestionButton"+kode).show(); //show submit button
			$("#loadingQuestion"+kode).hide(); //hide loading image
			// alert(thrownError);
		}
	});

}

function tambahOption(kode)
{
	$("#tambahOptionButton"+kode).hide(); //hide submit button
	$("#loadingOption"+kode).show(); //show loading image
	//console.log('masuk ke fungsinya bro');

	jQuery.ajax({
		url: baseurl+"admin/level/add_checklist_item/"+kode+"/<?php echo $this->uri->segment('4')?>", //Where to make Ajax calls
		success:function(response){
			$("#boxOption"+kode).append(response);
			// $("#respond_item"+kode).html(response);
			$("#tambahOptionButton"+kode).show(); //show submit button
			$("#loadingOption"+kode).hide(); //hide loading image
			console.log('masuk ke ajax sukses');
		},
		error:function (xhr, ajaxOptions, thrownError){
			console.log(thrownError);
			$("#tambahOptionButton"+kode).show(); //show submit button
			$("#loadingOption"+kode).hide(); //hide loading image
			// alert(thrownError);
		}
	});

}
</script>			

<div id="content-wrapper">	
	<div class="row">
		<div class="col-md-11 col-md-offset-1">
			<div class="row">
				<form action="<?php echo base_url()?>admin/level/add_soal_kuesioner" method="post">
				<div class="col-md-2">
					<input type="text" id="jumlahTambah" name="jumlah" class="form-control" required>
					<input type="hidden" name="id" class="form-control" value="<?php echo $this->uri->segment('4')?>">
				</div>
				<div class="col-md-4">
					<button class="btn btn-labeled btn-success" type="submit"><span class="btn-label icon fa fa-plus"></span>Tambah Soal</button>
				</div>
				</form>
			</div>
			<div class="form-horizontal row" id="boxQuestion<?php echo $this->uri->segment('4')?>">
				<table class="table">
					<tr>
						<td></td>
					<?php foreach($option->result() as $row){ ?>	
						<td><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="<?php echo base_url()?>admin/level/ubah_kuesioner/soal_option_title/<?php echo $row->soal_option_id; ?>/soal_option_id/soal_option"><?php echo set_value('soal_option_title', isset($row->soal_option_title) ? $row->soal_option_title : ''); ?></a></td>
					<?php } ?>	
					</tr>
					<?php 
					if($soal->num_rows() > 0){
						foreach($soal->result() as $so){ ?>
					<tr>
						<td><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="<?php echo base_url()?>admin/level/ubah_kuesioner/kuesioner_text/<?php echo $so->kuesioner_soal_id; ?>/kuesioner_soal_id/kuesioner_soal"><?php echo set_value('kuesioner_soal', isset($so->kuesioner_text) ? $so->kuesioner_text : ''); ?></a></td>
						<?php foreach($option->result() as $row){ ?>	
						<?php $scoring = $this->db->query("select * from kuesioner_scoring where soal_option_id = '$row->soal_option_id' and kuesioner_soal_id = '$so->kuesioner_soal_id'")->row();?>
						<td><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="<?php echo base_url()?>admin/level/ubah_kuesioner/score/<?php echo $scoring->kuesioner_scoring_id; ?>/kuesioner_scoring_id/kuesioner_scoring"><?php echo $scoring->score ?></a></td> 
					<?php } ?>	
					</tr>
					<?php } } ?>
				</table>
			</div>
		</div>
	</div>
</div>				

