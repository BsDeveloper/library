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
        $( ".ui-jawaban" ).accordion({
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
                    url: baseurl+"admin/level/sorting/soal_option_order/soal_option_id/soal_option"
                });

            } 
        });

        $(".form_editable").editable();

        $('.styled-finputs').pixelFileInput({ placeholder: 'Picture File Only', width:100 });
        
    });
</script>

<div class="ui-jawaban">
    <div class="group" id="target_item_soal_option_<?php echo $so->soal_option_id; ?>">
        <h3>Answer  </h3>
        <div>
            <table class="table">
                <tr>
                    <td>Answer Text</td>
                    <td><a href="#" id="soal_option_title_<?php echo $so->soal_option_title; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah text jawaban"  data-url="<?php echo base_url()?>admin/kursus/update_field/soal_option_title/<?php echo $so->soal_option_id; ?>/soal_option_id/soal_option"><?php echo set_value('soal_option_title', isset($so->soal_option_title) ? $so->soal_option_title : ''); ?></a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Description Text</td>
                    <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah text jawaban"  data-url="<?php echo base_url()?>admin/kursus/update_field/soal_option_description/<?php echo $so->soal_option_id; ?>/soal_option_id/soal_option"><?php echo set_value('soal_option_description', isset($so->soal_option_description) ? $so->soal_option_description : ''); ?></a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Additional Info</td>
                    <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah text jawaban"  data-url="<?php echo base_url()?>admin/kursus/update_field/option_additional_info/<?php echo $so->soal_option_id; ?>/soal_option_id/soal_option"><?php echo set_value('option_additional_info', isset($so->option_additional_info) ? $so->option_additional_info : ''); ?></a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Answer Picture <i>(optional)</i></td>
                    <td><a href="#" onclick="upload_picture('<?php echo $so->soal_option_id; ?>','soal_option')" data-toggle="modal" data-target="#upload_modal" class="btn btn-success btn-labeled"><span class="btn-label icon fa fa-upload"></span> Upload</a></td>
                    <td>
                        <?php if($so->soal_option_picture != '') : ?>
                        <div id="picture_box_soal_option_<?php echo $so->soal_option_id; ?>">
                            <a href="<?php echo base_url()?>uploads/soal_option/<?php echo $so->soal_option_picture?>" target="_blank" class="btn btn-warning"><span class="btn-label icon fa fa-picture-o"></span> View</a>&nbsp;&nbsp;
                            <button class="btn btn-labeled btn-danger" type="button" id="delete_picture_soal_option_<?php echo $so->soal_option_id; ?>" onclick="delete_picture('<?php echo $so->soal_option_id?>','soal_option_id','soal_option')"><span class="btn-label icon fa fa-times"></span> Delete</button>
                            <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_picture_soal_option_<?php echo $so->soal_option_id?>" style="display:none" /> 
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <br>
            <p class="text-right">
                <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_soal_option_<?php echo $so->soal_option_id; ?>" onclick="delete_item('<?php echo $so->soal_option_id?>','soal_option_id','soal_option')"><span class="btn-label icon fa fa-times"></span> Delete Answer</button>
                <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_soal_option_<?php echo $so->soal_option_id?>" style="display:none" /> 
            </p>
        </div>
    </div>
</div>