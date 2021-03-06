<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/subcategory')?>"><?php echo ucwords('subcategory') ?></a> / </span><?php echo ucwords($heading)?></h1>
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
                 // Single select
                $("#jquery-select2-example").select2({
                    allowClear: true,
                    placeholder: "Pilih Kategori"
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
                        <span class="panel-title"><?php echo set_value('subcategory_title', isset($default['subcategory_title']) ? ucwords($default['subcategory_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('subcategory_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Nama Sub Kategori</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="subcategory_title" class="form-control" placeholder="Nama" value="<?php echo set_value('subcategory_title', isset($default['subcategory_title']) ? $default['subcategory_title'] : ''); ?>">
                                    <input type="hidden" name="subcategory_id" class="form-control" placeholder="id subcategory" value="<?php echo set_value('subcategory_id', isset($default['subcategory_id']) ? $default['subcategory_id'] : ''); ?>">
                                    <?php echo form_error('subcategory_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('category_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Kategori</strong></label>
                                <div class="col-sm-4">
                                    <select id="jquery-select2-example" name="category_id" class="form-control" required>
                                        <option value="">-- Pilih satu --</option>
                                        <?php if($category_list->num_rows() > 0) : ?>
                                            <?php foreach($category_list->result() as $cat) : ?>
                                            <option value="<?php echo $cat->category_id?>" <?php echo set_select('category_id', $cat->category_id, isset($default['category_id']) && $default['category_id'] == $cat->category_id ? TRUE : FALSE); ?>><?php echo $cat->category_title?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <?php echo form_error('category_id', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <!--<a href="<?php echo base_url()?>subcategory"><button class="btn btn-danger" type="button">Back</button></a>-->
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
                                <img width="100%" src="<?php echo base_url()?>uploads/subcategory/<?php echo set_value('subcategory_picture', isset($default['subcategory_picture']) ? $default['subcategory_picture'] : '3.jpg'); ?>">
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