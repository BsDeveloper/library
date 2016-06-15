<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/produk_organisasi')?>"><?php echo ucwords('produk organisasi') ?></a> / </span><?php echo ucwords($heading)?></h1>
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
                $('#styled-finputs-example').pixelFileInput({ placeholder: 'Isi data file' });

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

                $("#produk_organisasi_tahun").select2({
                    allowClear: true,
                    placeholder: "Pilih Tahun"
                });

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
                        <span class="panel-title"><?php echo set_value('produk_organisasi_title', isset($default['produk_organisasi_title']) ? ucwords($default['produk_organisasi_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('subcategory_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Jenis Produk organisasi</strong></label>
                                <div class="col-sm-4">
                                    <select name="subcategory_id" id="subcategory_id" class="form-control" >
                                        <option value="">Choose One</option>
                                        <?php if($subcategory_list->num_rows() > 0) : ?>
                                            <?php foreach($subcategory_list->result() as $cat) : ?>
                                            <option value="<?php echo $cat->subcategory_id?>" <?php echo set_select('subcategory_id', $cat->subcategory_id, isset($default['subcategory_id']) && $default['subcategory_id'] == $cat->subcategory_id ? TRUE : FALSE); ?>><?php echo $cat->subcategory_title?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <?php echo form_error('subcategory_id', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('produk_organisasi_nomor') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Nomor</label>
                                <div class="col-sm-5">
                                    <input type="text" name="produk_organisasi_nomor" class="form-control" placeholder="Nomor Produk organisasi" value="<?php echo set_value('produk_organisasi_nomor', isset($default['produk_organisasi_nomor']) ? $default['produk_organisasi_nomor'] : ''); ?>">
                                    <?php echo form_error('produk_organisasi_nomor', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('produk_organisasi_tahun') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Tahun</strong></label>
                                <div class="col-sm-4">
                                    <select name="produk_organisasi_tahun" id="produk_organisasi_tahun" class="form-control" >
                                        <option value="">Pilih Tahun</option>
                                        <?php for($i=date('Y');$i>=1945;$i--) : ?>
                                        <option value="<?php echo $i; ?>" <?php echo set_select('produk_organisasi_tahun', $i, isset($default['produk_organisasi_tahun']) && $default['produk_organisasi_tahun'] == $i ? TRUE : FALSE); ?>><?php echo $i; ?></option>
                                        <?php endfor;?>
                                    </select>
                                    <?php echo form_error('produk_organisasi_tahun', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('produk_organisasi_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Judul atau Tentang</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="produk_organisasi_title" class="form-control" placeholder="Isi data judul atau tentang" value="<?php echo set_value('produk_organisasi_title', isset($default['produk_organisasi_title']) ? $default['produk_organisasi_title'] : ''); ?>">
                                    <input type="hidden" name="produk_organisasi_id" class="form-control" placeholder="id produk_organisasi" value="<?php echo set_value('produk_organisasi_id', isset($default['produk_organisasi_id']) ? $default['produk_organisasi_id'] : ''); ?>">
                                    <input type="hidden" name="category_id" class="form-control" placeholder="id produk_organisasi" value="<?php echo set_value('category_id', isset($default['category_id']) ? $default['category_id'] : ''); ?>">
                                    
                                    <?php echo form_error('produk_organisasi_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>





                        <!-- <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('category_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Kategori</strong></label>
                                <div class="col-sm-4">
                                    <select name="category_id" id="category_id" class="form-control" >
                                        <option value="">Choose One</option>
                                        <?php if($category_list->num_rows() > 0) : ?>
                                            <?php foreach($category_list->result() as $cat) : ?>
                                            <option value="<?php echo $cat->category_id?>" <?php echo set_select('category_id', $cat->category_id, isset($default['category_id']) && $default['category_id'] == $cat->category_id ? TRUE : FALSE); ?>><?php echo $cat->category_title?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <?php echo form_error('category_id', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div> -->
                        

                        <!-- <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('produk_organisasi_date') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-3">
                                    <div class="input-group date" id="bs-datepicker-component">
                                        <input  type="text" name="produk_organisasi_date" class="form-control" placeholder="tanggal" value="<?php echo set_value('produk_organisasi_date', isset($default['produk_organisasi_date']) ? $default['produk_organisasi_date'] : ''); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <?php echo form_error('produk_organisasi_date', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div> -->


                        <!-- <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('produk_organisasi_type') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Tipe Link *</strong></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="produk_organisasi_type" id="inlineCheckbox1" value="in" class="px" <?php echo set_radio('produk_organisasi_type', 'in', isset($default['produk_organisasi_type']) && $default['produk_organisasi_type'] == 'in' ? TRUE : FALSE); ?>> <span class="lbl">Tautan Halaman</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="produk_organisasi_type" id="inlineCheckbox2" value="out" class="px" <?php echo set_radio('produk_organisasi_type', 'out', isset($default['produk_organisasi_type']) && $default['produk_organisasi_type'] == 'out' ? TRUE : FALSE); ?>> <span class="lbl">Tautan Keluar</span>
                                    </label>
                                    <?php echo form_error('produk_organisasi_type', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div> -->

                       



                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">
                             <div class="row">
                                <label class="col-sm-2 control-label">File</label>
                                <div class="col-sm-4">
                                    <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture" >
                                    <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <?php if(isset($default['produk_organisasi_file']) && $default['produk_organisasi_file'] != '') : ?>
                                <div class="col-sm-3">
                                    <a target="_blank" href="<?php echo base_url() ?>uploads/produk_organisasi/<?php echo isset($default['produk_organisasi_file']) ? $default['produk_organisasi_file'] : '' ?>">
                                        <button class="btn btn-labeled btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" type="button" data-original-title="Klik untuk download"><span class="btn-label icon fa fa-download"></span> Download</button>
                                    </a>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('produk_organisasi_description') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Harmonisasi</label>
                                <div class="col-sm-6">
                                    <input type="text" name="produk_organisasi_description" class="form-control" placeholder="Isi data harmonisasi" value="<?php echo set_value('produk_organisasi_description', isset($default['produk_organisasi_description']) ? $default['produk_organisasi_description'] : ''); ?>">
                                    <?php echo form_error('produk_organisasi_description', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('produk_organisasi_description') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="summernote-example" name="produk_organisasi_description" rows="10"><?php echo set_value('produk_organisasi_description', isset($default['produk_organisasi_description']) ? $default['produk_organisasi_description'] : ''); ?></textarea>
                                    <?php echo form_error('produk_organisasi_description', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="panel-footer text-right">
                        <a href="<?php echo base_url()?>admin/produk_organisasi">
                            <button class="btn btn-labeled btn-white" data-toggle="tooltip" data-placement="bottom" type="button" data-original-title="Klik untuk kembali"><span class="btn-label icon fa fa-level-up"></span> Back</button>
                        </a>
                        <button class="btn btn-labeled btn-success" data-toggle="tooltip" data-placement="bottom" type="submit" data-original-title="Klik untuk menyimpan data"><span class="btn-label icon fa fa-save"></span> Save</button>
                        
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
                                <img width="100%" src="<?php echo base_url()?>uploads/produk_organisasi/<?php echo set_value('produk_organisasi_picture', isset($default['produk_organisasi_picture']) ? $default['produk_organisasi_picture'] : '3.jpg'); ?>">
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