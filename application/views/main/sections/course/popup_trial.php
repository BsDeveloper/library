<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script type="text/javascript">
  /* =========================================================================== */
  /*  Pop up after mouse cursor leaving web
  /* =========================================================================== */
$(document).ready(function(){
  	$("body").one("mouseleave", function(e){
         var str = "( " + e.pageX + ", " + e.pageY + " )";
         // alert(str);
         $("#btn-free").click();
         // $('#myModal').modal('toggle');
    });

});
</script>