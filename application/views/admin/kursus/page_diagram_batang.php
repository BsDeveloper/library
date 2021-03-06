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

function upload_picture(kode,table)
{
	$("#modal_body").load("<?php echo base_url()?>admin/level/upload_picture/"+kode+"/"+table);
}

function tambahQuestion(kode)
{
	$("#tambahQuestionButton"+kode).hide(); //hide submit button
	$("#loadingQuestion"+kode).show(); //show loading image
	//console.log('masuk ke fungsinya bro');

	jQuery.ajax({
		url: baseurl+"admin/level/add_diagram_kategori/"+kode, //Where to make Ajax calls
		success:function(response){
			$("#boxQuestion"+kode).append(response);
			// $("#respond_item"+kode).html(response);
			$("#tambahQuestionButton"+kode).show(); //show submit button
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
		url: baseurl+"admin/level/add_diagram_question/"+kode+"/<?php echo $this->uri->segment('4')?>", //Where to make Ajax calls
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
                            <a id="tambahQuestionButton<?php echo $this->uri->segment('4')?>" class="btn btn-labeled btn-success" href="javascript:;" onclick="tambahQuestion('<?php echo $this->uri->segment('4')?>','diagram_kategori_id','diagram_kategori')"><span class="btn-label icon fa fa-plus"></span> Tambah Kategori</a>
                            <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loadingQuestion<?php echo $this->uri->segment('4')?>" style="display:none" /> 
                            <br><br>
                        </div>
                        <div class="form-horizontal row" id="boxQuestion<?php echo $this->uri->segment('4')?>">
                        <?php if($kategori->num_rows() > 0) : ?>
                            
                                    <?php foreach($kategori->result() as $row) : ?>
                                    <div class="row" id="itemQuestion<?php echo $row->diagram_kategori_id?>">
                                        <div class="col-md-11">

                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <span class="panel-title">
													<h2><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Tanda"  data-url="<?php echo base_url()?>admin/level/ubah_diagram/nama/<?php echo $row->diagram_kategori_id; ?>/diagram_kategori_id/diagram_kategori"><?php echo set_value('nama', isset($row->nama) ? $row->nama : ''); ?></a>
                                                </div>
                                                <div class="panel-body">
                                                    <a id="tambahOptionButton<?php echo $row->diagram_kategori_id?>" class="btn btn-labeled btn-success btn-xs" href="javascript:;" onclick="tambahOption('<?php echo $row->diagram_kategori_id; ?>')"><span class="btn-label icon fa fa-plus"></span> Tambah Pertanyaan</a>
                                                    <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loadingOption<?php echo $row->diagram_kategori_id?>" style="display:none" /> 
                                                    <br><br>
                                                    <?php $query_option = $this->model_utama->cek_data($row->diagram_kategori_id,'diagram_kategori_id','diagram_question'); ?>
                                                    
                                                    <div class="ui-accordion" id="boxOption<?php echo $row->diagram_kategori_id?>">
                                                    <?php if($query_option->num_rows() > 0) : $num_sub = 1;?>
                                                        <?php foreach($query_option->result() as $sub) : ?>
                                                        <div class="group" id="listOption<?php echo $sub->diagram_question_id; ?>">
                                                            <h3><strong>Pertanyaan <?php echo $num_sub++; ?> : <a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah Pertanyaan"  data-url="<?php echo base_url()?>admin/level/ubah_diagram/pertanyaan/<?php echo $sub->diagram_question_id; ?>/diagram_question_id/diagram_question"><?php echo set_value('pertanyaan', isset($sub->pertanyaan) ? $sub->pertanyaan : ''); ?></a>
															</strong></h3>
                                                            
                                                        </div> <!-- / .group -->
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    
                                                    </div> <!-- / #ui-accordion -->
                                                </div>
                                                <div class="panel-footer">
                                                    <p class="text-right">
                                                        <button class="btn btn-labeled btn-danger" type="button" id="delete_item_modul_<?php echo $row->diagram_kategori_id; ?>" onclick="delete_item('<?php echo $row->diagram_kategori_id?>','modul_id','modul')"><span class="btn-label icon fa fa-times"></span> Delete Question</button>
                                                        <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_modul_<?php echo $row->diagram_kategori_id?>" style="display:none" /> 
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

<div id="upload_modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Upload File</h4>
            </div>
            <div class="modal-body" id="modal_body">     
                <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_upload"  />            
            </div> <!-- / .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->