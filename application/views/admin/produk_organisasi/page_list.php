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

                        $('#jq-datatables-example').dataTable();
                        $('#jq-datatables-example_wrapper .table-caption').text('<?php echo ucwords($heading); ?>');
                        $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
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

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo ucwords($heading)?></span>
                    </div>
                    <div class="panel-body">
                        

                        <a href="<?php echo site_url('admin/produk_organisasi/add') ?>"><button class="btn btn-labeled btn-success"><span class="btn-label icon fa fa-plus"></span> Add</button></a>
                        <br><br>
                        <?php if($produk_organisasi_list->num_rows() > 0) : $i=1;?>
                        <div class="table-primary" id="tooltips-demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Jenis</th>
                                        <th>Nomor</th>
                                        <th>Judul / Tentang</th>
                                        <!-- <th>PDF</th> -->
                                        <th>Ubah</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($produk_organisasi_list->result() as $row) :?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i++?></td>
                                        <td>
                                            <h5><?php echo isset($row->subcategory_id) && $row->subcategory_id != '' ? ucwords($this->model_utama->get_detail($row->subcategory_id,'subcategory_id','subcategory')->row()->subcategory_title) : '-'; ?></h5>
                                        </td>
                                        <td>
                                            <h5><?php echo ucwords($row->produk_organisasi_nomor)?></h5>
                                        </td>
                                        <td>
                                            <h5><?php echo ucwords($row->produk_organisasi_title)?></h5>
                                        </td>
                                        <!-- <td class="center">
                                            <a href="<?php echo base_url() ?>uploads/produk_organisasi/<?php echo $row->produk_organisasi_file; ?>">
                                                <button class="btn btn-labeled btn-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk download"><span class="btn-label icon fa fa-download"></span> Download</button>
                                            </a>
                                        </td> -->
                                        <td class="center" >
                                            <a href="<?php echo site_url('admin/produk_organisasi/update/'.$row->produk_organisasi_id) ?>">
                                                <button class="btn btn-xs btn-labeled btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk ubah data"><span class="btn-label icon fa fa-pencil"></span> Ubah</button>
                                            </a>
                                        </td>
                                        <td class="center" >
                                            
                                            <a href="<?php echo site_url('admin/produk_organisasi/delete/'.$row->produk_organisasi_id) ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" >
                                                <button class="btn btn-xs btn-labeled btn-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data"><span class="btn-label icon fa fa-times"></span> Hapus</button>
                                            </a>
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