function check_uncheck_checkbox(isChecked) {
    if (isChecked) {
        $('.check_assesment').each(function() {
            this.checked = true;
        });
    } else {
        $('.check_assesment').each(function() {
            this.checked = false;
        });
    }
}

$('[name=datetime_priority]').datetimepicker({
    format:'yyyy-mm-dd hh:ii:ss',
    daysOfWeekDisabled: [0,6],
    autoclose: true,
});


$('#current_status').change(function(){            
    var current_status = $(this).val();                             
    $.get(get_tab_option_sub_status + current_status , function(data, status){                 
        $("#sub_status").html(data);
    });
    //alert(current_status);
    if (current_status =='4'){
    var sub_status = $('#sub_status').val();        
    var request_number = $('[name=request_number]').val();
    var personnel_number =  $('[name=personnel_number]').val();    
    $.get(get_type_assesment_5 + request_number + "/" + personnel_number, function(data, status){                 
        $("#type_assesment_schedule").html(data);
        $("#type_assesment_schedule").show();
    });           
    }else if (current_status =='1' || current_status =='2' || current_status =='3' || current_status =='5' || current_status =='6' || current_status =='7'){
        $("#type_assesment_schedule").hide();
    }
     
});

$('#sub_status').change(function(){ 
    var sub_status = $(this).val();
    var request_number = $('[name=request_number]').val();
    var personnel_number =  $('[name=personnel_number]').val();    
    $.get( get_type_assesment + sub_status + "/" + request_number + "/" + personnel_number, function(data, status){                 
        $("#type_assesment_schedule").html(data);
    });
});
