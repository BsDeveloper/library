<script src="http://vitalets.github.io/x-editable/assets/mockjax/jquery.mockjax.js"></script>
            
<!-- momentjs --> 
<script src="http://vitalets.github.io/x-editable/assets/momentjs/moment.min.js"></script> 

<!-- select2 --> 
<script src="http://vitalets.github.io/x-editable/assets/select2/select2.js"></script>         

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 

 
<!-- bootstrap 3 -->
<script src="http://vitalets.github.io/x-editable/assets/bootstrap300/js/bootstrap.js"></script>

<!-- bootstrap-datetimepicker -->
<script src="http://vitalets.github.io/x-editable/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>        

<!-- x-editable (bootstrap 3) -->
<script src="http://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>

<!-- select2 bootstrap -->

<!-- typeaheadjs -->
<script src="http://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js"></script>         
<script src="http://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js"></script>         



<!-- address input -->
<script src="http://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/address/address.js"></script> 

<script type="text/javascript">
    $(function(){
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

    	$(".form_editable").editable();
    	
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
    });
</script>

<div class="row" id="target_item_modul_<?php echo $row->modul_id?>">
    <div class="col-md-11">

        <div class="panel">
            <div class="panel-heading">
                <div class="panel-heading">
                    <span class="panel-title"><h2><a href="#" class="form_editable" data-type="text" data-pk="1"  data-title="Ubah nama modul"  data-url="<?php echo base_url()?>admin/kursus/update_field/modul_title/<?php echo $row->modul_id; ?>/modul_id/modul"><?php echo set_value('modul_title', isset($row->modul_title) ? $row->modul_title : ''); ?></a></h2></span>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Deskripsi</td>
                            <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah deskripsi"  data-url="<?php echo base_url()?>admin/kursus/update_field/modul_description/<?php echo $row->modul_id; ?>/modul_id/modul"><?php echo set_value('modul_description', isset($row->modul_description) ? $row->modul_description : ''); ?></a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Summary</td>
                            <td><a href="#" onclick="upload_file(<?php echo $row->modul_id; ?>)" data-toggle="modal" data-target="#upload_modal" class="btn btn-success"><span class="btn-label icon fa fa-upload"></span> Upload</a></td>
                            <td>
                                <?php if($row->modul_picture != '') : ?>
                                <div id="picture_box_modul_<?php echo $row->modul_id; ?>">
                                    <a href="<?php echo base_url()?>uploads/modul/<?php echo $row->modul_picture?>" target="_blank" class="btn btn-warning btn-labeled"><span class="btn-label icon fa fa-file"></span> View</a>&nbsp;&nbsp;
                                    <button class="btn btn-labeled btn-danger" type="button" id="delete_picture_modul_<?php echo $row->modul_id; ?>" onclick="delete_picture('<?php echo $row->modul_id?>','modul_id','modul')"><span class="btn-label icon fa fa-times"></span> Delete</button>
                                    <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_picture_modul_<?php echo $row->modul_id?>" style="display:none" /> 
                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>

                    <a id="add_item_sub_modul_<?php echo $row->modul_id?>" class="btn btn-labeled btn-success btn-xs" href="javascript:;" onclick="new_item('<?php echo $row->modul_id; ?>','modul_id','sub_modul')"><span class="btn-label icon fa fa-plus"></span> Add Sub Modul</a>
                    <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_sub_modul_<?php echo $row->modul_id?>" style="display:none" /> 
                    <br><br>
                    <div id="respond_item_sub_modul_<?php echo $row->modul_id?>">
                    
                    </div>
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
