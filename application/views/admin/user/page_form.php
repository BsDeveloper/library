<?php $query_kursus = $this->model_utama->get_data('kursus'); ?>
<div id="content-wrapper">



        <div class="page-header">

            <h1><span class="text-light-gray"><a href="<?php echo base_url()?>admin/user"><?php echo ucwords('user') ?></a> / </span><?php echo ucwords($heading)?></h1>

        </div> <!-- / .page-header -->





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

        <script type="text/javascript">
            function new_item(kode,field,table)
            {
                $("#add_item_"+table+"_"+kode).hide(); //hide submit button
                $("#loading_image_"+table+"_"+kode).show(); //show loading image
                console.log('masuk ke fungsinya bro');

                jQuery.ajax({
                    url: baseurl+"admin/user/add_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
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
                var x;
                if (confirm("Anda yakin? Sekali dihapus, tidak dapat dikembalikan lagi.") == true) {
                    $("#delete_item_"+table+"_"+kode).hide(); //hide submit button
                    $("#loading_image_del_"+table+"_"+kode).show(); //show loading image
                    console.log('masuk ke fungsi delete');
                    
                    jQuery.ajax({
                        url: baseurl+"admin/user/delete_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
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

            }
        </script>

        <!-- Javascript -->

        <script>

            init.push(function () {

                $('#styled-finputs-example').pixelFileInput({ placeholder: 'Picture File Only' });



                if (! $('html').hasClass('ie8')) {

                    $('#summernote-example').summernote({

                        height: 200,

                        tabsize: 2,

                        codemirror: {

                            theme: 'monokai'

                        }

                    });

                }

                $('#summernote-boxed').switcher({

                    on_state_content: '<span class="fa fa-check" style="font-size:11px;"></span>',

                    off_state_content: '<span class="fa fa-times" style="font-size:11px;"></span>'

                });

                $('#summernote-boxed').on($('html').hasClass('ie8') ? "propertychange" : "change", function () {

                    var $panel = $(this).parents('.panel');

                    if ($(this).is(':checked')) {

                        $panel.find('.panel-body').addClass('no-padding');

                        $panel.find('.panel-body > *').addClass('no-border');

                    } else {

                        $panel.find('.panel-body').removeClass('no-padding');

                        $panel.find('.panel-body > *').removeClass('no-border');

                    }

                });



                $('#loading-example-btn').click(function () {

                    var btn = $(this);

                    btn.button('loading');

                    setTimeout(function () {

                        btn.button('reset');

                    }, 1500);

                });

                $('.form_editable').editable();

                $('#bs-datepicker-component').datepicker();

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
                            url: baseurl+"admin/user/sorting/user_kursus_order/user_kursus_id/user_kursus"
                        });

                    } 
                });



            });

        </script>

        <!-- / Javascript -->





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


        <div class="row">
            <div class="col-md-6">
                <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">

                    <div class="panel-heading">

                        <span class="panel-title"><?php echo set_value('user_name', isset($default['user_name']) ? ucwords($default['user_name']) : ucwords($heading)); ?></span>

                    </div>

                    <div class="panel-body no-padding-hr">

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('user_name') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Nama</label>

                                <div class="col-sm-10">

                                    <input type="text" required name="user_name" class="form-control" placeholder="Nama" value="<?php echo set_value('user_name', isset($default['user_name']) ? $default['user_name'] : ''); ?>">

                                    <input type="hidden" name="user_id" class="form-control" placeholder="id user" value="<?php echo set_value('user_id', isset($default['user_id']) ? $default['user_id'] : ''); ?>">

                                    <?php echo form_error('user_name', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>



                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('username') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Username</label>

                                <div class="col-sm-7">

                                    <input type="text" required name="username" class="form-control" placeholder="username" value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>" <?php echo set_value('username', isset($default['username']) ? 'readonly' : ''); ?>>

                                    <?php echo form_error('username', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>



                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('password') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-7">

                                    <input type="password" name="password" class="form-control" placeholder="password" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>">

                                    <?php echo form_error('password', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>



                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('user_email') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-8">

                                    <input type="email" name="user_email" class="form-control" placeholder="email" value="<?php echo set_value('user_email', isset($default['user_email']) ? $default['user_email'] : ''); ?>">

                                    <?php echo form_error('user_email', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>





                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('user_status') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label"><strong>Level User</strong></label>

                                <div class="col-sm-10">

                                    <label class="radio-inline">

                                        <input required type="radio" name="user_status" id="inlineCheckbox1" value="user" class="px" <?php echo set_radio('user_status', 'user', isset($default['user_status']) && $default['user_status'] == 'user' ? TRUE : FALSE); ?>> <span class="lbl">User</span>

                                    </label>

                                    <label class="radio-inline">

                                        <input required type="radio" name="user_status" id="inlineCheckbox2" value="staff" class="px" <?php echo set_radio('user_status', 'staff', isset($default['user_status']) && $default['user_status'] == 'staff' ? TRUE : FALSE); ?>> <span class="lbl">Staff</span>

                                    </label>

                                    <label class="radio-inline">

                                        <input required type="radio" name="user_status" id="inlineCheckbox3" value="manager" class="px" <?php echo set_radio('user_status', 'manager', isset($default['user_status']) && $default['user_status'] == 'manager' ? TRUE : FALSE); ?>> <span class="lbl">Manager</span>

                                    </label>

                                    <?php echo form_error('user_status', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>




                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Foto</label>

                                <div class="col-sm-7">

                                    <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture" >

                                    <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                                <div class="col-sm-3">

                                    <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['user_picture']) ? $default['user_picture'] : '') == '' ) : echo 'disabled'; endif; ?>"><!-- <span class="btn-label icon fa fa-camera-retro"></span> --> View Image</button>

                                </div>

                            </div>

                        </div>



                    </div>

                    <div class="panel-footer text-right">

                        <button class="btn btn-primary" type="submit">Save</button>

                        <a href="<?php echo site_url('admin/user')?>"><button class="btn btn-default" type="button">Back</button></a>

                    </div>

                </form>
            </div>

            <div class="col-md-6">
                <div class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title">Daftar Materi <?php echo set_value('user_name', isset($default['user_name']) ? 'Milik '. ucwords($default['user_name']) : ''); ?></span>
                    </div>
                    <div class="panel-body ">
                        <a id="add_item_user_kursus_<?php echo $this->uri->segment('4')?>" class="btn btn-labeled btn-xs btn-success" href="javascript:;" onclick="new_item('<?php echo $this->uri->segment('4')?>','user_id','user_kursus')"><span class="btn-label icon fa fa-plus"></span> Tambah Materi</a>
                        <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_user_kursus_<?php echo $this->uri->segment('4')?>" style="display:none" /> 
                        <br><br>
                        <?php $query = $this->model_utama->cek_order($this->uri->segment('4'),'user_id','user_kursus_order','asc','user_kursus'); ?>
                        <div class="ui-accordion" id="respond_item_user_kursus_<?php echo $this->uri->segment('4')?>">
                        <?php if($query->num_rows() > 0) : $num_order = 1;?>
                            <?php foreach($query->result() as $row) : ?>
                                <div class="group" id="target_item_user_kursus_<?php echo $row->user_kursus_id; ?>">
                                    <h3><strong>Kursus <?php echo $num_order++; ?> : <?php echo set_value('kursus_id', isset($row->kursus_id) && $row->kursus_id != '' ? ucwords($this->model_utama->get_detail($row->kursus_id,'kursus_id','kursus')->row()->kursus_title) : ''); ?></strong></h3>
                                    <div>
                                        <table class="table">
                                            <tr>
                                                <td>Kursus</td>
                                                <td><a href="#" class="form_editable" data-type="select" data-source='[<?php if($query_kursus->num_rows() > 0) :  foreach($query_kursus->result() as $fg) : ?>{value: <?php echo $fg->kursus_id; ?>, text: "<?php echo $fg->kursus_title?>"}, <?php endforeach; endif; ?>]' data-pk="1" data-title="Ubah kursus"  data-url="<?php echo base_url()?>admin/kursus/update_field/kursus_id/<?php echo $row->user_kursus_id; ?>/user_kursus_id/user_kursus"><?php echo set_value('kursus_id', isset($row->kursus_id) ? $this->model_utama->get_detail($row->kursus_id,'kursus_id','kursus')->row()->kursus_title : ''); ?></a></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Create Date</td>
                                                <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo base_url()?>admin/kursus/update_field/create_date/<?php echo $row->user_kursus_id; ?>/user_kursus_id/user_kursus"><?php echo set_value('create_date', isset($row->create_date) ? $row->create_date : ''); ?></a></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <p class="text-right">
                                            <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_user_kursus_<?php echo $row->user_kursus_id; ?>" onclick="delete_item('<?php echo $row->user_kursus_id?>','user_kursus_id','user_kursus')"><span class="btn-label icon fa fa-times"></span> Delete</button>
                                            <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_user_kursus_<?php echo $row->user_kursus_id?>" style="display:none" /> 
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>



        <!-- Modal -->

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        <h4 class="modal-title" id="myModalLabel">Data Gambar</h4>

                    </div>

                    <div class="modal-body">

                        <img width="100%" src="<?php echo base_url()?>uploads/user/<?php echo set_value('user_picture', isset($default['user_picture']) ? $default['user_picture'] : '3.jpg'); ?>">

                    </div> <!-- / .modal-body -->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>

                </div> <!-- / .modal-content -->

            </div> <!-- / .modal-dialog -->

        </div> <!-- /.modal -->

        <!-- / Modal -->





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

    var baseurl = '<?php echo base_url()?>';



    init.push(function () {

        // Javascript code here

        $("#forum_category_id").change(function(){

            var id = $("#forum_category_id").val();

            $.ajax({

                url:baseurl+'admin/user/get_subcategory/'+id,

                //data: "materi_id="+id,

                cache: false,

                success: function(msg){

                    //jika data sukses diambil dari server kita tampilkan

                    //di <select id=kota>

                    $("#forum_subcategory_id").html(msg);

                }

            });

          });

    });

    window.PixelAdmin.start(init);

</script>