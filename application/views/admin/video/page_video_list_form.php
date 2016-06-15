<div id="content-wrapper">



        <div class="page-header">

            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/video')?>"><?php echo ucwords('video') ?></a> / </span><?php echo ucwords($heading)?></h1>

        </div> <!-- / .page-header -->



        <div class="row">

            <div class="col-sm-12">

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



                $('#loading-example-btn').click(function () {

                    var btn = $(this);

                    btn.button('loading');

                    setTimeout(function () {

                        btn.button('reset');

                    }, 1500);

                });



                $("#character-limit-input").limiter(255, { label: '#character-limit-input-label' });

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

                        <span class="panel-title"><?php echo set_value('video_list_title', isset($default['video_list_title']) ? ucwords($default['video_list_title']) : ucwords($heading)); ?></span>

                    </div>

                    <div class="panel-body no-padding-hr">

                        <?php if(set_value('video_list_link', isset($default['video_list_link']) ? $default['video_list_link'] : '') != '') : ?>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('video_list_title') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label"></label>

                                <div class="col-md-8">

                                <?php 

                                    $url = $default['video_list_link'];

                                    preg_match(

                                            '/[\\?\\&]v=([^\\?\\&]+)/',

                                            $url,

                                            $matches

                                        );

                                    $id = $matches[1];



                                    echo '<object width="100%" height="360"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="100%" height="360"></embed></object>';

                                ?>

                                    

                                </div>

                            </div>

                        </div>

                        <?php endif; ?>

                        



                       

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('video_list_link') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Link</label>

                                <div class="col-sm-5">

                                    <input type="url" name="video_list_link" class="form-control" placeholder="Link" value="<?php echo set_value('video_list_link', isset($default['video_list_link']) ? $default['video_list_link'] : ''); ?>">

                                    <?php echo form_error('video_list_link', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>



                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('video_list_title') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Caption</label>

                                <div class="col-sm-8">

                                    <textarea id="character-limit-input" required name="video_list_title" class="form-control" placeholder="Nama" ><?php echo set_value('video_list_title', isset($default['video_list_title']) ? $default['video_list_title'] : ''); ?></textarea>

                                    <div id="character-limit-input-label" class="limiter-label form-group-margin">Characters left: <span class="limiter-count"></span></div>

                                    <input type="hidden" name="video_id" class="form-control" placeholder="id galeri" value="<?php echo set_value('video_id', isset($default['video_id']) ? $default['video_id'] : ''); ?>">

                                    <input type="hidden" name="video_list_id" class="form-control" placeholder="id subvideo" value="<?php echo set_value('video_list_id', isset($default['video_list_id']) ? $default['video_list_id'] : ''); ?>">

                                    <?php echo form_error('video_list_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>



                        





                        

                    </div>

                    <div class="panel-footer text-right">

                        <button class="btn btn-primary" type="submit">Save</button>

                        <a href="<?php echo site_url('admin/video')?>"><button class="btn btn-danger" type="button">Back</button></a>

                    </div>

                </form>



                



            </div>

        </div>







        <div class="row">

            <div class="col-sm-12">



                <!-- Javascript -->

                <script>

                    init.push(function () {

                        $('#tooltips-demo button').tooltip();

                        $('#tooltips-demo a').tooltip();



                        $('#jq-datatables-example').dataTable();

                        $('#jq-datatables-example_wrapper .table-caption').text('Daftar Gambar');

                        $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');

                    });

                </script>

                <!-- / Javascript -->



                <div class="panel">

                    <div class="panel-heading">

                        <span class="panel-title"><?php echo ucwords($heading)?></span>

                    </div>

                    <div class="panel-body">



                        <!-- <a href="<?php echo base_url() ?>admin/video_list/add"><button class="btn btn-labeled btn-success"><span class="btn-label icon fa fa-plus"></span> Add</button></a> -->

                        <!-- <br><br> -->

                        <?php if($video_list_list->num_rows() > 0) : $i=1;?>

                        <div class="table-primary" id="tooltips-demo">

                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">

                                <thead>

                                    <tr>

                                        <th>No.</th>

                                        <th>Video</th>

                                        <th>Last Update</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                <?php foreach($video_list_list->result() as $row) :?>

                                    <tr class="odd gradeX">

                                        <td><?=$i++?></td>

                                        <td>

                                            <!-- <iframe src="<?php echo $row->video_list_link; ?>" frameborder="0" height="360" width="640"></iframe> -->

                                            <h4><?php echo ucwords($row->video_list_title)?><br>

                                                <small><?php echo $row->video_list_link?></small>

                                            </h4>



                                        </td>

                                        <td class="center">

                                            <h5><?php echo date('d F Y', strtotime($row->create_date))?><br>

                                            <small>Pukul <?php echo date('H:i:s', strtotime($row->create_date))?> WIB</small></h5>

                                        </td>

                                        <td class="center">

                                            <a href="<?php echo site_url('admin/video/update_list/'.$row->video_list_id) ?>"><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk ubah data" class="btn btn-sm  btn-warning"><span class="btn-label icon fa fa-pencil"></span></button></a>&nbsp;&nbsp;

                                            <a href="<?php echo site_url('admin/video/delete_list/'.$row->video_list_id) ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" ><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-sm  btn-danger"><span class="btn-label icon fa fa-minus-circle"></span></button></a>

                                        </td>

                                    </tr>

                                <?php endforeach;?>   

                                </tbody>

                            </table>

                        </div>

                        <?php else :?>



                            <div class="alert">

                            <button type="button" class="close" data-dismiss="alert">×</button>

                            <strong>Warning!</strong> Data tidak ada</div>



                        <?php endif;?>

                    </div>

                </div>

<!-- /11. $JQUERY_DATA_TABLES -->



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

    });

    window.PixelAdmin.start(init);

</script>