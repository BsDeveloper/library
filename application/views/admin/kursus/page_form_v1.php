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

        <!-- Javascript -->
        <script>
            var baseurl = '<?php echo base_url()?>';

            function new_item(kode,field,table)
            {
                $("#add_item_modul").hide(); //hide submit button
                $("#loading_image_modul").show(); //show loading image
                console.log('masuk ke fungsinya bro');

                jQuery.ajax({
                    url: baseurl+"admin/level/add_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
                    success:function(response){
                        $("#respond_item_"+kode+"_"+table).append(response);
                        // $("#respond_item"+kode).html(response);
                        $("#add_item_modul").show(); //show submit button
                        $("#loading_image_modul").hide(); //hide loading image
                        // alert(thrownError);
                        console.log('masuk ke ajax sukses');
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        console.log(thrownError);
                        $("#add_item_modul").show(); //show submit button
                        $("#loading_image_modul").hide(); //hide loading image
                        // alert(thrownError);
                    }
                });

            }

            function delete_item(kode,field,table)
            {
                
                jQuery.ajax({
                    url: baseurl+"admin/level/delete_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
                    success:function(response){
                        $("#target_item_"+kode+"_"+table).fadeOut();
                        $("#target_item_"+kode+"_"+table).hide();
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        console.log(thrownError);
                    }
                });

            }
            

            init.push(function () {
                $( ".ui-accordion" ).accordion({
                    heightStyle: "content",
                    header: "> div > h3"
                }).sortable({
                    axis: "y",
                    handle: "h3",
                    stop: function( event, ui ) {
                        // IE doesn't register the blur when sorting
                        // so trigger focusout handlers to remove .ui-state-focus
                        ui.item.children( "h3" ).triggerHandler( "focusout" );
                    }
                });
                

                $('.form_editable').editable();

                $('#styled-finputs-example').pixelFileInput({ placeholder: 'Picture File Only' });

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

    <form action="<?php echo base_url()?>admin/level/deskripsi" method="post" enctype="multipart/form-data" class="">

    <div class="mail-container">
        <div class="mail-container-header">
            Inbox

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
                        <a id="add_item_modul" class="btn btn-labeled btn-success" href="#" onclick="new_item('<?php echo $this->uri->segment('4')?>','level_id','modul')"><span class="btn-label icon fa fa-plus"></span> Add Modul</a>
                        <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_modul" style="display:none" /> 
                        <?php $query_modul = $this->model_utama->cek_order($default['level_id'],'level_id','modul_order','asc','modul'); ?>
                        <div class="form-horizontal row" id="respond_item_<?php echo $this->uri->segment('4')?>_modul">
                        <?php if($query_modul->num_rows() > 0) : ?>
                            
                                    <?php foreach($query_modul->result() as $row) : ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                                <h3><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah nama modul"  data-url="<?php echo base_url()?>admin/level/update_field/modul_title/<?php echo $row->modul_id; ?>/modul_id/modul"><?php echo set_value('modul_title', isset($row->modul_title) ? $row->modul_title : ''); ?></a></h3>
                                            </div>
                                            <div class="col-md-8">

                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <span class="panel-title">Sortable accordions</span>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="ui-accordion">
                                                            <div class="group">
                                                                <h3>Section 1</h3>
                                                                <div>
                                                                    <p>
                                                                        Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                                                                    </p>
                                                                </div>
                                                            </div> <!-- / .group -->
                                                            <div class="group">
                                                                <h3>Section 2</h3>
                                                                <div>
                                                                    <p>
                                                                        Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.
                                                                    </p>
                                                                </div>
                                                            </div> <!-- / .group -->
                                                            <div class="group">
                                                                <h3>Section 3</h3>
                                                                <div>
                                                                    <p>
                                                                        Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                                                                    </p>
                                                                    <ul>
                                                                      <li>List item one</li>
                                                                      <li>List item two</li>
                                                                      <li>List item three</li>
                                                                    </ul>
                                                                </div>
                                                            </div> <!-- / .group -->
                                                            <div class="group">
                                                                <h3>Section 4</h3>
                                                                <div>
                                                                    <p>
                                                                        Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia mauris vel est.
                                                                    </p>
                                                                    <p>
                                                                        Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                                                                    </p>
                                                                </div>
                                                            </div> <!-- / .group -->
                                                        </div> <!-- / #ui-accordion -->
                                                    </div>
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
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="<?php echo base_url()?>admin/level"><button class="btn btn-danger" type="button">Back</button></a>
        </div>



    </div>

    </form>


                

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


<script language="javascript" type="text/javascript">
    function a1_onclick(id) {
        document.getElementById(id).style.backgroundColor = "#F00";   
    }
</script>