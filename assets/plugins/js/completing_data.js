$(document).ready(function () {
    var seen = {};
    $('.body_specification_requirement label.label_req_spec').each(function() {
        var txt = $(this).text();        
        if (seen[txt])
            $(this).closest('tr').remove();            
        else
            seen[txt] = true;
    }); 
    
    $('[name=submitcompletingdata],.body_specification_requirement').keypress(function(event){
    if (event.keyCode === 10 || event.keyCode === 13) 
        event.preventDefault();
    });  
    
    // 26-09-2016    
   $('.body_general_requirement').on('change', '.file_req_document_general', function(e){           
    var file_req_document_general_003     = $('#file_req_document_general_1_ARG_0003').val();
    var file_req_document_general_004     = $('#file_req_document_general_2_ARG_0004').val();
    var file_req_document_general_005     = $('#file_req_document_general_3_ARG_0005').val();
    var file_req_document_general_006     = $('#file_req_document_general_4_ARG_0006').val();
    var file_req_document_general_007     = $('#file_req_document_general_5_ARG_0007').val();
    if(file_req_document_general_003 !='' || file_req_document_general_004 !=''){
        $('#file_req_document_general_2_ARG_0004').attr('required',true);
        $('#file_req_document_general_1_ARG_0003').attr('required',true);
    };  
    if(file_req_document_general_005 !='' || file_req_document_general_006 !='' || file_req_document_general_007 !=''){
        $('#file_req_document_general_3_ARG_0005').attr('required',true);
        $('#file_req_document_general_4_ARG_0006').attr('required',true);
        $('#file_req_document_general_5_ARG_0007').attr('required',true);
    };                    
                      
});
    
    $('[name=submitcompletingdata]').click(function(){
        $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_no_required_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',false);
        $('.file_req_document_certificate,.file_req_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('required',true); 
        $('.file_req_no_required_document_certificate,.file_req_no_required_spec_certificate').attr('required',false);       
    });
    
    $('[name=submitcompletingdata]').mouseout(function(){
        $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_no_required_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',true);           
    });    
    
    
    $('.expiration_date_req_general,.date_training_req_general_certificate,.date_training_req_spec_certificate,.date_training_req_spec_certificate_easa,.date_training_req_spec_certificate_special,.date_training_req_spec_certificate_garuda,.date_training_req_spec_certificate_citilink,.date_training_req_spec_certificate_sriwijaya,.date_training_req_spec_certificate_license_garuda,.date_training_req_spec_certificate_license_citilink,.date_training_req_spec_certificate_license_sriwijaya,.expiration_date_req_spec_certificate_special,.expiration_date_req_spec_certificate_garuda,.expiration_date_req_spec_certificate_citilink,.expiration_date_req_spec_certificate_sriwijaya').datepicker(         
        {format: 'dd-mm-yyyy',
        orientation: 'top auto',
        autoclose : 'true',
        clearBtn : 'true',}           
    );  
    // Disabled input file     
    $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_no_required_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',true);
    
    $('[name=savecompletingdata]').click(function(){
        $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_no_required_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',false);
    });
    
    // Progressbar upload file           
    $('.body_general_requirement').on('change', '.file_req_document_general', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];
        var code_1 = data_row_id[5];
        var code_2 = data_row_id[6];                         
                      
        var progressbar     = $('#progressbar_document_general_'+row_id);
        var statustxt       = $('#statustxt_document_general_'+row_id);                      
        var status_file     = $('#status_file_document_general_'+ row_id);
        var empty_file     = $('#empty_file_document_general_'+ row_id+'_'+ code_1+'_'+ code_2);            
        
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
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    }); 
    
    $('.body_general_requirement').on('click', '.empty_file_document_general', function(e){

        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];
        var code_1 = data_row_id[5];
        var code_2 = data_row_id[6];
        var file_req_document_general_003     = $('#file_req_document_general_1_ARG_0003').val();
        var file_req_document_general_004     = $('#file_req_document_general_2_ARG_0004').val();
        var file_req_document_general_005     = $('#file_req_document_general_3_ARG_0005').val();
        var file_req_document_general_006     = $('#file_req_document_general_4_ARG_0006').val();
        var file_req_document_general_007     = $('#file_req_document_general_5_ARG_0007').val();        
        var file_req_document_general = $('#file_req_document_general_'+row_id+'_'+code_1+'_'+code_2);
        
        var empty_file     = $('#empty_file_document_general_'+ row_id+'_'+code_1+'_'+code_2);
        var progressbar     = $('#progressbar_document_general_'+row_id); 
        var status_file     = $('#status_file_document_general_'+ row_id);       
        var statustxt       = $('#statustxt_document_general_'+row_id);             
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide(); 
        file_req_document_general.replaceWith( file_req_document_general.val('').clone( true ) );        
        
        if(file_req_document_general_003 =='' || file_req_document_general_004 ==''){
            $('#file_req_document_general_1_ARG_0003').attr('required',false);
            $('#file_req_document_general_2_ARG_0004').attr('required',false);            
        };  
        if(file_req_document_general_005 == '' || file_req_document_general_006 =='' || file_req_document_general_007 ==''){
            $('#file_req_document_general_3_ARG_0005').attr('required',false);
            $('#file_req_document_general_4_ARG_0006').attr('required',false);
            $('#file_req_document_general_5_ARG_0007').attr('required',false);
        }; 
    }); 
    
    
    $('.body_specification_requirement').on('change', '.file_req_document_certificate', function(e){
        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];                              
                      
        var progressbar     = $('#progressbar_document_certificate_'+ row_id);
        
        var statustxt       = $('#statustxt_document_certificate_'+ row_id);                      
        var status_file     = $('#status_file_document_certificate_'+ row_id); 
        var empty_file     = $('#empty_file_document_certificate_'+ row_id);           
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    }); 
    
    
    $('.body_specification_requirement').on('click', '.empty_file_document_certificate', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];        
                                                                           
        var progressbar     = $('#progressbar_document_certificate_'+ row_id);        
        var statustxt       = $('#statustxt_document_certificate_'+ row_id);                      
        var status_file     = $('#status_file_document_certificate_'+ row_id); 
        var empty_file     = $('#empty_file_document_certificate_'+ row_id);
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_document_certificate_'+row_id).val('');                                                                                                                                                                                   
    });     
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate, .file_general_spec_certificate', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];                              
                      
        var progressbar     = $('#progressbar_req_certificate_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_'+ row_id);
        var empty_file     = $('#empty_file_req_certificate_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];        
        
        var progressbar     = $('#progressbar_req_certificate_'+ row_id);
        var statustxt       = $('#statustxt_req_certificate_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_'+ row_id);
        var empty_file     = $('#empty_file_req_certificate_'+ row_id);
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_'+row_id).val('');                                                                                                                                                                                   
    });
     
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_garuda, .file_req_general_certificate_license_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                                    
                      
        var progressbar     = $('#progressbar_certificate_license_garuda_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_garuda_'+ row_id);  
        var statustxt       = $('#statustxt_certificate_license_garuda_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_garuda_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    });
    
     $('.body_specification_requirement').on('click', '.empty_file_certificate_license_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        
        
        var progressbar     = $('#progressbar_certificate_license_garuda_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_garuda_'+ row_id);  
        var statustxt       = $('#statustxt_certificate_license_garuda_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_garuda_'+ row_id);            

                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_license_garuda_'+row_id).val('');                                                                                                                                                                                   
    });
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_citilink,.file_req_general_certificate_license_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                                    
                      
        var progressbar     = $('#progressbar_certificate_license_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_license_citilink_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_citilink_'+ row_id);            
        var empty_file     = $('#empty_file_certificate_license_citilink_'+ row_id);
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_license_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        
        
        var progressbar     = $('#progressbar_certificate_license_citilink_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_citilink_'+ row_id);  
        var statustxt       = $('#statustxt_certificate_license_citilink_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_citilink_'+ row_id);            

                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_license_citilink_'+row_id).val('');                                                                                                                                                                                   
    });
      
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_sriwijaya,.file_req_general_certificate_license_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                                    
                      
        var progressbar     = $('#progressbar_certificate_license_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_license_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_sriwijaya_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_sriwijaya_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_license_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        
        
        var progressbar     = $('#progressbar_certificate_license_sriwijaya_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_sriwijaya_'+ row_id);  
        var statustxt       = $('#statustxt_certificate_license_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_sriwijaya_'+ row_id);            

                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_license_sriwijaya_'+row_id).val('');                                                                                                                                                                                   
    }); 
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_easa,.file_req_general_certificate_easa', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_easa_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_easa_'+ row_id);                      
        var status_file     = $('#status_file_certificate_easa_'+ row_id);
        var empty_file     = $('#empty_file_certificate_easa_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_easa', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];       
        
        var progressbar     = $('#progressbar_certificate_easa_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_easa_'+ row_id);                      
        var status_file     = $('#status_file_certificate_easa_'+ row_id);
        var empty_file     = $('#empty_file_certificate_easa_'+ row_id);
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_easa_'+row_id).val('');                                                                                                                                                                                   
    }); 
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_special,.file_req_general_certificate_special', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_special_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_special_'+ row_id);                      
        var status_file     = $('#status_file_certificate_special_'+ row_id);
        var empty_file     = $('#empty_file_certificate_special_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_special', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];       
        
        var progressbar     = $('#progressbar_certificate_special_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_special_'+ row_id);                      
        var status_file     = $('#status_file_certificate_special_'+ row_id);
        var empty_file      = $('#empty_file_certificate_special_'+ row_id);            
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_special_'+row_id).val('');                                                                                                                                                                                   
    });  
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_garuda,.file_req_general_certificate_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_garuda_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_garuda_'+ row_id);                      
        var status_file     = $('#status_file_certificate_garuda_'+ row_id);
        var empty_file     = $('#empty_file_certificate_garuda_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];       
        
        var progressbar     = $('#progressbar_certificate_garuda_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_garuda_'+ row_id);                      
        var status_file     = $('#status_file_certificate_garuda_'+ row_id);
        var empty_file     = $('#empty_file_certificate_garuda_'+ row_id);            
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_garuda_'+row_id).val('');                                                                                                                                                                                   
    });  
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_citilink,.file_req_general_certificate_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_citilink_'+ row_id);                      
        var status_file     = $('#status_file_certificate_citilink_'+ row_id);
        var empty_file     = $('#empty_file_certificate_citilink_'+ row_id);            
        
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
            // max reached?
            if (ctr==max){
            status_file.show(); 
            empty_file.show(); 
            clearInterval(timerId);
            status_file.attr('src',image_check);
            empty_file.attr('src',image_cross_check);
            }            
        }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];    
        
        
        var progressbar     = $('#progressbar_certificate_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_citilink_'+ row_id);                      
        var status_file     = $('#status_file_certificate_citilink_'+ row_id);
        var empty_file     = $('#empty_file_certificate_citilink_'+ row_id);            
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_citilink_'+row_id).val('');                                                                                                                                                                                   
    });   
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_sriwijaya,.file_req_general_certificate_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_certificate_sriwijaya_'+ row_id);
        var empty_file     = $('#empty_file_certificate_sriwijaya_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src',image_check);
        empty_file.attr('src',image_cross_check);
        }            
    }, 300);  
    }); 
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];       
        
        var progressbar     = $('#progressbar_certificate_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_certificate_sriwijaya_'+ row_id);
        var empty_file     = $('#empty_file_certificate_sriwijaya_'+ row_id);          
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_sriwijaya_'+row_id).val('');
    });  
    
    //cofc                                                                            
           
    if($('.date_training').val('')){
       $('.training_certificate_req').attr('disabled',true);
       var date_training = new Date();
       var day = ("0" + date_training.getDate()).slice(-2);
       var month = ("0" + (date_training.getMonth() + 1)).slice(-2);       
       $('.date_training').val((day)+'-'+(month)+'-'+date_training.getFullYear());            
    };
        $('.body_general_requirement').on('.focusout', '.expiration_date_req_general_document', function(e){
            var row_id = this.id;
            if($('.expiration_date_req_general_document').val != ''){        
            $('#file_req_document_general_' + row_id).attr('disabled',false);
            }else{
            $('#file_req_document_general_' + row_id).attr('disabled',true);
            };

        }); 
        
        $('.date_training_req_general_certificate').datepicker().on('click', function(e){
            var row_id = this.id;                                      
            $('#result_expiration_date_req_general_certificate_'+row_id).val('');
            $('#save_result_expiration_date_req_general_certificate_'+row_id).val(''); 
            $('#label_result_expiration_date_req_general_certificate_'+row_id).val('');
        });                
        
        $('.date_training_req_general_certificate').datepicker().on('changeDate', function(){
            var row_id = this.id;      
            var d = new Date();
            var day_now = d.getDate();
            var month_date_now = d.getMonth();
            var thn_date_now = d.getFullYear();
          if($('.date_training_req_general_certificate#'+row_id).val() != '') {
            var id_thn = $('.date_training_req_general_certificate#' + row_id).val();
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
            var row_id = this.id;                                      
            $('#result_expiration_date_req_spec_certificate_'+row_id).val('');
            $('#save_result_expiration_date_req_spec_certificate_'+row_id).val(''); 
            $('#label_result_expiration_date_req_spec_certificate_'+row_id).val('');
        });              
        
        $('.date_training_req_spec_certificate').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate#' + row_id).val(); 
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
            var row_id = this.id;                                      
            $('#result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val('');
            $('#save_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(''); 
            $('#label_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val('');
        });
        
        $('.date_training_req_spec_certificate_license_garuda').datepicker().on('changeDate', function(e){                 
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_license_garuda#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate_license_garuda#' + row_id).val(); 
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
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_license_citilink#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate_license_citilink#' + row_id).val(); 
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
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_license_sriwijaya#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate_license_sriwijaya#' + row_id).val(); 
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
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_easa#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate_easa#' + row_id).val(); 
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
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_special#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_special#' + row_id).val(); 
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
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_garuda#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_garuda#' + row_id).val(); 
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
                    $('#result_expiration_date_req_spec_certificate_garuda_'+row_id).val(rs_exp_date);                                                        
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
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_citilink#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_citilink#' + row_id).val(); 
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
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_sriwijaya#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_sriwijaya#' + row_id).val(); 
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