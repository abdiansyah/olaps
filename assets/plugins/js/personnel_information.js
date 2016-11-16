var cari_personnel = function() {
$('[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone],[name=validitycontract],[name=id_personnel_superior],[name=name_superior],[name=jobtitle_superior],[name=email_superior]').val('');                               
var typeemp = $('[name=typeemp]:radio:checked').val();
var personnel_number = $('[name=personnel_number]').val();
if (typeemp == 1 || typeemp == null) {           
var jqxhr = $.getJSON( get_data_gmf + personnel_number, function(data) {
    $('[name=name]').val(data.EMPLNAME);                
    $('[name=presenttitle]').val(data.JOBTITLE);
    $('[name=departement]').val(data.UNIT);
    $('[name=email]').val(data.EMAIL);
    $('[name=dateofbirth]').val(data.BORNDATE); 
    $('[name=dateofemployee]').val(data.EMPLODATE);
    $('[name=formaleducation]').val(data.LASTEDUCDESC);
    $('[name=mobilephone]').val(data.mobilephone);
    $('[name=businessphone]').val(data.businessphone); 
    if(data.WORKUNTILDATE == '31-12-9999'){       
        var now = new Date(); 
        var work = (data.WORKUNTILDATE).split("-");
        var d = work[0];
        var m = work[1];
        var y = work[2]; 
        var date_work = new Date(y+'-'+m+'-'+d);                       
        if(date_work > now){                
           $('[name=submitpersonnelinformation]').attr('disabled',false);                
        };                                                         
        $('[name=validitycontract]').attr('disabled',true);
        $('[name=submitpersonnelinformation]').attr('disabled',false);
    };
    if(data.WORKUNTILDATE != '31-12-9999'){
        var now = new Date();
        var work = (data.WORKUNTILDATE).split("-");
        var d = work[0];
        var m = work[1];
        var y = work[2]; 
        var date_work = new Date(y+'-'+m+'-'+d);            
        if(date_work > now || date_work == '31-12-9999'){                
           $('[name=submitpersonnelinformation]').attr('disabled',false);                
        };                            
        if(date_work < now !== '31-12-9999'){                
           $('[name=submitpersonnelinformation]').attr('disabled',true);
           alert('You retired'); 
        };    
        $('[name=validitycontract]').attr('disabled',false);
        $('[name=validitycontract]').val(data.WORKUNTILDATE);                
        };
        
        $('[name=personnel_number_superior]').val(data.REPORT_TO);
    }); 
    jqxhr.complete(function(){
       console.log("send data complete");
       $('#msg').hide(); 
    $('[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=personnel_number_superior],[name=name_superior],[name=jobtitle_superior],[name=email_superior]').prop("readonly", true);        
    });                     
};
if (typeemp == 2 || typeemp == null) {
    var jqxhr = $.getJSON( get_data_non_gmf + personnel_number, function(data) {                
    $('[name=name]').val(data.EMPLNAME);                
    $('[name=presenttitle]').val(data.JOBTITLE);
    $('[name=departement]').val(data.UNIT);
    $('[name=email]').val(data.EMAIL);
    $('[name=dateofbirth]').val(data.BORNDATE); 
    $('[name=dateofemployee]').val(data.EMPLODATE);
    $('[name=formaleducation]').val(data.LASTEDUCDESC);
    $('[name=mobilephone]').val(data.mobilephone);
    $('[name=businessphone]').val(data.businessphone); 
    if(data.WORKUNTILDATE == '31-12-9999'){       
        var now = new Date(); 
        var work = (data.WORKUNTILDATE).split("-");
        var d = work[0];
        var m = work[1];
        var y = work[2]; 
        var date_work = new Date(y+'-'+m+'-'+d);                       
        if(date_work > now){                
           $('[name=submitpersonnelinformation]').attr('disabled',false);                
        };                                                         
        $('[name=validitycontract]').attr('disabled',true);
        $('[name=submitpersonnelinformation]').attr('disabled',false);
    };
    if(data.WORKUNTILDATE != '31-12-9999'){
        var now = new Date();
        var work = (data.WORKUNTILDATE).split("-");
        var d = work[0];
        var m = work[1];
        var y = work[2]; 
        var date_work = new Date(y+'-'+m+'-'+d);
        if(date_work > now){                
           $('[name=submitpersonnelinformation]').attr('disabled',false);                
        };                            
        if(date_work < now){                
           $('[name=submitpersonnelinformation]').attr('disabled',true);
           alert('You retired'); 
        };    
        $('[name=validitycontract]').attr('disabled',false);
        $('[name=validitycontract]').val(data.WORKUNTILDATE);                
        };
        
        $('[name=personnel_number_superior]').val(data.REPORT_TO);            
    }); 
    jqxhr.complete(function(){
       console.log("send data complete");
       $('#msg').hide();        
    });
    $('[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=personnel_number_superior]').prop("readonly", false);                
}; 
    if ($('[name=name]').val()=='' || $('[name=typeemp]').val()=='') {
        $('#msg').show();
    };  
};
$( window ).load(function() {
    cari_personnel();                  
});
$('[name=businessphone],[name=mobilephone]').keyup(function()
    {
        this.value = this.value.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "$1-$2-$3");
    });
