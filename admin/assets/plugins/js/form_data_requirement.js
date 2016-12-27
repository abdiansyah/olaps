$(document).ready(function () {
var seen = {};
$('.body_data_requirement td.label_data_document').each(function() {
    var txt = $(this).text();        
    if (seen[txt])
        $(this).closest('tr').remove();            
    else
        seen[txt] = true;
}); 

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


$('.save_result_expiration_date_data_requirement,.date_training_data_requirement,.save_result_expiration_date_data_requirement_tqd,.date_training_data_requirement_tqd').datepicker({
    format :'dd-mm-yyyy',
});


$('.file_data_requirement').on('change', function() {                
    var id                  = this.id;
    var data_row_id         = id.split("_"); 
    var row_id              = data_row_id[3]; 
    var file                = $('#file_data_requirement_'+ row_id).prop('files')[0];            
    var code                = $('#code_data_requirement_'+ row_id).val();            
    var date_training       = $('#date_training_data_requirement_'+ row_id).val();            
    var expiration_date     = $('#save_result_expiration_date_data_requirement_'+ row_id).val();            
    var personnel_number    = $('#personnel_number_'+ row_id).val();
    var loading             = $('#loadingmessage_'+row_id);
    loading.show();
    
    var timerId = 0;
    var ctr=0;
    var max=10;    

    var form_data = new FormData();
    form_data.append(
        'file_data_requirement', file
        );
    form_data.append(
        'code_data_requirement', code
        );
    form_data.append(
        'date_training_data_requirement', date_training
        );
    form_data.append(
        'save_result_expiration_date_data_requirement', expiration_date
        );
    form_data.append(
        'personnel_number', personnel_number
        );

    $.ajax({
        url: upload_file_data_requirement, 
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {                
            if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                $('#msg_data_requirement_'+row_id).html(response); 
                $('#msg_data_requirement_'+row_id).css('color','red');
                loading.hide();
            } else {                    
                $('#msg_data_requirement_'+row_id).html(response); 
                $('#msg_data_requirement_'+row_id).css('color','blue');                                            
                loading.hide();
            }
        },
        error: function (response) {                
            $('#msg_data_requirement_'+row_id).html(response); 
            loading.hide();
        }
    });                    
                                                  
});

$('.file_data_requirement_tqd').on('change', function() {                
    var id                  = this.id;
    var data_row_id         = id.split("_"); 
    var row_id              = data_row_id[4]; 
    var file                = $('#file_data_requirement_tqd_'+ row_id).prop('files')[0];            
    var code                = $('#code_data_requirement_tqd_'+ row_id).val();            
    var date_training       = $('#date_training_data_requirement_tqd_'+ row_id).val();            
    var expiration_date     = $('#save_result_expiration_date_data_requirement_tqd_'+ row_id).val();            
    var personnel_number    = $('#personnel_number_tqd_'+ row_id).val();
    var loading             = $('#loadingmessage_tqd_'+row_id);
    loading.show();
    
    var timerId = 0;
    var ctr=0;
    var max=10;    

    var form_data = new FormData();
    form_data.append(
        'file_data_requirement_tqd', file
        );
    form_data.append(
        'code_data_requirement_tqd', code
        );
    form_data.append(
        'date_training_data_requirement_tqd', date_training
        );
    form_data.append(
        'save_result_expiration_date_data_requirement_tqd', expiration_date
        );
    form_data.append(
        'personnel_number', personnel_number
        );

    $.ajax({
        url: upload_file_data_requirement_tqd, 
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {                
            if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                $('#msg_data_requirement_tqd_'+row_id).html(response); 
                $('#msg_data_requirement_tqd_'+row_id).css('color','red');
                loading.hide();
            } else {                    
                $('#msg_data_requirement_tqd_'+row_id).html(response); 
                $('#msg_data_requirement_tqd_'+row_id).css('color','blue');                                            
                loading.hide();
            }
        },
        error: function (response) {                
            $('#msg_data_requirement_tqd_'+row_id).html(response); 
            loading.hide();
        }
    });                    
                                                  
});


$('.action_view_document').one('mouseover', function() {                
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
    });
    
    $('[name=id_authorization]').on('change', function (){
        var id_auth = $(this).val();
        $.get(cek_authorization + id_auth, function(data, status){                 
                    $("select[name=id_type]").html(data);          
            });                                   
    });
});

    