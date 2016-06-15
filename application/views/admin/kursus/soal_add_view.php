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
        $( ".ui-quiz" ).accordion({
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
                    url: baseurl+"admin/level/sorting/soal_order/soal_id/soal"
                });

            } 
        });

        $(".form_editable").editable();

        $('.styled-finputs').pixelFileInput({ placeholder: 'Picture File Only', width:100 });
        
    });
</script>

<?php $query_fitur = $this->model_utama->get_data('fitur'); ?>

<div class="ui-quiz">
    <div class="group" id="target_item_soal_<?php echo $qui->soal_id; ?>">
        <h3>Quiz  : <?php echo set_value('soal_pertanyaan', isset($qui->soal_pertanyaan) ? $qui->soal_pertanyaan : ''); ?></h3>
        <div>
            <table class="table">
                <!-- <tr>
                    <td>Quiz Title</td>
                    <td><a href="#" id="soal_pertanyaan_<?php echo $qui->soal_title; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah nama soal"  data-url="<?php echo base_url()?>admin/kursus/update_field/soal_title/<?php echo $qui->soal_id; ?>/soal_id/soal"><?php echo set_value('soal_title', isset($qui->soal_title) ? $qui->soal_title : ''); ?></a></td>
                    <td></td>
                </tr> -->
                <tr>
                    <td>Pertanyaan</td>
                    <td><a href="#" id="soal_pertanyaan_<?php echo $qui->soal_pertanyaan; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah nama soal"  data-url="<?php echo base_url()?>admin/kursus/update_field/soal_pertanyaan/<?php echo $qui->soal_id; ?>/soal_id/soal"><?php echo set_value('soal_pertanyaan', isset($qui->soal_pertanyaan) ? $qui->soal_pertanyaan : ''); ?></a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Waktu Kuis</td>
                    <td><a href="#" id="soal_pertanyaan_<?php echo $qui->soal_pertanyaan; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo base_url()?>admin/kursus/update_field/soal_minutes/<?php echo $qui->soal_id; ?>/soal_id/soal"><?php echo set_value('soal_minutes', isset($qui->soal_minutes) ? $qui->soal_minutes : ''); ?></a></td>
                    <td><a href="#" id="soal_pertanyaan_<?php echo $qui->soal_pertanyaan; ?>" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo base_url()?>admin/kursus/update_field/soal_seconds/<?php echo $qui->soal_id; ?>/soal_id/soal"><?php echo set_value('soal_seconds', isset($qui->soal_seconds) ? $qui->soal_seconds : ''); ?></a></td>
                </tr>
                <tr>
                    <td>Right Answer</td>
                    <td><a href="#" class="form_editable" data-type="select" data-source='[{value: "1", text: "A"},{value: "2", text: "B"},{value: "3", text: "C"},{value: "4", text: "D"}, ]' data-pk="1" data-title="Ubah jawaban"  data-url="<?php echo base_url()?>admin/kursus/update_field/soal_jawaban/<?php echo $qui->soal_id; ?>/soal_id/soal"><?php echo set_value('soal_jawaban', isset($qui->soal_jawaban) ? $qui->soal_jawaban : ''); ?></a></td>
                    <td></td>
                </tr>
            </table>
            <br>
            <button class="btn btn-labeled btn-success btn-xs" type="button" id="add_item_soal_option_<?php echo $qui->soal_id; ?>" onclick="new_item('<?php echo $qui->soal_id?>','soal_id','soal_option')"><span class="btn-label icon fa fa-plus"></span> Add Answer</button>
            <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_soal_option_<?php echo $qui->soal_id?>" style="display:none" /> 
            
            <!-- <button class="btn btn-labeled btn-success btn-xs" type="button" id="add_item_answer_picture_<?php echo $qui->soal_id; ?>" onclick="new_item('<?php echo $qui->soal_id?>','soal_id','answer_picture')"><span class="btn-label icon fa fa-plus"></span> Add Detail</button>
            <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_answer_picture_<?php echo $qui->soal_id?>" style="display:none" /> 

            <a href="<?php echo base_url()?>admin/kursus/add_detail/<?php echo $qui->soal_id; ?>"><button class="btn btn-labeled btn-success btn-xs" type="button"> <span class="btn-label icon fa fa-plus"></span> Tambahan</button></a> 
             -->
            <br><br>

            <div class="ui-jawaban" id="respond_item_soal_option_<?php echo $qui->soal_id; ?>">
            

            </div>
            <br>
            <p class="text-right">
                <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_soal_<?php echo $qui->soal_id; ?>" onclick="delete_item('<?php echo $qui->soal_id?>','soal_id','soal')"><span class="btn-label icon fa fa-times"></span> Delete Quiz</button>
                <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_soal_<?php echo $qui->soal_id?>" style="display:none" /> 
            </p>
        </div>
    </div>
</div>