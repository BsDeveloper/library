<div id="content-wrapper">


<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================

        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/codemirror/3.20.0/theme/blackboard.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/codemirror/3.20.0/theme/monokai.min.css">
        <script type="text/javascript" src="<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.js"></script>
        <script src="<?php echo base_url()?>assets/codemirror/3.20.0/mode/xml/xml.min.js"></script>
        <script src="<?php echo base_url()?>assets/codemirror/2.36.0/formatting.min.js"></script>
        <!-- <script type="text/javascript" src="<?php echo base_url()?>assets/jquery.ajax.upload.js"></script>-->
        <!-- <script src="<?php echo base_url()?>assets/ajaxfileupload.js"></script>-->
        <script src="<?php echo base_url()?>assets/afu.js"></script>

        <!-- Javascript -->
        <script>
            var baseurl = '<?php echo base_url()?>';

            function new_item(kode,field,table)
            {
                $("#add_item_"+table+"_"+kode).hide(); //hide submit button
                $("#loading_image_"+table+"_"+kode).show(); //show loading image
                console.log('masuk ke fungsinya bro');

                jQuery.ajax({
                    url: baseurl+"admin/level/add_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
                    success:function(response){
                        $("#respond_item_"+table+"_"+kode).append(response);
                        // $("#respond_item"+kode).html(response);
                        $("#add_item_"+table+"_"+kode).show(); //show submit button
                        $("#loading_image_"+table+"_"+kode).hide(); //hide loading image
                        // alert(thrownError);
                        console.log('masuk ke ajax sukses');
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        console.log(thrownError);
                        $("#add_item_"+table+"_"+kode).show(); //show submit button
                        $("#loading_image_"+table+"_"+kode).hide(); //hide loading image
                        // alert(thrownError);
                    }
                });

            }

            function delete_item(kode,field,table)
            {
                $("#delete_item_"+table+"_"+kode).hide(); //hide submit button
                $("#loading_image_del_"+table+"_"+kode).show(); //show loading image
                console.log('masuk ke fungsi delete');
                
                jQuery.ajax({
                    url: baseurl+"admin/level/delete_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
                    success:function(response){
                        $("#target_item_"+table+"_"+kode).fadeOut();
                        $("#target_item_"+table+"_"+kode).hide();

                        $("#delete_item_"+table+"_"+kode).show(); //show submit button
                        $("#loading_del_image_"+table+"_"+kode).hide(); //hide loading image
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        console.log(thrownError);
                        $("#delete_item_"+table+"_"+kode).show(); //show submit button
                        $("#loading_del_image_"+table+"_"+kode).hide(); //hide loading image
                    }
                });

            }

            
            function upload_item(kode,field,table)
            {
            	$("#upload_item_"+table+"_"+kode).hide(); //hide submit button
                $("#loading_image_upload_"+table+"_"+kode).show(); //show loading image
            	console.log('masuk ke fungsi upload');


            	$.AjaxFileUpload({
					url 			: baseurl+"admin/level/upload_item/"+kode+"/"+field+"/"+table, 
					secureuri		: false,
					fileElementId	:'userfile_'+table+'_'+field+'_'+kode,
					dataType		: 'json',
					data			: {
						'title'				: $('#sub_modul_title_'+kode).val()
					},
					success	: function (data, status)
					{
						if(data.status != 'error')
						{
							// $('#files').html('<p>Reloading files...</p>');
							// refresh_files();
							// $('#title').val('');
							alert('sukses brow');
							$("#upload_item_"+table+"_"+kode).show(); //show submit button
	                        $("#loading_image_upload_"+table+"_"+kode).hide(); //hide loading image
						}
						console.log(data.msg);
					},
					error:function (xhr, ajaxOptions, thrownError){
                        console.log(thrownError);
                        $("#upload_item_"+table+"_"+kode).show(); //show submit button
                        $("#loading_image_upload_"+table+"_"+kode).hide(); //hide loading image
                    }
				});
				return false;
            }
            
            /*
            function upload_item(kode,field,table)
            {
            	$("#upload_item_"+table+"_"+kode).hide(); //hide submit button
                $("#loading_image_upload_"+table+"_"+kode).show(); //show loading image
            	console.log('masuk ke fungsi upload');

            	// var upload = new AjaxUpload('#userfile_'+table+'_'+field+'_'+kode, {			
            	var upload = new AjaxUpload('#userfile', {			
					action: baseurl+'admin/level/do_upload',
					onSubmit : function(file, extension){
						$("#loading_inline").show();
						if(! (extension && /^(jpg|png|jpeg|gif)$/.test(extension)))
						{      
							$("#loading_inline").hide();
							$("#warning_add_karyawan").html("<span class='error'>Format Gambar Harus JPG, PNG JPEG dan GIF</span>");
							$("#warning_add_karyawan").show(300).delay(4000).fadeOut(300);			
							return false;
						} 
						else 
						{			  
							$('.error').hide();
						}	
						
						upload.setData({'file': file,'folder':folder});
					},
					onComplete : function(file, response){
						$("#loading_inline").hide();
						$(".success").css("display", "block");

						var oBody = $(".iframe").contents().find("div");			
						 $("#tempat_gbr").html(oBody);
						
						var input_hidden_gbr = $('div.success').html();
						$('input#source_foto').attr('value',input_hidden_gbr);
						$('input#source_gbr').attr('value',input_hidden_gbr);
						
					}
				});
            }
            */
            

            init.push(function () {

                $('.form_editable').editable();

                $('.styled-finputs').pixelFileInput({ placeholder: 'Picture File Only', width:100 });

                if (! $('html').hasClass('ie8')) {
                    $('.summernote-example').summernote({
                        height: 200,
                        tabsize: 2,
                        codemirror: {
                            theme: 'monokai'
                        }
                    });
                }

                $('#loading-example-btn').click(function () {
                    var btn = $(this);
                    btn.button('loading');
                    setTimeout(function () {
                        btn.button('reset');
                    }, 1500);
                });

                $('[data-toggle="tab"]').click(function(e) {
                    var $this = $(this),
                        loadurl = $this.attr('href'),
                        targ = $this.attr('data-target');

                    if(loadurl != '') {
                        $.get(loadurl, function(data) {
                            $(targ).html(data);
                        });
                    }

                    $this.tab('show');
                    return false;
                });

                $( ".ui-accordion" ).accordion({
                    heightStyle: "content",
                    header: "> div > h3",
                    active: false,
                    collapsible: true,
                }).sortable({
                    axis: "y",
                    handle: "h3",
                    stop: function( event, ui ) {
                        // IE doesn't register the blur when sorting
                        // so trigger focusout handlers to remove .ui-state-focus
                        ui.item.children( "h3" ).triggerHandler( "focusout" );
                    },
                    update: function (event, ui) {
                        var data = $(this).sortable('serialize');
                        
                        // POST to server using $.post or $.ajax
                        $.ajax({
                            data: data,
                            type: 'POST',
                            url: baseurl+"admin/level/sorting/sub_modul_order/sub_modul_id/sub_modul"
                        });

                    } 
                });

                $( ".ui-quiz" ).accordion({
                    heightStyle: "content",
                    header: "> div > h3",
                    active: false,
                    collapsible: true,
                }).sortable({
                    axis: "y",
                    handle: "h3",
                    stop: function( event, ui ) {
                        // IE doesn't register the blur when sorting
                        // so trigger focusout handlers to remove .ui-state-focus
                        ui.item.children( "h3" ).triggerHandler( "focusout" );
                    },
                    update: function (event, ui) {
                        var data = $(this).sortable('serialize');
                        
                        // POST to server using $.post or $.ajax
                        $.ajax({
                            data: data,
                            type: 'POST',
                            url: baseurl+"admin/level/sorting/bank_soal_order/bank_soal_id/bank_soal"
                        });

                    } 
                });

                $( ".ui-jawaban" ).accordion({
                    heightStyle: "content",
                    header: "> div > h3",
                    active: false,
                    collapsible: true,
                }).sortable({
                    axis: "y",
                    handle: "h3",
                    stop: function( event, ui ) {
                        // IE doesn't register the blur when sorting
                        // so trigger focusout handlers to remove .ui-state-focus
                        ui.item.children( "h3" ).triggerHandler( "focusout" );
                    },
                    update: function (event, ui) {
                        var data = $(this).sortable('serialize');
                        
                        // POST to server using $.post or $.ajax
                        $.ajax({
                            data: data,
                            type: 'POST',
                            url: baseurl+"admin/level/sorting/soal_option_order/soal_option_id/soal_option"
                        });

                    } 
                });



            });
        </script>
        <!-- / Javascript -->

        <script type="text/javascript">
            $(function() {
                $('#upload_file').submit(function(e) {
                    e.preventDefault();
                    $.ajaxFileUpload({
                        url             :baseurl + 'level/upload_file/', 
                        secureuri       :false,
                        fileElementId   :'userfile',
                        dataType: 'JSON',
                        success : function (data)
                        {
                           var obj = jQuery.parseJSON(data);                
                            if(obj['status'] == 'success')
                            {
                                $('#files').html(obj['msg']);
                             }
                            else
                             {
                                $('#files').html('Some failure message');
                              }
                        }
                    });
                    return false;
                });
            });
        </script>

        


        <?php
          $message = $this->session->flashdata('warning');
          echo $message == '' ? '' : '<div class="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><i class="fa fa-exclamation"></i></strong> ' . $message . '</div>';
        ?>
        <?php
          $message = $this->session->flashdata('danger');
          echo $message == '' ? '' : '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><i class="fa fa-times"></i></strong> ' . $message . '</div>';
        ?>
        <?php
          $message = $this->session->flashdata('success');
          echo $message == '' ? '' : '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><i class="fa fa-check"></i></strong> ' . $message . '</div>';
        ?>
        <?php
          $message = $this->session->flashdata('info');
          echo $message == '' ? '' : '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><i class="fa fa-exclamation"></i></strong> ' . $message . '</div>';
        ?>

    <div class="mail-nav">
        <div class="compose-btn">
            <a href="<?php echo base_url()?>admin/level/add" class="btn btn-primary btn-labeled btn-block"><i class="btn-label fa fa-pencil-square-o"></i>New Level</a>
        </div>
        <div class="navigation">
            <ul class="sections">
                <li class="active"><a href="" data-target="#uidemo-tabs-default-demo-basic" data-toggle="tab"><i class="fa fa-check"></i> Basic</a></li>
                <li><a href="" data-target="#deskripsi" data-toggle="tab"><i class="fa fa-th"></i> Description</a></li>
                <li><a href="" data-target="#uidemo-tabs-default-demo-picture" data-toggle="tab"><i class="fa fa-picture-o"></i> Picture</a></li>
                <li><a href="" data-target="#uidemo-tabs-default-demo-materi" data-toggle="tab"><i class="fa fa-book"></i> Course </a></li>

            </ul>

        </div>
    </div>

    
    <div class="mail-container">
        <div class="mail-container-header">
            <?php echo set_value('level_title', isset($default['level_title']) ? $default['level_title'] : ''); ?>

        </div>

        <div class="tab-content">
            <div class="tab-pane fade active in" id="uidemo-tabs-default-demo-basic">
                <div class="form-horizontal row">
                    <div class="form-group <?php if(form_error('level_title') != '') { echo 'has-error'; } ?>">
                        <div class="row">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-8">
                                <a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah nama level"  data-url="<?php echo base_url()?>admin/level/update_field/level_title/<?php echo set_value('level_id', isset($default['level_id']) ? $default['level_id'] : $this->uri->segment('4')); ?>/level_id/level"><?php echo set_value('level_title', isset($default['level_title']) ? $default['level_title'] : ''); ?></a>
                                <input type="hidden" name="level_id" class="form-control" placeholder="id level" value="<?php echo set_value('level_id', isset($default['level_id']) ? $default['level_id'] : ''); ?>">
                                <?php echo form_error('level_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('level_title') != '') { echo 'has-error'; } ?>">
                        <div class="row">
                            <label class="col-sm-3 control-label">"Do you think" text</label>
                            <div class="col-sm-8">
                                <a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah text"  data-url="<?php echo base_url()?>admin/level/update_field/level_desc_3/<?php echo set_value('level_id', isset($default['level_id']) ? $default['level_id'] : $this->uri->segment('4')); ?>/level_id/level"><?php echo set_value('level_desc_3', isset($default['level_desc_3']) ? $default['level_desc_3'] : ''); ?></a>
                                <input type="hidden" name="level_id" class="form-control" placeholder="id level" value="<?php echo set_value('level_id', isset($default['level_id']) ? $default['level_id'] : ''); ?>">
                                <?php echo form_error('level_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('level_title') != '') { echo 'has-error'; } ?>">
                        <div class="row">
                            <label class="col-sm-3 control-label">"What will get" text</label>
                            <div class="col-sm-8">
                                <a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah text"  data-url="<?php echo base_url()?>admin/level/update_field/level_desc_4/<?php echo set_value('level_id', isset($default['level_id']) ? $default['level_id'] : $this->uri->segment('4')); ?>/level_id/level"><?php echo set_value('level_desc_4', isset($default['level_desc_4']) ? $default['level_desc_4'] : ''); ?></a>
                                <input type="hidden" name="level_id" class="form-control" placeholder="id level" value="<?php echo set_value('level_id', isset($default['level_id']) ? $default['level_id'] : ''); ?>">
                                <?php echo form_error('level_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('level_price') != '') { echo 'has-error'; } ?>">
                        <div class="row">
                            <label class="col-sm-3 control-label">Price </label>
                            <div class="col-sm-8">
                                <a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah harga level"  data-url="<?php echo base_url()?>admin/level/update_field/level_price/<?php echo set_value('level_id', isset($default['level_id']) ? $default['level_id'] : $this->uri->segment('4')); ?>/level_id/level"><?php echo set_value('level_price', isset($default['level_price']) ? $default['level_price'] : ''); ?></a>
                                <?php echo form_error('level_price', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="deskripsi">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-horizontal row">
                            <div class="form-group <?php if(form_error('level_desc_1') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Desc 1</label>
                                    <div class="col-sm-9">
                                        <textarea class="summernote-example" id="" name="level_desc_1" rows="10"><?php echo set_value('level_desc_1', isset($default['level_desc_1']) ? $default['level_desc_1'] : ''); ?></textarea>
                                        <?php echo form_error('level_desc_1', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group <?php if(form_error('level_desc_2') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Desc 2</label>
                                    <div class="col-sm-9">
                                        <textarea class="summernote-example" id="" name="level_desc_2" rows="10"><?php echo set_value('level_desc_2', isset($default['level_desc_2']) ? $default['level_desc_2'] : ''); ?></textarea>
                                        <?php echo form_error('level_desc_2', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="uidemo-tabs-default-demo-picture">
                <div class="form-horizontal row">

                    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">
                         <div class="row">
                            <label class="col-sm-2 control-label">Picture</label>
                            <div class="col-sm-4">
                                <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture" >
                                <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                            <div class="col-sm-3">
                                <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['level_picture']) ? $default['level_picture'] : '') == '' ) : echo 'disabled'; endif; ?>"><!-- <span class="btn-label icon fa fa-camera-retro"></span> --> View Image</button>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="tab-pane fade" id="uidemo-tabs-default-demo-materi">
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <div class="row">
                            <a id="add_item_modul_<?php echo $this->uri->segment('4')?>" class="btn btn-labeled btn-success" href="javascript:;" onclick="new_item('<?php echo $this->uri->segment('4')?>','level_id','modul')"><span class="btn-label icon fa fa-plus"></span> Add Modul</a>
                            <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_modul_<?php echo $this->uri->segment('4')?>" style="display:none" /> 
                            <br><br>
                        </div>
                        <?php $query_modul = $this->model_utama->cek_order($default['level_id'],'level_id','modul_order','asc','modul'); ?>
                        <div class="form-horizontal row" id="respond_item_modul_<?php echo $this->uri->segment('4')?>">
                        <?php if($query_modul->num_rows() > 0) : ?>
                            
                                    <?php foreach($query_modul->result() as $row) : ?>
                                    <div class="row" id="target_item_modul_<?php echo $row->modul_id?>">
                                        <div class="col-md-11">

                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <span class="panel-title"><h2><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah nama modul"  data-url="<?php echo base_url()?>admin/level/update_field/modul_title/<?php echo $row->modul_id; ?>/modul_id/modul"><?php echo set_value('modul_title', isset($row->modul_title) ? $row->modul_title : ''); ?></a></h2></span>
                                                </div>
                                                <div class="panel-body">
                                                    <a id="add_item_sub_modul_<?php echo $row->modul_id?>" class="btn btn-labeled btn-success btn-xs" href="javascript:;" onclick="new_item('<?php echo $row->modul_id; ?>','modul_id','sub_modul')"><span class="btn-label icon fa fa-plus"></span> Add Sub Modul</a>
                                                    <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_sub_modul_<?php echo $row->modul_id?>" style="display:none" /> 
                                                    <br><br>
                                                    <?php $query_sub_modul = $this->model_utama->cek_order($row->modul_id,'modul_id','sub_modul_order','asc','sub_modul'); ?>
                                                    
                                                    <div class="ui-accordion" id="respond_item_sub_modul_<?php echo $row->modul_id?>">
                                                    <?php if($query_sub_modul->num_rows() > 0) : $num_sub = 1;?>
                                                        <?php foreach($query_sub_modul->result() as $sub) : ?>
                                                        <div class="group" id="target_item_sub_modul_<?php echo $sub->sub_modul_id; ?>">
                                                            <h3><strong>Slide Number <?php echo $num_sub++; ?> : <?php echo set_value('sub_modul_title', isset($sub->sub_modul_title) ? $sub->sub_modul_title : ''); ?></strong></h3>
                                                            <div>
                                                                <table class="table">
                                                            		<tr>
                                                            			<td>Nama Slide</td>
                                                            			<td><a href="#" id="sub_modul_title_<?php echo $sub->sub_modul_title; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah nama sub modul"  data-url="<?php echo base_url()?>admin/level/update_field/sub_modul_title/<?php echo $sub->sub_modul_id; ?>/sub_modul_id/sub_modul"><?php echo set_value('sub_modul_title', isset($sub->sub_modul_title) ? $sub->sub_modul_title : ''); ?></a></td>
                                                            			<td></td>
                                                            		</tr>
                                                            		<tr>
                                                            			<td>Video Slide</td>
                                                            			<td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah deskripsi sub modul"  data-url="<?php echo base_url()?>admin/level/update_field/sub_modul_description/<?php echo $sub->sub_modul_id; ?>/sub_modul_id/sub_modul"><?php echo set_value('sub_modul_description', isset($sub->sub_modul_description) ? $sub->sub_modul_description : ''); ?></a></td>
                                                            			<td></td>
                                                            		</tr>
                                                            		<tr>
                                                            			<td>Gambar Slide</td>
                                                            			<td>
                                                                            <span class="btn btn-success fileinput-button">
                                                                                <i class="glyphicon glyphicon-plus"></i>
                                                                                <span>Add files...</span>
                                                                                <!-- The file input field used as target for the file upload widget -->
                                                                                <input class="fileupload" type="file" name="files">
                                                                            </span></td>
                                                            			<td>
                                                            				<!-- The container for the uploaded files -->
                                                                            <div id="files" class="files"></div>
                                                            			</td>
                                                            		</tr>
                                                            	</table>
                                                                <hr>
                                                                <button class="btn btn-labeled btn-success btn-xs" type="button" id="add_item_bank_soal_<?php echo $sub->sub_modul_id; ?>" onclick="new_item('<?php echo $sub->sub_modul_id?>','sub_modul_id','bank_soal')"><span class="btn-label icon fa fa-plus"></span> Add Quiz</button>
                                                                <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_bank_soal_<?php echo $sub->sub_modul_id?>" style="display:none" /> 
                                                                <br><br>
                                                                
                                                                <div class="ui-quiz" id="respond_item_bank_soal_<?php echo $sub->sub_modul_id; ?>">
                                                                <?php $query_bank_soal = $this->model_utama->cek_order($sub->sub_modul_id,'sub_modul_id','bank_soal_order','asc','bank_soal'); ?>
                                                                <?php $query_fitur_game = $this->model_utama->get_data('fitur_game'); ?>
                                                                <?php if($query_bank_soal->num_rows() > 0) : $num_quiz = 1; ?>
                                                                    <?php foreach($query_bank_soal->result() as $qui) : ?>
                                                                        <div class="group" id="target_item_bank_soal_<?php echo $qui->bank_soal_id; ?>">
                                                                            <h3>Quiz <?php echo $num_quiz++; ?> </h3>
                                                                            <div>
                                                                                <table class="table">
                                                                                    <tr>
                                                                                        <td>Quiz Title</td>
                                                                                        <td><a href="#" id="bank_soal_pertanyaan_<?php echo $qui->bank_soal_title; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah nama soal"  data-url="<?php echo base_url()?>admin/level/update_field/bank_soal_title/<?php echo $qui->bank_soal_id; ?>/bank_soal_id/bank_soal"><?php echo set_value('bank_soal_title', isset($qui->bank_soal_title) ? $qui->bank_soal_title : ''); ?></a></td>
                                                                                        <td></td>
                                                                                    </tr>
																					<tr>
                                                                                        <td>Quiz Name</td>
                                                                                        <td><a href="#" id="bank_soal_pertanyaan_<?php echo $qui->bank_soal_pertanyaan; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah nama soal"  data-url="<?php echo base_url()?>admin/level/update_field/bank_soal_pertanyaan/<?php echo $qui->bank_soal_id; ?>/bank_soal_id/bank_soal"><?php echo set_value('bank_soal_pertanyaan', isset($qui->bank_soal_pertanyaan) ? $qui->bank_soal_pertanyaan : ''); ?></a></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Feature</td>
                                                                                        <td><a href="#" class="form_editable" data-type="select" data-source='[<?php if($query_fitur_game->num_rows() > 0) :  foreach($query_fitur_game->result() as $fg) : ?>{value: <?php echo $fg->fitur_game_id; ?>, text: "<?php echo $fg->fitur_game_title?>"}, <?php endforeach; endif; ?>]' data-pk="1" data-title="Ubah fitur"  data-url="<?php echo base_url()?>admin/level/update_field/fitur_game_id/<?php echo $qui->bank_soal_id; ?>/bank_soal_id/bank_soal"><?php echo set_value('fitur_game_id', isset($qui->fitur_game_id) ? $this->model_utama->get_detail($qui->fitur_game_id,'fitur_game_id','fitur_game')->row()->fitur_game_title : ''); ?></a></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Right Answer</td>
                                                                                        <td><a href="#" class="form_editable" data-type="select" data-source='[{value: "1", text: "A"},{value: "2", text: "B"},{value: "3", text: "C"},{value: "4", text: "D"}, ]' data-pk="1" data-title="Ubah jawaban"  data-url="<?php echo base_url()?>admin/level/update_field/bank_soal_jawaban/<?php echo $qui->bank_soal_id; ?>/bank_soal_id/bank_soal"><?php echo set_value('bank_soal_jawaban', isset($qui->bank_soal_jawaban) ? $qui->bank_soal_jawaban : ''); ?></a></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </table>
                                                                                <br>
                                                                                <button class="btn btn-labeled btn-success btn-xs" type="button" id="add_item_soal_option_<?php echo $qui->bank_soal_id; ?>" onclick="new_item('<?php echo $qui->bank_soal_id?>','bank_soal_id','soal_option')"><span class="btn-label icon fa fa-plus"></span> Add Answer</button>
                                                                                <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_soal_option_<?php echo $qui->bank_soal_id?>" style="display:none" /> 
                                                                                
                                                                                <a href="<?php echo base_url()?>admin/level/add_detail/<?php echo $qui->bank_soal_id?>" target="_blank"><button class="btn btn-labeled btn-success btn-xs" type="button" ><span class="btn-label icon fa fa-plus"></span> Add Detail</button></a>

                                                                                <br><br>

                                                                                <div class="ui-jawaban" id="respond_item_soal_option_<?php echo $qui->bank_soal_id; ?>">
                                                                                <?php $query_soal_option = $this->model_utama->cek_order($qui->bank_soal_id,'bank_soal_id','soal_option_order','asc','soal_option'); ?>
                                                                                <?php if($query_soal_option->num_rows() > 0) : $num_option = 1; ?>
                                                                                    <?php foreach($query_soal_option->result() as $so) : ?>
                                                                                        <div class="group" id="target_item_soal_option_<?php echo $so->soal_option_id; ?>">
                                                                                            <h3>Answer <?php echo $num_option++; ?> </h3>
                                                                                            <div>
                                                                                                <table class="table">
                                                                                                    <tr>
                                                                                                        <td>Answer Text</td>
                                                                                                        <td><a href="#" id="soal_option_title_<?php echo $so->soal_option_title; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah text jawaban"  data-url="<?php echo base_url()?>admin/level/update_field/soal_option_title/<?php echo $so->soal_option_id; ?>/soal_option_id/soal_option"><?php echo set_value('soal_option_title', isset($so->soal_option_title) ? $so->soal_option_title : ''); ?></a></td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Description Text</td>
                                                                                                        <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah text jawaban"  data-url="<?php echo base_url()?>admin/level/update_field/soal_option_description/<?php echo $so->soal_option_id; ?>/soal_option_id/soal_option"><?php echo set_value('soal_option_description', isset($so->soal_option_description) ? $so->soal_option_description : ''); ?></a></td>
                                                                                                        <td></td>
                                                                                                    </tr>
																									<tr>
                                                                                                        <td>Additional Info</td>
                                                                                                        <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah text jawaban"  data-url="<?php echo base_url()?>admin/level/update_field/option_additional_info/<?php echo $so->soal_option_id; ?>/soal_option_id/soal_option"><?php echo set_value('option_additional_info', isset($so->option_additional_info) ? $so->option_additional_info : ''); ?></a></td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Answer Picture <i>(optional)</i></td>
                                                                                                        <td></td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                                <br>
                                                                                                <p class="text-right">
                                                                                                    <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_soal_option_<?php echo $so->soal_option_id; ?>" onclick="delete_item('<?php echo $so->soal_option_id?>','soal_option_id','soal_option')"><span class="btn-label icon fa fa-times"></span> Delete Answer</button>
                                                                                                    <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_soal_option_<?php echo $so->soal_option_id?>" style="display:none" /> 
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endforeach;?>
                                                                                <?php endif;?>

                                                                                </div>
                                                                                <br>
                                                                                <p class="text-right">
                                                                                    <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_bank_soal_<?php echo $qui->bank_soal_id; ?>" onclick="delete_item('<?php echo $qui->bank_soal_id?>','bank_soal_id','bank_soal')"><span class="btn-label icon fa fa-times"></span> Delete Quiz</button>
                                                                                    <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_bank_soal_<?php echo $qui->bank_soal_id?>" style="display:none" /> 
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                                </div>
                                                                <br>
                                                                <p class="text-right">
                                                                    <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_sub_modul_<?php echo $sub->sub_modul_id; ?>" onclick="delete_item('<?php echo $sub->sub_modul_id?>','sub_modul_id','sub_modul')"><span class="btn-label icon fa fa-times"></span> Delete Sub Modul</button>
                                                                    <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_sub_modul_<?php echo $sub->sub_modul_id?>" style="display:none" /> 
                                                                </p>
                                                            </div>
                                                        </div> <!-- / .group -->
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    
                                                    </div> <!-- / #ui-accordion -->
                                                </div>
                                                <div class="panel-footer">
                                                    <p class="text-right">
                                                        <button class="btn btn-labeled btn-danger" type="button" id="delete_item_modul_<?php echo $row->modul_id; ?>" onclick="delete_item('<?php echo $row->modul_id?>','modul_id','modul')"><span class="btn-label icon fa fa-times"></span> Delete Modul</button>
                                                        <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_modul_<?php echo $row->modul_id?>" style="display:none" /> 
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

            </div> <!-- / .tab-pane -->
        </div>

        <div class="panel-footer text-right">
            <!-- <button class="btn btn-primary" type="submit">Save</button> -->
            <a href="<?php echo base_url()?>admin/level"><button class="btn btn-danger" type="button">Back</button></a>
        </div>



    </div>


                

<!-- /5. $SUMMERNOTE_WYSIWYG_EDITOR -->


    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
    <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/javascripts/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->

<script src="<?php echo base_url()?>assets/javascripts/jquery.transit.js"></script>

<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/javascripts/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
    init.push(function () {
        // Javascript code here
        // Open nav on mobile
        $('.mail-nav .navigation li.active a').click(function () {
            $('.mail-nav .navigation').toggleClass('open');
            return false;
        });

        // Make message starred/unstarred
        $('body').on('click', '.m-star', function () {
            $(this).parents('.mail-item').toggleClass('starred');
            return false;
        });

        // Fix navigation if main menu is fixed
        if ($('body').hasClass('main-menu-fixed')) {
            $('.mail-nav').addClass('fixed');
        }

    });
    window.PixelAdmin.start(init);
</script>


<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Data Gambar</h4>
            </div>
            <div class="modal-body">
                <img width="100%" src="<?php echo base_url()?>uploads/courses/<?php echo set_value('level_picture', isset($default['level_picture']) ? $default['level_picture'] : '3.jpg'); ?>">
            </div> <!-- / .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->
<!-- / Modal -->

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="http://blueimp.github.io/jQuery-File-Upload/css/jquery.fileupload.css">
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="http://blueimp.github.io/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="http://blueimp.github.io/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="http://blueimp.github.io/jQuery-File-Upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="http://blueimp.github.io/jQuery-File-Upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="http://blueimp.github.io/jQuery-File-Upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="http://blueimp.github.io/jQuery-File-Upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="http://blueimp.github.io/jQuery-File-Upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="http://blueimp.github.io/jQuery-File-Upload/js/jquery.fileupload-validate.js"></script>

<script>
    /*jslint unparam: true, regexp: true */
    /*global window, $ */
    var baseurl = '<?php echo base_url(); ?>';

    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url =  baseurl+'admin/level/upload_file',
            uploadButton = $('<button/>')
                .addClass('btn btn-primary')
                .prop('disabled', true)
                .text('Processing...')
                .on('click', function () {
                    var $this = $(this),
                        data = $this.data();
                    $this
                        .off('click')
                        .text('Abort')
                        .on('click', function () {
                            $this.remove();
                            data.abort();
                        });
                    data.submit().always(function () {
                        $this.remove();
                    });
                });
        $('.fileupload').fileupload({
            url: url,
            dataType: 'json',
            autoUpload: false,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize: 5000000, // 5 MB
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            previewMaxWidth: 100,
            previewMaxHeight: 100,
            previewCrop: true
        }).on('fileuploadadd', function (e, data) {
            data.context = $('<div/>').appendTo('#files');
            $.each(data.files, function (index, file) {
                var node = $('<p/>')
                        .append($('<span/>').text(file.name));
                if (!index) {
                    node
                        .append('<br>')
                        .append(uploadButton.clone(true).data(data));
                }
                node.appendTo(data.context);
            });
        }).on('fileuploadprocessalways', function (e, data) {
            var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
            if (file.preview) {
                node
                    .prepend('<br>')
                    .prepend(file.preview);
            }
            if (file.error) {
                node
                    .append('<br>')
                    .append($('<span class="text-danger"/>').text(file.error));
            }
            if (index + 1 === data.files.length) {
                data.context.find('button')
                    .text('Upload')
                    .prop('disabled', !!data.files.error);
            }
        }).on('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }).on('fileuploaddone', function (e, data) {
            $.each(data.result.files, function (index, file) {
                if (file.url) {
                    var link = $('<a>')
                        .attr('target', '_blank')
                        .prop('href', file.url);
                    $(data.context.children()[index])
                        .wrap(link);
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index])
                        .append('<br>')
                        .append(error);
                }
            });
        }).on('fileuploadfail', function (e, data) {
            $.each(data.files, function (index) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            });
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
</script>