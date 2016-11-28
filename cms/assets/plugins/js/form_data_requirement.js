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


$('.expiration_date,.expiration_date_quality').datepicker({
    format :'dd-mm-yyyy',
});


$('.file_data_requirement').on('change', function() {                
    var id                  = this.id;
    var data_row_id         = id.split("_"); 
    var row_id              = data_row_id[3]; 
    var file                = $('#file_data_requirement_'+ row_id).prop('files')[0];            
    var code                = $('#code_data_requirement_'+ row_id).val();            
    var date_training       = $('#date_training_data_requirement_'+ row_id).val();            
    var expiration_date     = $('expiration_date_data_requirement_'+ row_id).val();            
    
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
            } else {
                    timerId = setInterval(function () {    
                        ctr++;
                        $(progressbar).attr("style","width:" + ctr*max + "%");
                        progressbar.css('background','blue');
                        statustxt.html(ctr*max + "%"); 
                        statustxt.css('color','#000'); 
                        status_file.hide();  
                        empty_file.hide();                                
                        // max reached?
                        if (ctr==max){
                        status_file.show(); 
                        empty_file.show(); 
                        clearInterval(timerId);
                        status_file.attr('src',image_check);
                        empty_file.attr('src',image_cross_check);
                        $('#msg_data_requirement_'+row_id).html(response); 
                        $('#msg_data_requirement_'+row_id).css('color','blue');
                        }            
                    }, 300);                 
            }
        },
        error: function (response) {                
            $('#msg_data_requirement_'+row_id).html(response); 
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


    