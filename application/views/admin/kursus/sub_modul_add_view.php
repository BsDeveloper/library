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

        $('.styled-finputs').pixelFileInput({ placeholder: 'Picture File Only', width:100 });
        
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
<?php $query_fitur = $this->model_utama->get_data('fitur'); ?>
<div class="ui-accordion">
<div class="group" id="target_item_sub_modul_<?php echo $sub->sub_modul_id; ?>">
	<h3><strong>Slide Number <?php echo $sub->sub_modul_order; ?> : <?php echo set_value('sub_modul_title', isset($sub->sub_modul_title) ? $sub->sub_modul_title : ''); ?></strong></h3>
	<div>
		<table class="table">
			<tr>
                <td>Nama</td>
                <td><a href="#" id="sub_modul_title_<?php echo $sub->sub_modul_title; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah nama sub modul"  data-url="<?php echo base_url()?>admin/kursus/update_field/sub_modul_title/<?php echo $sub->sub_modul_id; ?>/sub_modul_id/sub_modul"><?php echo set_value('sub_modul_title', isset($sub->sub_modul_title) ? $sub->sub_modul_title : ''); ?></a></td>
                <td></td>
            </tr>
            <tr>
                <td>Video ID</td>
                <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah deskripsi sub modul"  data-url="<?php echo base_url()?>admin/kursus/update_field/sub_modul_description/<?php echo $sub->sub_modul_id; ?>/sub_modul_id/sub_modul"><?php echo set_value('sub_modul_description', isset($sub->sub_modul_description) ? $sub->sub_modul_description : ''); ?></a></td>
                <td></td>
            </tr>                                                                    
            <tr>
                <td>Fitur</td>
                <td><a href="#" class="form_editable" data-type="select" data-source='[<?php if($query_fitur->num_rows() > 0) :  foreach($query_fitur->result() as $fg) : ?>{value: <?php echo $fg->fitur_id; ?>, text: "<?php echo $fg->fitur_title?>"}, <?php endforeach; endif; ?>]' data-pk="1" data-title="Ubah fitur"  data-url="<?php echo base_url()?>admin/kursus/update_field/fitur_id/<?php echo $sub->sub_modul_id; ?>/sub_modul_id/sub_modul"><?php echo set_value('fitur_id', isset($sub->fitur_id) ? $this->model_utama->get_detail($sub->fitur_id,'fitur_id','fitur')->row()->fitur_title : ''); ?></a></td>
                <td></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>
                    <a href="#" onclick="upload_picture('<?php echo $sub->sub_modul_id; ?>','sub_modul')" data-toggle="modal" data-target="#upload_modal" class="btn btn-success btn-labeled"><span class="btn-label icon fa fa-upload"></span> Upload</a>
                </td>
                <td>
                    <?php if($sub->sub_modul_picture != '') : ?>
                    <div id="picture_box_sub_modul_<?php echo $sub->sub_modul_id; ?>">
                        <a href="#" onclick="view_slide(<?php echo $sub->sub_modul_id; ?>)" data-toggle="modal" data-target="#my_slide" class="btn btn-warning btn-labeled"><span class="btn-label icon fa fa-picture-o"></span> View</a>&nbsp;&nbsp;
                        <button class="btn btn-labeled btn-danger" type="button" id="delete_picture_sub_modul_<?php echo $sub->sub_modul_id; ?>" onclick="delete_picture('<?php echo $sub->sub_modul_id?>','sub_modul_id','sub_modul')"><span class="btn-label icon fa fa-times"></span> Delete</button>
                        <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_picture_sub_modul_<?php echo $sub->sub_modul_id?>" style="display:none" /> 
                    </div>
                    <?php endif; ?>
                </td>
            </tr>
		</table>
        <hr>
        <button class="btn btn-labeled btn-success btn-xs" type="button" id="add_item_soal_<?php echo $sub->sub_modul_id; ?>" onclick="new_item('<?php echo $sub->sub_modul_id?>','sub_modul_id','soal')"><span class="btn-label icon fa fa-plus"></span> Add Quiz</button>
        <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_soal_<?php echo $sub->sub_modul_id?>" style="display:none" /> 
        <br><br>
        
        <div class="ui-quiz" id="respond_item_soal_<?php echo $sub->sub_modul_id; ?>">
        
        </div>
        <br>
	    <p class="text-right">
	        <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_sub_modul_<?php echo $sub->sub_modul_id; ?>" onclick="delete_item('<?php echo $sub->sub_modul_id?>','sub_modul_id','sub_modul')"><span class="btn-label icon fa fa-times"></span> Delete Sub Modul</button>
	        <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_sub_modul_<?php echo $sub->sub_modul_id?>" style="display:none" /> 
	    </p>
	</div>
</div> <!-- / .group -->

</div>