$('#msg,.data-superior').hide();
        
$('[name=dateofbirth],[name=dateofemployee],[name=validitycontract]').datepicker({
    format : 'dd-mm-yyyy'
    }); 

$('[name=dateofbirth],[name=dateofemployee],[name=validitycontract]').datepicker().on('changeDate', function(e){        
        $(this).datepicker('hide');
    });
    
     
$('[name=personnel_number]').on('keyup',function() {
    cari_personnel();
});

$('[name=cari_id]').on('click',function() {
    cari_personnel();
});

$('[name=cari_id_emp_gmf]').click(function(){
$('[name=name_superior],[name=jobtitle_superior],[name=email_superior]').val('');                               
var personnel_number_superior = $('[name=personnel_number_superior]').val();  
var jqxhr = $.getJSON("" + personnel_number_superior, function(data) {
        $('[name=name_superior]').val(data.EMPLNAME);                
        $('[name=jobtitle_superior]').val(data.JOBTITLE);
        $('[name=email_superior]').val(data.EMAIL);        
    });
    jqxhr.complete(function(){
       console.log("send data complete");       
    });
    $('.data-superior').show();      
});


$('#nongmfemp, #gmfemp').change(function() {      
    if ($('#gmfemp').is(':checked')) {                
        $('input[name=validitycontract]').hide(); 
        $('div#fieldgmfemp').show('slow');
        $('div#fieldnongmfemp').hide();   
        $('div.personnel_information_form').show('fast');                                    
        $('[name=name],[name=presenttitle]').attr('readonly',true);           
        $('[name=validitycontract],[name=id_personnel_superior],[name=email_superior]').prop('required',false); 
        $('[name=personnelnumber],[name=mobilephone],[name=businessphone]').prop('required',true);  
        $('[name=personnelnumber],[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone],[name=personnel_number_superior],[name=name_superior],[name=jobtitle_superior],[name=email_superior]').val('');                       
        $('[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation]').prop("readonly", true);          
    } else if ($('#nongmfemp').is(':checked')){
        $('input[name=validitycontract]').show(); 
        $('div#fieldnongmfemp').show('slow'); 
        $('div#fieldgmfemp').hide();          
        $('[name=validitycontract]').attr('disabled',false);      
        $('div.personnel_information_form').show('fast');        
        $('[name=personnelnumber],[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone]').attr('readonly',false);                           
        $('[name=personnelnumber],[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone],[name=validitycontract],[name=id_personnel_superior],[name=email_superior]').prop('required',true);                                                 
        $('[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone],[name=validitycontract],[name=personnel_number_superior],[name=name_superior],[name=jobtitle_superior],[name=email_superior]').val('');                
    }
});    