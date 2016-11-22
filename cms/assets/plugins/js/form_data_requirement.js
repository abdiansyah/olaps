$('div[id=applicant').show();
$('div[id=quality').hide();
$('[name=applicant').on('click',function(){
    $('div[id=applicant').show();
    $('div[id=quality').hide();
});
$('[name=quality').on('click',function(){
    $('div[id=applicant').hide();
    $('div[id=quality').show();
});
$('.body_data_requirement_quality').on('change', '.file_req_document_general', function(e){        
    var id = this.id;
    var data_row_id = id.split("_"); 
    var row_id = data_row_id[4];
    var code_1 = data_row_id[5];
    var code_2 = data_row_id[6];                         
                  
    var progressbar     = $('#progressbar_document_general_'+row_id);
    var statustxt       = $('#statustxt_document_general_'+row_id);                      
    var status_file     = $('#status_file_document_general_'+ row_id);
    var empty_file      = $('#empty_file_document_general_'+ row_id+'_'+ code_1+'_'+ code_2);            
    
    var timerId = 0;
    var ctr=0;
    var max=10;

    timerId = setInterval(function () {    
    ctr++;
    $(progressbar).attr("style","width:" + ctr*max + "%");
    progressbar.css('background','blue');
    statustxt.html(ctr*max + "%"); 
    statustxt.css('color','#000'); 
    status_file.hide(); 
    empty_file.hide();                                 
    
    if (ctr==max){
    status_file.show(); 
    empty_file.show(); 
    clearInterval(timerId);
    status_file.attr('src', check);
    empty_file.attr('src', cross_check);
    }            
}, 300);  
}); 


$('.expiration_date,.expiration_date_quality').datepicker({
    format :'dd-mm-yyyy',
});
//var seen = {};
//$('.body_data_requirement label.label_data_document').each(function() {
//    var txt = $(this).text();        
//    if (seen[txt])
//        $(this).closest('tr').remove();            
//    else
//        seen[txt] = true;
//});
//

$('.action_view_document').one('mouseover', function(){                
        var row_id              = this.id;
        var code_file           = $('#code_data_requirement_'+ row_id).val();                    
        var personnel_number    = $('#personnel_number_'+ row_id).val();                        
        var loading             = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime       = new FormData();
            form_datetime.append(
                'code_data_requirement', code_file
                );                
            form_datetime.append(
                'personnel_number', personnel_number
                );         
        $.ajax({
            url : cek_date_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                                                     
                $('#date_data_requirement_'+row_id).val(response);                 
            }
        });


        $.ajax({
            url : cek_time_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#time_data_requirement_'+row_id).val(response);                 
                loading.hide();
            }
        });


        // $.ajax({
        //     url : cek_expiration_file_current,
        //     dataType: 'text',
        //     cache: false,
        //     contentType: false,
        //     processData: false,
        //     data: form_datetime,
        //     type: 'post',
        //     success: function (response) {                               
        //         $('#label_result_expiration_date_req_general_certificate_'+row_id).val(response);                 
        //     }
        // });        

    });
    