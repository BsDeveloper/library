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
                        <div class="form-horizontal row" id="boxQuestion<?php echo $this->uri->segment('4')?>">
						<?php if($question->num_rows() == 0){ ?>
							<div class="row">
								<a id="tambahQuestionButton<?php echo $this->uri->segment('4')?>" class="btn btn-labeled btn-success" href="javascript:;" onclick="tambahQuestion('<?php echo $this->uri->segment('4')?>','checklist_result_id','checklist_result')"><span class="btn-label icon fa fa-plus"></span> Create Cheklist</a>
								<img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loadingQuestion<?php echo $this->uri->segment('4')?>" style="display:none" /> 
								<br><br>
							</div>
						<?php } ?>	
						
						<?php if($question->num_rows() > 0) : ?>							                           
                                    <?php foreach($question->result() as $row) : ?>
                                    <div class="row" id="itemQuestion<?php echo $row->checklist_result_id?>">
                                        <div class="col-md-11">

                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <span class="panel-title col-md-6">
													<h2 class="text-center"><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="<?php echo base_url()?>admin/level/ubah_checklist/result_a/<?php echo $row->checklist_result_id; ?>/checklist_result_id/checklist_result"><?php echo set_value('title1', isset($row->result_a) ? $row->result_a : ''); ?></a></h2></span>
													<span class="panel-title col-md-6">
													<h2 class="text-center"><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title"  data-url="<?php echo base_url()?>admin/level/ubah_checklist/result_b/<?php echo $row->checklist_result_id; ?>/checklist_result_id/checklist_result"><?php echo set_value('title2', isset($row->result_b) ? $row->result_b : ''); ?></a></h2></span>
                                                </div>
                                                <div class="panel-body">
                                                    <?php $query_option = $this->model_utama->cek_data($row->checklist_result_id,'checklist_result_id','checklist_item'); ?>
                                                    
                                                    <div class="ui-accordion" id="boxOption<?php echo $row->checklist_result_id?>">
                                                    <?php if($query_option->num_rows() > 0) : $num_sub = 1;?>
                                                        <?php foreach($query_option->result() as $sub) : ?>
															<div class="row">
																<div class="col-md-6">
																	<div class="alert alert-info alert-dark">
																		<strong><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title" style="color:white;" data-url="<?php echo base_url()?>admin/level/ubah_checklist/text_a/<?php echo $sub->checklist_item_id; ?>/checklist_item_id/checklist_item"><?php echo set_value('title2', isset($sub->text_a) ? $sub->text_a : ''); ?></a></strong>
																	</div>
																</div>
																<div class="col-md-6">																
																	<div class="alert alert-danger alert-dark">
																		<strong><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Title" style="color:white;" data-url="<?php echo base_url()?>admin/level/ubah_checklist/text_b/<?php echo $sub->checklist_item_id; ?>/checklist_item_id/checklist_item"><?php echo set_value('title2', isset($sub->text_b) ? $sub->text_b : ''); ?></a></strong>
																	</div>
																</div>	
															</div>
                                                       
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    
                                                    </div> <!-- / #ui-accordion -->
													 <a id="tambahOptionButton<?php echo $row->checklist_result_id?>" class="btn btn-labeled btn-success btn-xs" href="javascript:;" onclick="tambahOption('<?php echo $row->checklist_result_id; ?>')"><span class="btn-label icon fa fa-plus"></span> Tambah Option</a>
                                                    <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loadingOption<?php echo $row->checklist_result_id?>" style="display:none" /> 
                                                </div>
                                                <div class="panel-footer">
                                                    <p class="text-right">
                                                        <button class="btn btn-labeled btn-danger" type="button" id="delete_item_modul_<?php echo $row->checklist_result_id; ?>" onclick="delete_item('<?php echo $row->checklist_result_id?>','modul_id','modul')"><span class="btn-label icon fa fa-times"></span> Delete Question</button>
                                                        <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_modul_<?php echo $row->checklist_result_id?>" style="display:none" /> 
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <?php endforeach;?>

                        <?php endif; ?>

                        </div>
                    </div>
                </div>
</div>				

