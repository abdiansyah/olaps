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
var jqxhr = $.getJSON(get_data_gmf + personnel_number_superior, function(data) {
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


    $('[name=submitchecklicense]').one('click', function(){
        var personnel_number = $(this).data('id');        
        $('#modal-loader').show(); 
        $('#datatables_basic').dataTable({        
        "searching"         : false,
        "ordering"          : false,  
        "select"            : true,      
        "bPaginate"         : false,
        "info"              : false,
        "scrollCollapse"    : true,
        "processing"        : true, //Feature control the processing indicator.
        "serverSide"        : true, //Feature control DataTables' server-side processing mode.
        "order"             : [], //Initial no order. 
        "bSort"             : false,               

        // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_basic_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });

        
        $('#datatables_ame').dataTable({        
        "searching"         : false,
        "ordering"          : false,  
        "select"            : true,      
        "bPaginate"         : false,
        "info"              : false,
        "scrollCollapse"    : true,
        "processing"        : true, //Feature control the processing indicator.
        "serverSide"        : true, //Feature control DataTables' server-side processing mode.
        "order"             : [], //Initial no order. 
        "bSort"             : false,               
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            var d               = new Date();
            var day_now         = d.getDate();
            var month_date_now  = d.getMonth();
            var thn_date_now    = d.getFullYear();
            var data_validity   = aData[2].split("-");
            var date_exp        = new Date(data_validity[2], data_validity[1], data_validity[0]);
            var date_now        = new Date(thn_date_now, month_date_now, day_now);                                          
            var miliday         = 24 * 60 * 60 * 1000;
            var selisih         = (date_exp-date_now)/ miliday;            
                $('#validity_ame').html(aData[2]);                                                                        
                if (selisih > 0 ) {
                    $('#status_days_ame').html(selisih);                                                        
                    $('#status_ame').html('&nbsp;days before expired');                                                        
                } else if (selisih < 15 && selisih > 0) {
                    $('#status_days_ame').html(selisih).css('color','red');                
                    $('#status_ame').html('&nbsp;days before expired').css('color','red');                
                } else if (selisih == 0) {
                    $('#status_days_ame').html(selisih).css('color','red');                
                    $('#status_ame').html('&nbsp;Today your license will expired').css('color','red');                
                } else if (selisih < 0) {
                    $('#status_days_ame').html(selisih).css('color','red');                
                    $('#status_days_ame').html('&nbsp;Your license expired').css('color','red');                
                }
            }, 
        // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_ame_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });


        $('#datatables_cs').dataTable({        
        "searching"         : false,
        "ordering"          : false,  
        "select"            : true,      
        "bPaginate"         : false,
        "info"              : false,
        "scrollCollapse"    : true,
        "processing"        : true, //Feature control the processing indicator.
        "serverSide"        : true, //Feature control DataTables' server-side processing mode.
        "order"             : [], //Initial no order. 
        "bSort"             : false,   
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                                                            
            var d               = new Date();
            var day_now         = d.getDate();
            var month_date_now  = d.getMonth();
            var thn_date_now    = d.getFullYear();
            var data_validity   = aData[2].split("-");
            var date_exp        = new Date(data_validity[2], parseInt(data_validity[1])+2, data_validity[0]);
            var date_now        = new Date(thn_date_now, parseInt(month_date_now)+3, day_now);                                          
            var miliday         = 24 * 60 * 60 * 1000;
            var selisih         = (date_exp-date_now)/ miliday;            
                $('#validity_cs').html(aData[2]);                                                                        
                if (selisih > 0 ) {
                    $('#status_days_cs').html(selisih);                                                        
                    $('#status_cs').html('&nbsp;days before expired');                                                        
                } else if (selisih < 15 && selisih > 0) {
                    $('#status_days_cs').html(selisih).css('color','red');                
                    $('#status_cs').html('&nbsp;days before expired').css('color','red');                
                } else if (selisih == 0) {
                    $('#status_days_cs').html(selisih).css('color','red');                
                    $('#status_cs').html('&nbsp;Today your license will expired').css('color','red');                
                } else if (selisih < 0) {
                    $('#status_days_cs').html(selisih).css('color','red');                
                    $('#status_cs').html('&nbsp;Your license expired').css('color','red');                
                }
            }, 


        // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_cs_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });

        $('#datatables_gmf').dataTable({        
        "searching"         : false,
        "ordering"          : false,  
        "select"            : true,      
        "bPaginate"         : false,
        "info"              : false,
        "scrollCollapse"    : true,
        "processing"        : true, //Feature control the processing indicator.
        "serverSide"        : true, //Feature control DataTables' server-side processing mode.
        "order"             : [], //Initial no order. 
        "bSort"             : false,
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                                                            
            var d               = new Date();
            var day_now         = d.getDate();
            var month_date_now  = d.getMonth();
            var thn_date_now    = d.getFullYear();
            var data_validity   = aData[2].split("-");
            var date_exp        = new Date(data_validity[2], parseInt(data_validity[1])+2, data_validity[0]);
            var date_now        = new Date(thn_date_now, parseInt(month_date_now)+3, day_now);                                          
            var miliday         = 24 * 60 * 60 * 1000;
            var selisih         = (date_exp-date_now)/ miliday;            
                $('#validity_gmf').html(aData[2]);                                                                        
                if (selisih > 0 ) {
                    $('#status_days_gmf').html(selisih);                                                        
                    $('#status_gmf').html('&nbsp;days before expired');                                                        
                } else if (selisih < 15 && selisih > 0) {
                    $('#status_days_gmf').html(selisih).css('color','red');                
                    $('#status_gmf').html('&nbsp;days before expired').css('color','red');                
                } else if (selisih == 0) {
                    $('#status_days_gmf').html(selisih).css('color','red');                
                    $('#status_citilink').html('&nbsp;Today your license will expired').css('color','red');                
                } else if (selisih < 0) {                    
                    $('#status_gmf').html('&nbsp;Your license expired').css('color','red');                
                }
            },                                

        // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_gmf_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });

        $('#datatables_ga').dataTable({        
        "searching"         : false,
        "ordering"          : false,  
        "select"            : true,      
        "bPaginate"         : false,
        "info"              : false,
        "scrollCollapse"    : true,
        "processing"        : true, //Feature control the processing indicator.
        "serverSide"        : true, //Feature control DataTables' server-side processing mode.
        "order"             : [], //Initial no order. 
        "bSort"             : false,
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                                                            
            var d               = new Date();
            var day_now         = d.getDate();
            var month_date_now  = d.getMonth();
            var thn_date_now    = d.getFullYear();
            var data_validity   = aData[2].split("-");
            var date_exp        = new Date(data_validity[2], parseInt(data_validity[1])+2, data_validity[0]);
            var date_now        = new Date(thn_date_now, parseInt(month_date_now)+3, day_now);                                          
            var miliday         = 24 * 60 * 60 * 1000;
            var selisih         = (date_exp-date_now)/ miliday;            
                $('#validity_ga').html(aData[2]);                                                                        
                if (selisih > 0 ) {
                    $('#status_days_ga').html(selisih);                                                        
                    $('#status_ga').html('&nbsp;days before expired');                                                        
                } else if (selisih < 15 && selisih > 0) {
                    $('#status_days_ga').html(selisih).css('color','red');                
                    $('#status_ga').html('&nbsp;days before expired').css('color','red');                
                } else if (selisih == 0) {
                    $('#status_days_ga').html(selisih).css('color','red');                
                    $('#status_ga').html('&nbsp;Today your license will expired').css('color','red');                
                } else if (selisih < 0) {                    
                    $('#status_ga').html('&nbsp;Your license expired').css('color','red');                
                }
            },                

        // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_ga_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });

        $('#datatables_citilink').dataTable({        
        "searching"         : false,
        "ordering"          : false,  
        "select"            : true,      
        "bPaginate"         : false,
        "info"              : false,
        "scrollCollapse"    : true,
        "processing"        : true, //Feature control the processing indicator.
        "serverSide"        : true, //Feature control DataTables' server-side processing mode.
        "order"             : [], //Initial no order. 
        "bSort"             : false,
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                                                            
            var d               = new Date();
            var day_now         = d.getDate();
            var month_date_now  = d.getMonth();
            var thn_date_now    = d.getFullYear();
            var data_validity   = aData[2].split("-");
            var date_exp        = new Date(data_validity[2], parseInt(data_validity[1])+2, data_validity[0]);
            var date_now        = new Date(thn_date_now, parseInt(month_date_now)+3, day_now);                                          
            var miliday         = 24 * 60 * 60 * 1000;
            var selisih         = (date_exp-date_now)/ miliday;            
                $('#validity_citilink').html(aData[2]);                                                                        
                if (selisih > 0 ) {
                    $('#status_days_citilink').html(selisih);                                                        
                    $('#status_citilink').html('&nbsp;days before expired');                                                        
                } else if (selisih < 15 && selisih > 0) {
                    $('#status_days_citilink').html(selisih).css('color','red');                
                    $('#status_citilink').html('&nbsp;days before expired').css('color','red');                
                } else if (selisih == 0) {
                    $('#status_days_citilink').html(selisih).css('color','red');                
                    $('#status_citilink').html('&nbsp;Today your license will expired').css('color','red');                
                } else if (selisih < 0) {                    
                    $('#status_citilink').html('&nbsp;Your license expired').css('color','red');                
                }
            },                 

        // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_citilink_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });

        $('#datatables_sriwijaya').dataTable({        
        "searching"         : false,
        "ordering"          : false,  
        "select"            : true,      
        "bPaginate"         : false,
        "info"              : false,
        "scrollCollapse"    : true,
        "processing"        : true, //Feature control the processing indicator.
        "serverSide"        : true, //Feature control DataTables' server-side processing mode.
        "order"             : [], //Initial no order. 
        "bSort"             : false,
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                                                            
            var d               = new Date();
            var day_now         = d.getDate();
            var month_date_now  = d.getMonth();
            var thn_date_now    = d.getFullYear();
            var data_validity   = aData[2].split("-");
            var date_exp        = new Date(data_validity[2], parseInt(data_validity[1])+2, data_validity[0]);
            var date_now        = new Date(thn_date_now, parseInt(month_date_now)+3, day_now);                                          
            var miliday         = 24 * 60 * 60 * 1000;
            var selisih         = (date_exp-date_now)/ miliday;            
                $('#validity_sriwijaya').html(aData[2]);                                                                        
                if (selisih > 0 ) {
                    $('#status_days_sriwijaya').html(selisih);                                                        
                    $('#status_sriwijaya').html('&nbsp;days before expired');                                                        
                } else if (selisih < 15 && selisih > 0) {
                    $('#status_days_sriwijaya').html(selisih).css('color','red');                
                    $('#status_sriwijaya').html('&nbsp;days before expired').css('color','red');                
                } else if (selisih == 0) {
                    $('#status_days_sriwijaya').html(selisih).css('color','red');                
                    $('#status_sriwijaya').html('&nbsp;Today your license will expired').css('color','red');                
                } else if (selisih < 0) {                    
                    $('#status_sriwijaya').html('&nbsp;Your license expired').css('color','red');                
                }
            },                 

        // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_sriwijaya_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });

        $('#datatables_easa').dataTable({        
        "searching"         : false,
        "ordering"          : false,  
        "select"            : true,      
        "bPaginate"         : false,
        "info"              : false,
        "scrollCollapse"    : true,
        "processing"        : true, //Feature control the processing indicator.
        "serverSide"        : true, //Feature control DataTables' server-side processing mode.
        "order"             : [], //Initial no order. 
        "bSort"             : false,
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                                                            
            var d               = new Date();
            var day_now         = d.getDate();
            var month_date_now  = d.getMonth();
            var thn_date_now    = d.getFullYear();
            var data_validity   = aData[2].split("-");
            var date_exp        = new Date(data_validity[2], parseInt(data_validity[1])+2, data_validity[0]);
            var date_now        = new Date(thn_date_now, parseInt(month_date_now)+3, day_now);                                          
            var miliday         = 24 * 60 * 60 * 1000;
            var selisih         = (date_exp-date_now)/ miliday;            
                $('#validity_easa').html(aData[2]);                                                                        
                if (selisih > 0 ) {
                    $('#status_days_easa').html(selisih);                                                        
                    $('#status_easa').html('&nbsp;days before expired');                                                        
                } else if (selisih < 15 && selisih > 0) {
                    $('#status_days_easa').html(selisih).css('color','red');                
                    $('#status_easa').html('&nbsp;days before expired').css('color','red');                
                } else if (selisih == 0) {
                    $('#status_days_easa').html(selisih).css('color','red');                
                    $('#status_easa').html('&nbsp;Today your license will expired').css('color','red');                
                } else if (selisih < 0) {                    
                    $('#status_easa').html('&nbsp;Your license expired').css('color','red');                
                }
            },                

        // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_easa_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });

        $('#datatables_cofc').dataTable({        
            "searching"         : false,
            "ordering"          : false,  
            "select"            : true,      
            "bPaginate"         : false,
            "info"              : false,
            "scrollCollapse"    : true,
            "processing"        : true, //Feature control the processing indicator.
            "serverSide"        : true, //Feature control DataTables' server-side processing mode.
            "order"             : [], //Initial no order. 
            "bSort"             : false,  
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                                                            
            var d               = new Date();
            var day_now         = d.getDate();
            var month_date_now  = d.getMonth();
            var thn_date_now    = d.getFullYear();
            var data_validity   = aData[3].split("-");
            var date_exp        = new Date(data_validity[2], parseInt(data_validity[1])+2, data_validity[0]);
            var date_now        = new Date(thn_date_now, parseInt(month_date_now)+3, day_now);                                          
            var miliday         = 24 * 60 * 60 * 1000;
            var selisih         = (date_exp-date_now)/ miliday;                            
                if (selisih > 0 ) {
                    $('#status_days_cofc').html(selisih);                                                        
                    $('#status_cofc').html('&nbsp;days before expired');                                                        
                } else if (selisih < 15 && selisih > 0) {
                    $('#status_days_cofc').html(selisih).css('color','red');                
                    $('#status_cofc').html('&nbsp;days before expired').css('color','red');                
                } else if (selisih == 0) {
                    $('#status_days_cofc').html(selisih).css('color','red');                
                    $('#status_cofc').html('&nbsp;Today your license will expired').css('color','red');                
                } else if (selisih < 0) {
                    $('#status_days_cofc').html(selisih).css('color','red');                
                    $('#status_days_cofc').html('&nbsp;Your license expired').css('color','red');                
                }
            $('#no_stamp').html(aData[4]);
            $('#validity_cofc').html(aData[3]);
            }, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url"   : get_data_cofc_license,
                "type"  : "POST",
                "data"  : {
                    personnel_number : personnel_number
                }
            },

            //Set column definition initialisation properties.
            "columnDefs" : [
                {                 
                    "targets"   : [], //first column / numbering column
                    "orderable" : false, //set not orderable                            
                },
            ],
        });

        $('#modal-loader').hide(); 

    });