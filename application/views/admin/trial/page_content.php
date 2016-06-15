<div id="content-wrapper">

        <div class="page-header">
            <h1><?php echo strtoupper($heading)?></h1>
        </div> <!-- / .page-header -->

        <div class="row">
            <div class="col-sm-12">

                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $('#tooltips-demo button').tooltip();
                        $('#tooltips-demo a').tooltip();
                        $('#jq-datatables-example0').dataTable();
                        $('#jq-datatables-example0_wrapper .table-caption').text('Daftar Pendaftar Materi Trial');
                        $('#jq-datatables-example0_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
                    });
                </script>
                <!-- / Javascript -->

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo ucwords($heading)?></span>
                    </div>
                    <div class="panel-body">
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

                        <br><br>
                        <?php if($popup_trial_list->num_rows() > 0) : $i=1;?>
                        <div class="table-primary" id="tooltips-demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kontak</th>
                                        <th>Tempat Tinggal</th>
                                        <th>Materi</th>
                                        <th>Komentar</th>
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($popup_trial_list->result() as $row) :?>
                                  <?php if($row->nama != 'undefined') : ?>
                                    <tr class="odd gradeX">
                                        <td><?=$i++?></td>
                                        <td><?php echo $row->nama?><br>
                                            <?php echo $row->no_hp?><br>
                                            <?php echo $row->email?><br>
                                            <?php echo $row->pin_bb?>
                                        </td>
                                        <td><?php echo $row->tinggal?></td>
                                        <td><?php echo $row->materi?></td>
                                        <td><a href="#" class="form_editable" data-type="textarea" data-pk="1"  data-title="Ubah komentar"  data-url="<?php echo base_url()?>admin/kursus/update_field/komentar/<?php echo $row->popup_trial_id?>/popup_trial_id/popup_trial"><?php echo $row->komentar?></a></td>  
                                        <td>
                                            <h5><?php echo date('d F Y', strtotime($row->create_date))?><br>
                                            <small>Pukul <?php echo date('h:i:s', strtotime($row->create_date))?> WIB</small></h5>
                                        </td>                                      
                                    </tr>
                                  <?php endif; ?>
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
        $('.form_editable').editable();
    });
    window.PixelAdmin.start(init);
</script>