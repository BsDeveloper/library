<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/liputan')?>"><?php echo ucwords('liputan') ?></a> / </span><?php echo ucwords($heading)?></h1>
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

                $('#bs-datepicker-component').datepicker();

                 // Single select
                $("#category_id").select2({
                    allowClear: true,
                    placeholder: "Pilih Kategori"
                });

                // Single select
                $("#subcategory_id").select2({
                    allowClear: true,
                    placeholder: "Pilih Sub Kategori"
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


        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo set_value('liputan_title', isset($default['liputan_title']) ? ucwords($default['liputan_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('liputan_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Nama liputan</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="liputan_title" class="form-control" placeholder="Nama" value="<?php echo set_value('liputan_title', isset($default['liputan_title']) ? $default['liputan_title'] : ''); ?>">
                                    <input type="hidden" name="liputan_id" class="form-control" placeholder="id liputan" value="<?php echo set_value('liputan_id', isset($default['liputan_id']) ? $default['liputan_id'] : ''); ?>">
                                    <?php echo form_error('liputan_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>


                        

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('liputan_type') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Tipe Link *</strong></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="liputan_type" id="inlineCheckbox1" value="in" class="px" <?php echo set_radio('liputan_type', 'in', isset($default['liputan_type']) && $default['liputan_type'] == 'in' ? TRUE : FALSE); ?>> <span class="lbl">Tautan Halaman</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="liputan_type" id="inlineCheckbox2" value="out" class="px" <?php echo set_radio('liputan_type', 'out', isset($default['liputan_type']) && $default['liputan_type'] == 'out' ? TRUE : FALSE); ?>> <span class="lbl">Tautan Keluar</span>
                                    </label>
                                    <?php echo form_error('liputan_type', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('liputan_link') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-5">
                                    <input type="url" name="liputan_link" class="form-control" placeholder="Link" value="<?php echo set_value('liputan_link', isset($default['liputan_link']) ? $default['liputan_link'] : ''); ?>">
                                    <?php echo form_error('liputan_link', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>



                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">
                             <div class="row">
                                <label class="col-sm-2 control-label">Picture</label>
                                <div class="col-sm-4">
                                    <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture" >
                                    <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['liputan_picture']) ? $default['liputan_picture'] : '') == '' ) : echo 'disabled'; endif; ?>"><!-- <span class="btn-label icon fa fa-camera-retro"></span> --> View Image</button>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo site_url('liputan')?>"><button class="btn btn-danger" type="button">Back</button></a>
                    </div>
                </form>

                <!-- Modal -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Data Gambar</h4>
                            </div>
                            <div class="modal-body">
                                <img width="100%" src="<?php echo base_url()?>uploads/liputan/<?php echo set_value('liputan_picture', isset($default['liputan_picture']) ? $default['liputan_picture'] : '3.jpg'); ?>">
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
    init.push(function () {
        // Javascript code here
    });
    window.PixelAdmin.start(init);
</script>