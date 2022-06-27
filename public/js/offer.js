var script = document.createElement('script');
script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js';

$('input[type="checkbox"]').change(function(event) {
    if($(this).is(':checked')){
    var selected_product_id=$("#product_id").val();
   $('#related_product_id').children('option').attr('disabled', false).css('color',"");
   $('#related_product_id').children('option[value="' + selected_product_id + '"]').attr('disabled', true).css('color','red');
   $("#related_product_id").attr('disabled', false);
   $('#quantity').prop('disabled', true);
    }else{
        $("#related_product_id").attr('disabled', true);
        $('#quantity').prop('disabled', false);
    }
});

$("#product_id").on('change',function(){
   var selected_product_id=$(this).val();
   $("#related_product_id option:selected").text('None');
   $('#related_product_id').children('option[value=""]').attr("selected",true);
   $('#related_product_id').children('option').attr('disabled', false).css('color',"");
   $('#related_product_id').children('option[value="' + selected_product_id + '"]').attr('disabled', true).css('color','red');
});
