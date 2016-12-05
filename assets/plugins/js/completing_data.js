$(document).ready(function () {
    // var seen = {};
    // $('.body_specification_requirement label.label_req_spec').each(function() {
    //     var txt = $(this).text();        
    //     if (seen[txt])
    //         $(this).closest('tr').remove();            
    //     else
    //         seen[txt] = true;
    // }); 
    
    $('[name=submitcompletingdata],.body_specification_requirement').keypress(function(event){
    if (event.keyCode === 10 || event.keyCode === 13) 
        event.preventDefault();
    });  

    $('[name=submitcompletingdata]').click(function(){
        $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_general_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',false);
            var file_req_document_general_003     = $('#file_req_document_general_1_ARG_0003'),
                file_req_document_general_004     = $('#file_req_document_general_2_ARG_0004'),
                file_req_document_general_005     = $('#file_req_document_general_3_ARG_0005'),
                file_req_document_general_006     = $('#file_req_document_general_4_ARG_0006'),
                file_req_document_general_007     = $('#file_req_document_general_5_ARG_0007'),
                status_upload_document_general_1  = $('#status_upload_document_general_1').val(),
                status_upload_document_general_2  = $('#status_upload_document_general_2').val(),
                status_upload_document_general_3  = $('#status_upload_document_general_3').val(),
                status_upload_document_general_4  = $('#status_upload_document_general_4').val(),
                status_upload_document_general_5  = $('#status_upload_document_general_5').val();

                if(status_upload_document_general_1 =='' && status_upload_document_general_2 =='') {
                        file_req_document_general_003.attr('required',false);
                        file_req_document_general_004.attr('required',false);            
                    };

                if(status_upload_document_general_1 !='' || status_upload_document_general_2 !='' ){                    
                    if(status_upload_document_general_1 == '') {
                        file_req_document_general_003.attr('required',true);
                    };
                    if(status_upload_document_general_2 == '') {
                        file_req_document_general_004.attr('required',true);            
                    };
                };               

                if(status_upload_document_general_3 =='' && status_upload_document_general_4 =='' && status_upload_document_general_5 =='') {
                        file_req_document_general_005.attr('required',false);                
                        file_req_document_general_006.attr('required',false);
                        file_req_document_general_007.attr('required',false);
                    };

                if(status_upload_document_general_3 !='' || status_upload_document_general_4 !='' || status_upload_document_general_5 !='') {                    
                    if(status_upload_document_general_3 == '') {
                        file_req_document_general_005.attr('required',true);                
                    };
                    if(status_upload_document_general_4 == '') {
                        file_req_document_general_006.attr('required',true);
                    };
                    if(status_upload_document_general_5 == '') {
                        file_req_document_general_007.attr('required',true);
                    };            
                };

                
                                

        $('.save_result_expiration_date_req_general_certificate').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[7];             
            var label_save_expiration_date      = $('#save_result_expiration_date_req_general_certificate_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_general_certificate_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_document_certificate_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[7];             
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate_license_garuda').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[8];             
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_license_garuda_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate_license_citilink').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[8];             
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_license_citilink_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate_license_sriwijaya').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[8];             
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_license_sriwijaya_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate_easa').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[8]; 
        
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_easa_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_easa_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_easa_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate_special').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[8];              
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_special_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_special_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_special_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate_garuda').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[8];             
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_garuda_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_garuda_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_garuda_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate_citilink').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[8];             
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_citilink_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_citilink_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_citilink_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        }); 

        $('.save_result_expiration_date_req_spec_certificate_sriwijaya').each(function(){
            var expiration_date                 = $(this).val();
            var id                              = this.id;            
            var data_row_id                     = id.split("_");             
            var row_id                          = data_row_id[8];             
            var label_save_expiration_date      = $('#save_result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val();
            var status_upload                   = $('#status_upload_'+row_id).val();              
            var save_expiration_date            = $('#save_result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val().split("-");
            
            var label_ex_date                   = save_expiration_date[0];
            var label_ex_month                  = save_expiration_date[1];
            var label_ex_year                   = save_expiration_date[2];
            var save_result_expiration_date     = new Date(label_ex_year + '-' + label_ex_month + '-' + label_ex_date);
            var file_req_document_certificate   = $('#file_req_spec_certificate_sriwijaya_'+row_id);
            var date_now = new Date(); 
            if (label_save_expiration_date == '01-01-1970') {
                file_req_document_certificate.attr('required', false);
            } else if (save_result_expiration_date < date_now) {
                file_req_document_certificate.attr('required', true);                
            } else  if (save_result_expiration_date > date_now) {
                file_req_document_certificate.attr('required', false);
            } else if (status_upload == '1' && label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', false);
            } else if( label_save_expiration_date == '') {
                file_req_document_certificate.attr('required', true);                
            }

        });         
    });
    
    $('[name=submitcompletingdata]').mouseout(function(){
        $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',true);           
    });    
    
    
    $('.expiration_date_req_general,.date_training_req_general_certificate,.date_training_req_spec_certificate,.date_training_req_spec_certificate_easa,.date_training_req_spec_certificate_special,.date_training_req_spec_certificate_garuda,.date_training_req_spec_certificate_citilink,.date_training_req_spec_certificate_sriwijaya,.date_training_req_spec_certificate_license_garuda,.date_training_req_spec_certificate_license_citilink,.date_training_req_spec_certificate_license_sriwijaya,.expiration_date_req_spec_certificate_special,.expiration_date_req_spec_certificate_garuda,.expiration_date_req_spec_certificate_citilink,.expiration_date_req_spec_certificate_sriwijaya').datepicker(         
        {format: 'dd-mm-yyyy',
        orientation: 'top auto',
        autoclose : 'true',
        clearBtn : 'true',}           
    );  
    // Disabled input file     
    $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',true);
    
    // Progressbar upload file           
    $('.body_general_requirement').on('change', '.file_req_document_general', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];
        var code_1 = data_row_id[5];
        var code_2 = data_row_id[6];                         
        var file            = $('#file_req_document_general_'+ row_id+'_'+ code_1+'_'+ code_2).prop('files')[0];            
        var code            = $('#code_req_document_general_'+ row_id).val();            
                
        var progressbar     = $('#progressbar_document_general_'+row_id);
        var statustxt       = $('#statustxt_document_general_'+row_id);                      
        var status_file     = $('#status_file_document_general_'+ row_id);
        var empty_file      = $('#empty_file_document_general_'+ row_id+'_'+ code_1+'_'+ code_2);            
        
        var timerId = 0;
        var ctr=0;
        var max=10;
                
        var form_data = new FormData();
        form_data.append(
            'file_req_document_general', file
            );
        form_data.append(
            'code_req_document_general', code
            );

        $.ajax({
            url: upload_file_general, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_'+row_id).html(response); 
                    $('#msg_'+row_id).css('color','red');
                } else {
                    timerId = setInterval(function () {    
                        ctr++;
                        $(progressbar).attr("style","width:" + ctr*max + "%");
                        progressbar.css('background','blue');
                        statustxt.html(ctr*max + "%"); 
                        statustxt.css('color','#000'); 
                        status_file.hide(); 
                        empty_file.hide();                                 
                        
                        if (ctr==max) {
                        status_file.show(); 
                        empty_file.show(); 
                        clearInterval(timerId);
                        status_file.attr('src',image_check);
                        empty_file.attr('src',image_cross_check);
                        $('#msg_'+row_id).html(response);
                        $('#msg_'+row_id).css('color','blue');
                        $('#status_upload_document_general_'+row_id).val('1');
                        }            
                    }, 300);                      
                }
            },
            error: function (response) {                
                $('#msg_'+row_id).html(response); 
            }
        });    
    });


    $('.empty_file_document_general').on('mouseover', function(){        
        var id              = this.id;
        var data_row_id     = id.split("_"); 
        var row_id          = data_row_id[4];        
        var code_file       = $('#code_req_document_general_'+ row_id).val();        
        var loading         = $('#loading_document_general_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
                loading.hide();                                
                $('#date_req_document_general_'+row_id).val(response);                 
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
                $('#time_req_document_general_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_document_general_'+row_id).val(response);                 
            }
        });        

    }); 
    
    $('.body_general_requirement').on('click', '.empty_file_document_general', function(e){

        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];
        var code_1 = data_row_id[5];
        var code_2 = data_row_id[6];              
        
        var empty_file      = $('#empty_file_document_general_'+ row_id+'_'+code_1+'_'+code_2);
        var progressbar     = $('#progressbar_document_general_'+row_id); 
        var status_file     = $('#status_file_document_general_'+ row_id);       
        var statustxt       = $('#statustxt_document_general_'+row_id);  

        var code_file       = $('#code_req_document_general_'+ row_id).val();            
        var date_upload     = $('#date_req_document_general_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_document_general_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?');
        if (yesno) {          
            var form_data = new FormData();                    
            form_data.append(
                'code_req_document_general', code_file
                );
            form_data.append(
                'date_req_document_general', date_upload
                );
            form_data.append(
                'time_req_document_general', time_upload
                );           

            $.ajax({
                url: delete_file_general, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_'+row_id).html(response); 
                        $('#msg_'+row_id).css('color','red');
                    } else {
                        $('#msg_'+row_id).html(response); 
                        $('#msg_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide(); 
                        $('#status_upload_document_general_'+row_id).val('');
                    }
                },
                error: function (response) {                
                    $('#msg_'+row_id).html(response); 
                    $('#msg_'+row_id).css('color','red');
                }
            }); 
        }          
    }); 
    
    
    $('.body_specification_requirement').on('change', '.file_req_document_certificate', function(){    
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];         
                      
        var progressbar     = $('#progressbar_document_certificate_'+ row_id);        
        var statustxt       = $('#statustxt_document_certificate_'+ row_id);                      
        var status_file     = $('#status_file_document_certificate_'+ row_id); 
        var empty_file      = $('#empty_file_document_certificate_'+ row_id);  
        var file            = $('#file_req_document_certificate_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_document_certificate_'+ row_id).val();                     
        var date_training   = $('#date_training_req_general_certificate_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_general_certificate_'+ row_id).val();                     

        var timerId = 0;
        var ctr=0;
        var max=10;

        var form_data = new FormData();
        form_data.append(
            'file_req_document_certificate', file
            );
        form_data.append(
            'code_req_document_certificate', code
            );
        form_data.append(
            'date_training_req_general_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_general_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_document_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                } else {
                    timerId = setInterval(function () {    
                        ctr++;
                        $(progressbar).attr("style","width:" + ctr*max + "%");
                        progressbar.css('background','blue');
                        statustxt.html(ctr*max + "%"); 
                        statustxt.css('color','#000'); 
                        status_file.hide(); 
                        empty_file.hide();                                 
                        
                        if (ctr==max) {
                        status_file.show(); 
                        empty_file.show(); 
                        clearInterval(timerId);
                        status_file.attr('src',image_check);
                        empty_file.attr('src',image_cross_check);
                        $('#msg_document_certificate_'+row_id).html(response);
                        $('#msg_document_certificate_'+row_id).css('color','blue');
                        }            
                    }, 300);                      
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                
    }); 
    
    $('.empty_file_document_certificate').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];
        var code_file       = $('#code_req_document_certificate_'+ row_id).val();                    
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
                loading.hide();                                
                $('#date_req_document_certificate_'+row_id).val(response);                 
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
                $('#time_req_document_certificate_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_general_certificate_'+row_id).val(response);                 
            }
        });        

    });
    
    $('.body_specification_requirement').on('click', '.empty_file_document_certificate', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];        
                                                                           
        var progressbar     = $('#progressbar_document_certificate_'+ row_id);        
        var statustxt       = $('#statustxt_document_certificate_'+ row_id);                      
        var status_file     = $('#status_file_document_certificate_'+ row_id); 
        var empty_file      = $('#empty_file_document_certificate_'+ row_id);
        
        var code_file       = $('#code_req_document_certificate_'+ row_id).val();                    
        var date_upload     = $('#date_req_document_certificate_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_document_certificate_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_document_certificate_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_document_certificate_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide(); 
                        $('#label_result_expiration_date_req_general_certificate_'+row_id).val('');                  
                        $('#save_result_expiration_date_req_general_certificate_'+row_id).val('');
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });     
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate, .file_general_spec_certificate', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];                              
                      
        var progressbar     = $('#progressbar_req_certificate_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_'+ row_id); 
        var file            = $('#file_req_spec_certificate_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_'+ row_id).val();                                
        
        var timerId = 0;
        var ctr=0;
        var max=10;


        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });

    $('.empty_file_req_certificate').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];

        var code_file       = $('#code_req_spec_certificate_'+ row_id).val();                            
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
                loading.hide();
                $('#date_req_spec_certificate_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_'+row_id).val(response);                 
            }
        });        
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];        
        
        var progressbar     = $('#progressbar_req_certificate_'+ row_id);
        var statustxt       = $('#statustxt_req_certificate_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_'+ row_id);
                     
        var code_file       = $('#code_req_spec_certificate_'+ row_id).val();                     
        var date_upload     = $('#date_req_spec_certificate_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });    
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_garuda, .file_req_general_certificate_license_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                              
                      
        var progressbar     = $('#progressbar_req_certificate_license_garuda_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_license_garuda_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_license_garuda_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_license_garuda_'+ row_id);    
        var file            = $('#file_req_spec_certificate_license_garuda_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_license_garuda_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_license_garuda_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_license_garuda_'+ row_id).val();                                
        
        var timerId = 0;
        var ctr=0;
        var max=10;


        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });

    $('.empty_file_req_certificate_license_garuda').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];      

        var code_file       = $('#code_req_spec_certificate_license_garuda_'+ row_id).val();                     
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
            loading.hide();                
                $('#date_req_spec_certificate_license_garuda_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_license_garuda_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(response);                 
            }
        });        
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate_license_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];        

        var progressbar     = $('#progressbar_req_certificate_license_garuda_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_license_garuda_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_license_garuda_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_license_garuda_'+ row_id);    
        var code_file       = $('#code_req_spec_certificate_license_garuda_'+ row_id).val();                                     
        var date_upload     = $('#date_req_spec_certificate_license_garuda_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_license_garuda_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_license_garuda_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_license_garuda_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_citilink, .file_req_general_certificate_license_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                              
                      
        var progressbar     = $('#progressbar_req_certificate_license_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_license_citilink_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_license_citilink_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_license_citilink_'+ row_id);    
        var file            = $('#file_req_spec_certificate_license_citilink_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_license_citilink_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_license_citilink_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_license_citilink_'+ row_id).val();                                
        
        var timerId = 0;
        var ctr=0;
        var max=10;


        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });

    $('.empty_file_req_certificate_license_citilink').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];      

        var code_file       = $('#code_req_spec_certificate_license_citilink_'+ row_id).val();                     
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
            loading.hide();                
                $('#date_req_spec_certificate_license_citilink_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_license_citilink_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val(response);                 
            }
        });        
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate_license_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];        

        var progressbar     = $('#progressbar_req_certificate_license_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_license_citilink_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_license_citilink_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_license_citilink_'+ row_id);    
        var code_file       = $('#code_req_spec_certificate_license_citilink_'+ row_id).val();                                     
        var date_upload     = $('#date_req_spec_certificate_license_citilink_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_license_citilink_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_license_citilink_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_license_citilink_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });
    
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_sriwijaya, .file_req_general_certificate_license_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                              
                      
        var progressbar     = $('#progressbar_req_certificate_license_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_license_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_license_sriwijaya_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_license_sriwijaya_'+ row_id);    
        var file            = $('#file_req_spec_certificate_license_sriwijaya_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_license_sriwijaya_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_license_sriwijaya_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_license_sriwijaya_'+ row_id).val();                                
        
        var timerId = 0;
        var ctr=0;
        var max=10;


        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });

    $('.empty_file_req_certificate_license_sriwijaya').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];      

        var code_file       = $('#code_req_spec_certificate_license_sriwijaya_'+ row_id).val();                     
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
            loading.hide();                
                $('#date_req_spec_certificate_license_sriwijaya_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_license_sriwijaya_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val(response);                 
            }
        });        
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate_license_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];        

        var progressbar     = $('#progressbar_req_certificate_license_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_license_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_license_sriwijaya_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_license_sriwijaya_'+ row_id);    
        var code_file       = $('#code_req_spec_certificate_license_sriwijaya_'+ row_id).val();                                     
        var date_upload     = $('#date_req_spec_certificate_license_sriwijaya_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_license_sriwijaya_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_license_sriwijaya_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_license_sriwijaya_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });
    
    
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_easa,.file_req_general_certificate_easa', function(){        
        var id          = this.id;
        var data_row_id = id.split("_"); 
        var row_id      = data_row_id[5];                                            
                      
        var progressbar     = $('#progressbar_req_certificate_easa_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_easa_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_easa_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_easa_'+ row_id);            
            
        var timerId = 0;
        var ctr=0;
        var max=10;                         
                      
        var file            = $('#file_req_spec_certificate_easa_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_easa_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_easa_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_easa_'+ row_id).val();                                        

        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });

    $('.empty_file_req_certificate_easa').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];

        var code_file       = $('#code_req_spec_certificate_easa_'+ row_id).val();                            
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
                loading.hide();
                $('#date_req_spec_certificate_easa_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_easa_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_easa_'+row_id).val(response);                 
            }
        });        
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate_easa', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];  

        var progressbar     = $('#progressbar_req_certificate_easa_'+ row_id);
        var statustxt       = $('#statustxt_req_certificate_easa_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_easa_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_easa_'+ row_id);
                     
        var code_file       = $('#code_req_spec_certificate_easa_'+ row_id).val();                     
        var date_upload     = $('#date_req_spec_certificate_easa_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_easa_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_easa_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_easa_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_easa_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_special,.file_req_general_certificate_special', function(e){        
        var id          = this.id;
        var data_row_id = id.split("_"); 
        var row_id      = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_req_certificate_special_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_special_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_special_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_special_'+ row_id);               
            
        var timerId = 0;
        var ctr=0;
        var max=10;                         
                      
        var file            = $('#file_req_spec_certificate_special_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_special_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_special_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_special_'+ row_id).val();                                        

        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        if (date_training != '') {
            form_data.append(
                'date_training_req_spec_certificate', date_training
                );
        }
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });


    $('.empty_file_req_certificate_special').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];

        var code_file       = $('#code_req_spec_certificate_special_'+ row_id).val();                            
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
                loading.hide();
                $('#date_req_spec_certificate_special_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_special_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_special_'+row_id).val(response);                 
            }
        });        
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate_special', function(   ){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];  

        var progressbar     = $('#progressbar_req_certificate_special_'+ row_id);
        var statustxt       = $('#statustxt_req_certificate_special_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_special_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_special_'+ row_id);
                     
        var code_file       = $('#code_req_spec_certificate_special_'+ row_id).val();                     
        var date_upload     = $('#date_req_spec_certificate_special_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_special_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_special_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_special_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_special_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_garuda, .file_general_spec_certificate_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                              
                      
        var progressbar     = $('#progressbar_req_certificate_garuda_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_garuda_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_garuda_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_garuda_'+ row_id);    
        var file            = $('#file_req_spec_certificate_garuda_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_garuda_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_garuda_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_garuda_'+ row_id).val();                                
        
        var timerId = 0;
        var ctr=0;
        var max=10;


        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });

    $('.empty_file_req_certificate_garuda').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];      

        var code_file            = $('#code_req_spec_certificate_garuda_'+ row_id).val();                     
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
            loading.hide();                
                $('#date_req_spec_certificate_garuda_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_garuda_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_garuda_'+row_id).val(response);                 
            }
        });        
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        

        var progressbar     = $('#progressbar_req_certificate_garuda_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_garuda_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_garuda_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_garuda_'+ row_id);    
        var code_file       = $('#code_req_spec_certificate_garuda_'+ row_id).val();                                     
        var date_upload     = $('#date_req_spec_certificate_garuda_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_garuda_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_garuda_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_garuda_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_garuda_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });


    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_citilink, .file_general_spec_certificate_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                              
                      
        var progressbar     = $('#progressbar_req_certificate_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_citilink_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_citilink_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_citilink_'+ row_id);    
        var file            = $('#file_req_spec_certificate_citilink_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_citilink_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_citilink_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_citilink_'+ row_id).val();                                
        
        var timerId = 0;
        var ctr=0;
        var max=10;


        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });

    $('.empty_file_req_certificate_citilink').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];      

        var code_file       = $('#code_req_spec_certificate_citilink_'+ row_id).val();                     
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
            loading.hide();                
                $('#date_req_spec_certificate_citilink_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_citilink_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_citilink_'+row_id).val(response);                 
            }
        });        
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        

        var progressbar     = $('#progressbar_req_certificate_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_citilink_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_citilink_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_citilink_'+ row_id);    
        var code_file       = $('#code_req_spec_certificate_citilink_'+ row_id).val();                                     
        var date_upload     = $('#date_req_spec_certificate_citilink_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_citilink_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_citilink_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_citilink_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_citilink_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }          
    });
    
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_sriwijaya,.file_req_general_certificate_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_req_certificate_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_sriwijaya_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_sriwijaya_'+ row_id);            
        var file            = $('#file_req_spec_certificate_sriwijaya_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_sriwijaya_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_sriwijaya_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_sriwijaya_'+ row_id).val();                                
        
        var timerId = 0;
        var ctr=0;
        var max=10;


        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    }); 

    $('.empty_file_req_certificate_sriwijaya').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];      

        var code_file       = $('#code_req_spec_certificate_sriwijaya_'+ row_id).val();                     
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
            loading.hide();                
                $('#date_req_spec_certificate_sriwijaya_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_sriwijaya_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val(response);                 
            }
        });        
    });
    

    $('.body_specification_requirement').on('click', '.empty_file_req_certificate_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        

        var progressbar     = $('#progressbar_req_certificate_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_sriwijaya_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_sriwijaya_'+ row_id);    
        var code_file       = $('#code_req_spec_certificate_sriwijaya_'+ row_id).val();                                     
        var date_upload     = $('#date_req_spec_certificate_sriwijaya_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_sriwijaya_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_sriwijaya_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_sriwijaya_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }   
    });  
    
    //cofc 
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_cofc,.file_req_general_certificate_cofc', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_cofc_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_cofc_'+ row_id);                      
        var status_file     = $('#status_file_certificate_cofc_'+ row_id);
        var empty_file      = $('#empty_file_certificate_cofc_'+ row_id);            
        var file            = $('#file_req_spec_certificate_cofc_'+row_id).prop('files')[0];                    
        var code            = $('#code_req_spec_certificate_cofc_'+ row_id).val();                     
        var date_training   = $('#date_training_req_spec_certificate_cofc_'+ row_id).val();                     
        var expirate_date   = $('#save_result_expiration_date_req_spec_certificate_cofc_'+ row_id).val();                                
        
        var timerId = 0;
        var ctr=0;
        var max=10;


        var form_data = new FormData();
        form_data.append(
            'file_req_spec_certificate', file
            );
        form_data.append(
            'code_req_spec_certificate', code
            );
        form_data.append(
            'date_training_req_spec_certificate', date_training
            );
        form_data.append(
            'save_result_expiration_date_req_spec_certificate', expirate_date
            );

        $.ajax({
            url: upload_file_spec_certificate, 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {                
                if (response == 'File type not suport, please atach file pdf.' || response == 'File too large, max 5mb.' || response == 'File is exists.') {
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
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
                            $('#msg_document_certificate_'+row_id).html(response); 
                            $('#msg_document_certificate_'+row_id).css('color','blue');
                            }            
                        }, 300);                 
                }
            },
            error: function (response) {                
                $('#msg_document_certificate_'+row_id).html(response); 
            }
        });                    
    });

    $('.empty_file_certificate_cofc').on('mouseover', function(){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];      

        var code_file       = $('#code_req_spec_certificate_cofc_'+ row_id).val();                     
        var loading         = $('#loadingmessage_'+row_id);
        loading.show();
        var form_datetime   = new FormData();
            form_datetime.append(
                'code_req_document_certificate', code_file
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
            loading.hide();                
                $('#date_req_spec_certificate_cofc_'+row_id).val(response);                 
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
                $('#time_req_spec_certificate_cofc_'+row_id).val(response);                 
            }
        });

        $.ajax({
            url : cek_expiration_file_current,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datetime,
            type: 'post',
            success: function (response) {                               
                $('#label_result_expiration_date_req_spec_certificate_cofc_'+row_id).val(response);                 
            }
        });        
    });
    

    $('.body_specification_requirement').on('click', '.empty_file_certificate_cofc', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        

        var progressbar     = $('#progressbar_req_certificate_cofc_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_cofc_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_cofc_'+ row_id);
        var empty_file      = $('#empty_file_req_certificate_cofc_'+ row_id);    
        var code_file       = $('#code_req_spec_certificate_cofc_'+ row_id).val();                                     
        var date_upload     = $('#date_req_spec_certificate_cofc_'+ row_id).val().replace(/-/g,'');                            
        var time_upload     = $('#time_req_spec_certificate_cofc_'+ row_id).val().replace(':','').substring(0,2);                                    

        var yesno = confirm('Are you sure?' + '\nLast update file ' + 
            $('#date_req_spec_certificate_cofc_'+ row_id).val().substring(0,10) + ' '+ $('#time_req_spec_certificate_cofc_'+ row_id).val().substring(0,8));
        if (yesno) {          
            var form_data = new FormData();
            form_data.append(
                'code_req_document_certificate', code_file
                );
            form_data.append(
                'date_req_document_certificate', date_upload
                );
            form_data.append(
                'time_req_document_certificate', time_upload
                );           

            $.ajax({
                url: delete_file_document_certificate, 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {                
                    if (response == 'Delete failed, please try again.') {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','red');
                    } else {
                        $('#msg_document_certificate_'+row_id).html(response); 
                        $('#msg_document_certificate_'+row_id).css('color','blue'); 
                        $(progressbar).attr("style","width:0%");
                        progressbar.css('background','white');
                        statustxt.html("0%"); 
                        statustxt.css('color','#000');  
                        status_file.hide(); 
                        empty_file.hide();                         
                        $('#label_result_expiration_date_req_spec_certificate_cofc_'+row_id).val('');                  
                    }
                },
                error: function (response) {                
                    $('#msg_document_certificate_'+row_id).html(response); 
                    $('#msg_document_certificate_'+row_id).css('color','red');
                }
            }); 
        }   
    });                                                                            
           
    if($('.date_training').val('')){
       $('.training_certificate_req').attr('disabled',true);
       var date_training = new Date();
       var day = ("0" + date_training.getDate()).slice(-2);
       var month = ("0" + (date_training.getMonth() + 1)).slice(-2);       
       $('.date_training').val((day)+'-'+(month)+'-'+date_training.getFullYear());            
    };
        // $('.body_general_requirement').on('.focusout', '.expiration_date_req_general_document', function(e){
        //     var row_id = this.id;
        //     if($('.expiration_date_req_general_document').val != ''){        
        //     $('#file_req_document_general_' + row_id).attr('disabled',false);
        //     }else{
        //     $('#file_req_document_general_' + row_id).attr('disabled',true);
        //     };

        // }); 
        
        $('.date_training_req_general_certificate').datepicker().on('click', function(e){
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[5];                                       
            $('#result_expiration_date_req_general_certificate_'+row_id).val('');
            $('#save_result_expiration_date_req_general_certificate_'+row_id).val(''); 
            $('#label_result_expiration_date_req_general_certificate_'+row_id).val('');
        });                
        
        $('.date_training_req_general_certificate').datepicker().on('changeDate', function(){                
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[5];                     
            var d = new Date();
            var day_now = d.getDate();
            var month_date_now = d.getMonth();
            var thn_date_now = d.getFullYear();
          if($('#date_training_req_general_certificate_' + row_id).val() != '') {
            var id_thn = $('#date_training_req_general_certificate_' + row_id).val();
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1];
            var thn = data_thn_id[2];
            var age = $('#expiration_date_req_general_certificate_'+ row_id).val();
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age));
            if(rs_exp_date == null) {
              $('#file_req_document_certificate_' + row_id).attr('disabled',false);
            }
            else if(isNaN(thn + age)) {
              $('#file_req_document_certificate_' + row_id).attr('disabled',false);
            }
            else {
              var data_thn_exp_id = rs_exp_date.split("-");
              var month_exp = data_thn_exp_id[1];
              var thn_exp = data_thn_exp_id[2];
              var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
              var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
              // alert(date_now);
              // alert(date_exp);
              //                                                                                                  
              $('#save_result_expiration_date_req_general_certificate_'+row_id).val(rs_exp_date);
              $('#label_result_expiration_date_req_general_certificate_'+row_id).val(rs_exp_date);
              if(date_exp > date_now){
                $('#file_req_document_certificate_' + row_id).attr('disabled',false);            
              }
              else{
                $('#warning').modal({
                  backdrop: 'static', keyboard: false }
                                   );
                $('#file_req_document_certificate_' + row_id).attr('disabled',true);
              };
            };
          }
          else if($('.date_training_req_general_certificate#'+row_id).val().length == 0){
            $('#file_req_document_certificate_' + row_id).attr('disabled',true);
          };
          $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate').datepicker().on('changeDate', function(e){
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[5];                                    
            $('#result_expiration_date_req_spec_certificate_'+row_id).val('');
            $('#save_result_expiration_date_req_spec_certificate_'+row_id).val(''); 
            $('#label_result_expiration_date_req_spec_certificate_'+row_id).val('');
        });              
        
        $('.date_training_req_spec_certificate').datepicker().on('changeDate', function(e){        
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[5]; 
            if($('#date_training_req_spec_certificate_'+row_id).val().length != 0){
                var id_thn = $('#date_training_req_spec_certificate_' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)) 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_' + row_id).attr('disabled',false);    
                }
                else{ 
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                      
                $('#result_expiration_date_req_spec_certificate_'+row_id).val(rs_exp_date);                                                        
                $('#save_result_expiration_date_req_spec_certificate_'+row_id).val(rs_exp_date);
                $('#label_result_expiration_date_req_spec_certificate_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate#'+row_id).val().length == 0){
            $('#file_req_spec_certificate_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        // License Garuda
        $('.date_training_req_spec_certificate_license_garuda').datepicker().on('changeDate', function(e){
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[7];   

            $('#result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val('');
            $('#save_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(''); 
            $('#label_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val('');
        });
        
        $('.date_training_req_spec_certificate_license_garuda').datepicker().on('changeDate', function(e){                 
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[7];

            if($('#date_training_req_spec_certificate_license_garuda_'+row_id).val().length != 0){
                var id_thn = $('#date_training_req_spec_certificate_license_garuda_' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_license_garuda_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',false);    
                }
                else {                                                                                                                
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);  
                                                                        
                $('#result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(rs_exp_date);
                $('#save_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(rs_exp_date);                                                        
                $('#label_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_license_garuda#'+row_id).val().length == 0){
                $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });

        // License Citilink
        $('.date_training_req_spec_certificate_license_citilink').datepicker().on('changeDate', function(e){        
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[7];

            if($('#date_training_req_spec_certificate_license_citilink_'+row_id).val().length != 0){
                var id_thn = $('#date_training_req_spec_certificate_license_citilink_' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_license_citilink_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',false);    
                }
                else {
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                           
                $('#result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val(rs_exp_date);
                $('#save_result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val(rs_exp_date);                                                        
                $('#label_result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_license_citilink#'+row_id).val().length == 0){
            $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        // License Sriwijaya
        $('.date_training_req_spec_certificate_license_sriwijaya').datepicker().on('changeDate', function(e){        
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[7];
            if($('#date_training_req_spec_certificate_license_sriwijaya_'+row_id).val().length != 0){
                var id_thn = $('#date_training_req_spec_certificate_license_sriwijaya_' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_license_sriwijaya_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',false);    
                }
                else { 
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                       
                $('#result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val(rs_exp_date);                                                        
                $('#save_result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val(rs_exp_date);
                $('#label_result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_license_sriwijaya#'+row_id).val().length == 0){
            $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_easa').datepicker().on('changeDate', function(e){        
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[6]; 
            if($('#date_training_req_spec_certificate_easa_'+row_id).val().length != 0){
                var id_thn = $('#date_training_req_spec_certificate_easa_' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_easa_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null) {
                    $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',false);    
                } else {                                                                                                                
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                
                
                $('#result_expiration_date_req_spec_certificate_easa_'+row_id).val(rs_exp_date);
                $('#save_result_expiration_date_req_spec_certificate_easa_'+row_id).val(rs_exp_date);                                                        
                $('#label_result_expiration_date_req_spec_certificate_easa_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_easa#'+row_id).val().length == 0){
                $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        
        $('.date_training_req_spec_certificate_special').datepicker().on('changeDate', function(e){        
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[6]; 
            if($('#date_training_req_spec_certificate_special_'+row_id).val().length != 0){
            var id_thn = $('#date_training_req_spec_certificate_special_' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_special_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
            if(rs_exp_date == null){
                    $('#file_req_spec_certificate_special_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_special_' + row_id).attr('disabled',false);    
                }
                else{
                    var data_thn_exp_id = rs_exp_date.split("-");            
                    var month_exp = data_thn_exp_id[1];
                    var thn_exp = data_thn_exp_id[2]; 
                    var d = new Date();
                    var day_now = d.getDate();
                    var month_date_now = d.getMonth();
                    var thn_date_now = d.getFullYear();                                                                             
                    var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                    var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                    
                    $('#result_expiration_date_req_spec_certificate_special_'+row_id).val(rs_exp_date);
                    $('#save_result_expiration_date_req_spec_certificate_special_'+row_id).val(rs_exp_date);                                                        
                    $('#label_result_expiration_date_req_spec_certificate_special_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_special_' + row_id).attr('disabled',false); 
                        }else{
                            $('#warning').modal({ backdrop: 'static', keyboard: false });
                            $('#file_req_spec_certificate_special_' + row_id).attr('disabled',true);                 
                        };                                                                                
                    }                                  
            } else if($('.date_training_req_spec_certificate_special#'+row_id).val().length == 0) {
                $('#file_req_spec_certificate_special_' + row_id).attr('disabled',true);
                };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_garuda').datepicker().on('changeDate', function(e){        
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[6];             
            if($('#date_training_req_spec_certificate_garuda_'+row_id).val().length != 0){
            var id_thn = $('#date_training_req_spec_certificate_garuda_' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_garuda_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                        $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',false);    
                    } else if(isNaN(thn + age)) {
                        $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',false);    
                    }
                    else {           
                    var data_thn_exp_id = rs_exp_date.split("-");            
                    var month_exp = data_thn_exp_id[1];
                    var thn_exp = data_thn_exp_id[2]; 
                    var d = new Date();
                    var day_now = d.getDate();
                    var month_date_now = d.getMonth();
                    var thn_date_now = d.getFullYear();                                                                             
                    var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                    var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                                
                    $('#result_expiration_date_req_spec_certificate_garuda_'+row_id).val(rs_exp_date);
                    $('#save_result_expiration_date_req_spec_certificate_garuda_'+row_id).val(rs_exp_date);                                                        
                    $('#label_result_expiration_date_req_spec_certificate_garuda_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            } else if($('.date_training_req_spec_certificate_garuda#'+row_id).val().length == 0) {
                    $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',true);
                };
            $(this).datepicker('hide');
        });
        
        
        $('.date_training_req_spec_certificate_citilink').datepicker().on('changeDate', function(e){        
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[6];

            if($('#date_training_req_spec_certificate_citilink_'+row_id).val().length != 0){
            var id_thn = $('#date_training_req_spec_certificate_citilink_' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_citilink_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                        $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',false);    
                    } else if(isNaN(thn + age)) {
                        $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',false);    
                    } else {
                    var data_thn_exp_id = rs_exp_date.split("-");            
                    var month_exp = data_thn_exp_id[1];
                    var thn_exp = data_thn_exp_id[2]; 
                    var d = new Date();
                    var day_now = d.getDate();
                    var month_date_now = d.getMonth();
                    var thn_date_now = d.getFullYear();                                                                             
                    var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                    var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                    
                    $('#result_expiration_date_req_spec_certificate_citilink_'+row_id).val(rs_exp_date);
                    $('#save_result_expiration_date_req_spec_certificate_citilink_'+row_id).val(rs_exp_date);                                                        
                    $('#label_result_expiration_date_req_spec_certificate_citilink_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_citilink#'+row_id).val().length == 0){
                    $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',true);
                };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_sriwijaya').datepicker().on('changeDate', function(e){        
            var id = this.id;
            var data_row_id = id.split("_"); 
            var row_id = data_row_id[6];
            if($('#date_training_req_spec_certificate_sriwijaya_'+row_id).val().length != 0){
            var id_thn = $('#date_training_req_spec_certificate_sriwijaya_' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_sriwijaya_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',false);    
                    } else if(isNaN(thn + age)) {
                        $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',false);    
                    } else {
                        var data_thn_exp_id = rs_exp_date.split("-");            
                        var month_exp = data_thn_exp_id[1];
                        var thn_exp = data_thn_exp_id[2]; 
                        var d = new Date();
                        var day_now = d.getDate();
                        var month_date_now = d.getMonth();
                        var thn_date_now = d.getFullYear();                                                                             
                        var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                        var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                                    
                        $('#result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val(rs_exp_date);
                        $('#save_result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val(rs_exp_date);                                                        
                        $('#label_result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val(rs_exp_date);
                        if(date_exp > date_now){
                            $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',false); 
                        }else{
                            $('#warning').modal({ backdrop: 'static', keyboard: false });
                            $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',true);                 
                        };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_sriwijaya#'+row_id).val().length == 0){
                $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_cofc').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_cofc#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_cofc#' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_cofc_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                        $('#file_req_spec_certificate_cofc_' + row_id).attr('disabled',false);    
                    } else if(isNaN(thn + age)) {
                        $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',false);    
                    } else {
                        var data_thn_exp_id = rs_exp_date.split("-");            
                        var month_exp = data_thn_exp_id[1];
                        var thn_exp = data_thn_exp_id[2]; 
                        var d = new Date();
                        var day_now = d.getDate();
                        var month_date_now = d.getMonth();
                        var thn_date_now = d.getFullYear();                                                                             
                        var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                        var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                                    
                        $('#result_expiration_date_req_spec_certificate_cofc_'+row_id).val(rs_exp_date);
                        $('#save_result_expiration_date_req_spec_certificate_cofc_'+row_id).val(rs_exp_date);                                                        
                        $('#label_result_expiration_date_req_spec_certificate_cofc_'+row_id).val(rs_exp_date);
                        if(date_exp > date_now){
                            $('#file_req_spec_certificate_cofc_' + row_id).attr('disabled',false); 
                        }else{
                            $('#file_req_spec_certificate_cofc_' + row_id).attr('disabled',true);                 
                        };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_cofc#'+row_id).val().length == 0){
            $('#file_req_spec_certificate_cofc_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        
        });