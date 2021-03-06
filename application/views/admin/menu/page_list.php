<div id="content-wrapper">

        <div class="page-header">
            <h1><?php echo strtoupper($heading)?></h1>
        </div> <!-- / .page-header -->

        <div class="row">
            <div class="col-sm-12">

                <!-- Javascript -->
                <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.min.css" />
                <link rel="stylesheet" href="<?php echo base_url()?>assets/codemirror/3.20.0/theme/blackboard.min.css">
                <link rel="stylesheet" href="<?php echo base_url()?>assets/codemirror/3.20.0/theme/monokai.min.css">
                <script type="text/javascript" src="<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.js"></script>
                <script src="<?php echo base_url()?>assets/codemirror/3.20.0/mode/xml/xml.min.js"></script>
                <script src="<?php echo base_url()?>assets/codemirror/2.36.0/formatting.min.js"></script>
                <!-- <script type="text/javascript" src="<?php echo base_url()?>assets/jquery.ajax.upload.js"></script>-->
                <!-- <script src="<?php echo base_url()?>assets/ajaxfileupload.js"></script>-->
                <script src="<?php echo base_url()?>assets/afu.js"></script>

                <script>
                    var baseurl = '<?php echo base_url()?>index.php/';            

                    function new_item(kode,field,table)
                    {
                        $("#add_item_"+table+"_"+kode).hide(); //hide submit button
                        $("#loading_image_"+table+"_"+kode).show(); //show loading image
                        console.log('masuk ke fungsinya bro');

                        jQuery.ajax({
                            url: baseurl+"admin/menu/add_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
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
                        if (confirm("Anda yakin menghapus data ini ? \nData yang sudah dihapus, tidak bisa dikembalikan") == true) {
                            $("#delete_item_"+table+"_"+kode).hide(); //hide submit button
                            $("#loading_image_del_"+table+"_"+kode).show(); //show loading image
                            console.log('masuk ke fungsi delete');
                            
                            jQuery.ajax({
                                url: baseurl+"admin/menu/delete_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
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

                    init.push(function () {
                        $('.form_editable').editable();

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
                                    url: baseurl+"admin/menu/sorting/menu_order/menu_id/menu"
                                });

                            } 
                        });


                        $( ".ui-menu_lv1" ).accordion({
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
                                    url: baseurl+"admin/menu/sorting/menu_lv1_order/menu_lv1_id/menu_lv1"
                                });

                            } 
                        });

    
                        $( ".ui-menu_lv2" ).accordion({
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
                                    url: baseurl+"admin/menu/sorting/menu_lv2_order/menu_lv2_id/menu_lv2"
                                });

                            } 
                        });
                        
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

                        <a id="add_item_menu_0" class="btn btn-labeled btn-success btn-xs" href="javascript:;" onclick="new_item('0','0','menu')"><span class="btn-label icon fa fa-plus"></span> Add Menu</a>
                        <img src="https://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_menu_0" style="display:none" /> 
                        <br><br>

                        <div class="ui-accordion" id="respond_item_menu_0">
                        <?php if($menu_list->num_rows() > 0) : $i=1; ?>
                            <?php foreach($menu_list->result() as $menu) : ?>
                                <div class="group" id="target_item_menu_<?php echo $menu->menu_id; ?>">
                                    <h3><strong>Menu <?php echo $i++; ?> : <?php echo set_value('menu_id', isset($menu->menu_id) ? $menu->menu_title : ''); ?></strong></h3>
                                    <div>
                                        <table class="table">
                                            <tr>
                                                <td width="20%">Nama Menu</td>
                                                <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_title/'.$menu->menu_id.'/menu_id/menu');?>"><?php echo set_value('menu_title', isset($menu->menu_title) ? $menu->menu_title : ''); ?></a></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Link Menu</td>
                                                <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_link/'.$menu->menu_id.'/menu_id/menu')?>"><?php echo set_value('menu_link', isset($menu->menu_link) ? $menu->menu_link : ''); ?></a></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Buka tab baru ?</td>
                                                <td><a href="#" class="form_editable" data-type="select" data-source='[{value: "in", text: "Tidak"},{value: "out", text: "Ya"}, ]' data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_type/'.$menu->menu_id.'/menu_id/menu')?>"><?php echo set_value('menu_type', isset($menu->menu_type) && $menu->menu_type == 'out' ? 'Ya' : 'Tidak'); ?></a></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <button class="btn btn-labeled btn-success btn-xs" type="button" id="add_item_menu_lv1_<?php echo $menu->menu_id; ?>" onclick="new_item('<?php echo $menu->menu_id?>','menu_id','menu_lv1')"><span class="btn-label icon fa fa-plus"></span> Add Sub Menu Level 1</button>
                                        <img src="https://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_menu_lv1_<?php echo $menu->menu_id?>" style="display:none" /> 
                                        <br><br>
                                        <!-- untuk isi lainnya -->
                                        <div class="ui-menu_lv1" id="respond_item_menu_lv1_<?php echo $menu->menu_id; ?>">
                                        <?php $menu_lv1_list = $this->model_utama->cek_order($menu->menu_id,'menu_id','menu_lv1_order','asc','menu_lv1');?>
                                        <?php if($menu_lv1_list->num_rows() > 0) : $i_menu_lv1=1; ?>
                                            <?php foreach($menu_lv1_list->result() as $menu_lv1) : ?>
                                                <div class="group" id="target_item_menu_lv1_<?php echo $menu_lv1->menu_lv1_id; ?>">
                                                    <h3><strong>Sub Menu_1 <?php echo $i_menu_lv1++; ?> : <?php echo set_value('menu_lv1_id', isset($menu_lv1->menu_lv1_id) ? $menu_lv1->menu_lv1_title : ''); ?></strong></h3>
                                                    <div>
                                                        <table class="table">
                                                            <tr>
                                                                <td width="20%">Nama Menu</td>
                                                                <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv1_title/'.$menu_lv1->menu_lv1_id.'/menu_lv1_id/menu_lv1')?>"><?php echo set_value('menu_lv1_title', isset($menu_lv1->menu_lv1_title) ? $menu_lv1->menu_lv1_title : ''); ?></a></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Link menu_lv1</td>
                                                                <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv1_link/'.$menu_lv1->menu_lv1_id.'/menu_lv1_id/menu_lv1'); ?>"><?php echo set_value('menu_lv1_link', isset($menu_lv1->menu_lv1_link) ? $menu_lv1->menu_lv1_link : ''); ?></a></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Buka tab baru ?</td>
                                                                <td><a href="#" class="form_editable" data-type="select" data-source='[{value: "in", text: "Tidak"},{value: "out", text: "Ya"}, ]' data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv1_type/'.$menu_lv1->menu_lv1_id.'/menu_lv1_id/menu_lv1')?>"><?php echo set_value('menu_lv1_type', isset($menu_lv1->menu_lv1_type) && $menu_lv1->menu_lv1_type == 'out' ? 'Ya' : 'Tidak'); ?></a></td>
                                                                <td></td>
                                                            </tr>
                                                        </table>
                                                        <hr>
                                                        <button class="btn btn-labeled btn-success btn-xs" type="button" id="add_item_menu_lv2_<?php echo $menu_lv1->menu_lv1_id; ?>" onclick="new_item('<?php echo $menu_lv1->menu_lv1_id?>','menu_lv1_id','menu_lv2')"><span class="btn-label icon fa fa-plus"></span> Add Sub Menu Level 2</button>
                                                        <img src="https://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_menu_lv2_<?php echo $menu_lv1->menu_lv1_id?>" style="display:none" /> 
                                                        <br><br>
                                                        <!-- untuk level 2 -->
                                                        <div class="ui-menu_lv2" id="respond_item_menu_lv2_<?php echo $menu_lv1->menu_lv1_id; ?>">
                                                        <?php $menu_lv2_list = $this->model_utama->cek_order($menu_lv1->menu_lv1_id,'menu_lv1_id','menu_lv2_order','asc','menu_lv2');?>
                                                        <?php if($menu_lv2_list->num_rows() > 0) : $i_menu_lv2=1; ?>
                                                            <?php foreach($menu_lv2_list->result() as $menu_lv2) : ?>
                                                                <div class="group" id="target_item_menu_lv2_<?php echo $menu_lv2->menu_lv2_id; ?>">
                                                                    <h3><strong>Sub Menu_2 <?php echo $i_menu_lv2++; ?> : <?php echo set_value('menu_lv2_id', isset($menu_lv2->menu_lv2_id) ? $menu_lv2->menu_lv2_title : ''); ?></strong></h3>
                                                                    <div>
                                                                        <table class="table">
                                                                            <tr>
                                                                                <td width="20%">Nama Menu</td>
                                                                                <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv2_title/'.$menu_lv2->menu_lv2_id.'/menu_lv2_id/menu_lv2'); ?>"><?php echo set_value('menu_lv2_title', isset($menu_lv2->menu_lv2_title) ? $menu_lv2->menu_lv2_title : ''); ?></a></td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Link menu_lv2</td>
                                                                                <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv2_link/'.$menu_lv2->menu_lv2_id.'/menu_lv2_id/menu_lv2'); ?>"><?php echo set_value('menu_lv2_link', isset($menu_lv2->menu_lv2_link) ? $menu_lv2->menu_lv2_link : ''); ?></a></td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Buka tab baru ?</td>
                                                                                <td><a href="#" class="form_editable" data-type="select" data-source='[{value: "in", text: "Tidak"},{value: "out", text: "Ya"}, ]' data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv2_type/'.$menu_lv2->menu_lv2_id.'/menu_lv2_id/menu_lv2'); ?>"><?php echo set_value('menu_lv2_type', isset($menu_lv2->menu_lv2_type) && $menu_lv2->menu_lv2_type == 'out' ? 'Ya' : 'Tidak'); ?></a></td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </table>
                                                                        <p class="text-right">
                                                                            <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_menu_lv2_<?php echo $menu_lv2->menu_lv2_id; ?>" onclick="delete_item('<?php echo $menu_lv2->menu_lv2_id?>','menu_lv2_id','menu_lv2')"><span class="btn-label icon fa fa-times"></span> Delete menu_lv2</button>
                                                                            <img src="https://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_menu_lv2_<?php echo $menu_lv2->menu_lv2_id?>" style="display:none" /> 
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif;?>
                                                        </div>
                                                        <br>
                                                        <p class="text-right">
                                                            <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_menu_lv1_<?php echo $menu_lv1->menu_lv1_id; ?>" onclick="delete_item('<?php echo $menu_lv1->menu_lv1_id?>','menu_lv1_id','menu_lv1')"><span class="btn-label icon fa fa-times"></span> Delete menu_lv1</button>
                                                            <img src="https://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_menu_lv1_<?php echo $menu_lv1->menu_lv1_id?>" style="display:none" /> 
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif;?>
                                        </div>

                                        <br>
                                        <p class="text-right">
                                            <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_menu_<?php echo $menu->menu_id; ?>" onclick="delete_item('<?php echo $menu->menu_id?>','menu_id','menu')"><span class="btn-label icon fa fa-times"></span> Delete Menu</button>
                                            <img src="https://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_menu_<?php echo $menu->menu_id?>" style="display:none" /> 
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif;?>
                        </div>
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