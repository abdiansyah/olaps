<?php if(@$data_assesment[0]!=''){ ?>
<div class="row">
<div class="col-md-10 col-md-offset-1 col-center-block table-responsive">
<div class="box box-info box-center" id="halaman5">    
    <div class="box-header with-border">
        <h3 class="box-title"><strong>SCHEDULE OF ASSESMENT</strong></h3>
    </div>
    <form method="POST" action="<?php echo site_url('assesment/save_assesment');?>">   
    <div class="box-body" id="sum-assesment-first">
            <div class="col-md-8">                                     
                <div class="box-body table-responsive no-padding">                    
                    <table id="detail_personnel" class="table">                    
                    <tbody>                     
                    <tr>                        
                        <td class="col-md-2">Name</td>                        
                        <td class="col-md-4">: <input type="hidden" name="request_number" value="<?php echo @$get_data_apply_personnel_by['request_number'];?>"/><input type="hidden" name="personnel_number" value="<?php echo @$get_data_emp_personnel_by['personnel_number'];?>"/><input type="hidden" name="name_applicant" value="<?php echo @$get_data_emp_personnel_by['name'];?>"/><?php echo @$get_data_emp_personnel_by['name'];?></td>                                               
                    </tr>                    
                    <tr>                        
                        <td class="col-md-2">Unit</td>                        
                        <td class="col-md-4">: <?php echo @$get_data_emp_personnel_by['departement'];?></td>                                                
                    </tr>
                    <tr>                        
                        <td class="col-md-2">Date Request</td>                        
                        <td class="col-md-4">: <?php echo date('d-M-Y',strtotime(@$data_assesment[0]->date_request));?></td>                                                
                    </tr>                                                                                               
                    </tbody>                     
                    </table>
                    <br/>               
                 </div>
            </div>                                    
            <div class="col-md-12">                        
                <div class="box-body table-responsive no-padding">                    
                    <table class="table table-bordered tab-schedule-assesment">                    
                    <thead>
                    <tr>                        
                        <th>No</th>
                        <th>Status</th>                                                                    
                        <th>Scope</th>  
                        <th>Date of Written Assesment</th>
                        <th>Time</th>
                        <th>Location</th>                                              
                    </tr>    
                    </thead>
                    <tbody>                                        
                    <?php
                    $no=1;                    
                    foreach ($data_assesment as $value):                    
                    ?> 
                    <tr>                       
                        <td><?php echo $no ?></td>                        
                        <td>
                        <input type="hidden" name="id_license[]" value="<?php echo $value->id_license;?>"/>
                        <input type="hidden" name="id_type[]" value="<?php echo $value->id_type;?>"/>
                        <input type="hidden" name="id_spect[]" value="<?php echo $value->id_spect;?>"/>
                        <input type="hidden" name="id_category[]" value="<?php echo $value->id_category;?>"/>
                        <input type="hidden" name="id_scope[]" value="<?php echo $value->id_scope;?>"/>
                        <?php
                        $status = @$data_assesment[0]->reason_apply_license;                          
                        switch ($status){
                            case 1 :
                                $reason_apply_license = 'New Authorization';
                                break;
                            case 2 :
                                $reason_apply_license = 'Renewal';
                                break;
                            case 3 :
                                $reason_apply_license = 'Additional';
                                break;
                            case 4 :
                                $reason_apply_license = 'Rating Change/ Upgrade';
                                break;
                        }
                        echo $reason_apply_license;
                        $is_etops = $data_assesment[0]->is_etops;
                        switch ($is_etops) {
                                case 1 :
                                $status_etops = ' + ETOPS';
                                break;
                                case 0 :
                                $status_etops = '';
                                break;                            }
                        ?>
                        </td>                    
                        <td><input type="hidden" name="id_assesment[]" value="<?php echo $value->id; ?>"/><?php echo $value->name_spect .' '.$value->name_category.' '.$value->name_scope.''.$status_etops; ?></td>
                        <td width="15%">
                        <?php 
                        if($value->date_written_assesment!='1970-01-01'){
                        ?>
                        <input type="hidden" name="date_written_assesment[]" id="date_written_assesment_<?php echo $no; ?>" value="<?php if($value->date_written_assesment){echo date('d-m-Y',strtotime($value->date_written_assesment));}?>"/>
                        <input type="text"  class="form-control date_written_assesment" value="<?php if($value->date_written_assesment){echo date('d-m-Y',strtotime($value->date_written_assesment));}?>"disabled/>
                        <?php
                        }
                        else
                        {
                        ?>
                        <input type="text" name="date_written_assesment[]" id="date_written_assesment_<?php echo $no; ?>" class="form-control date_written_assesment"/>
                        <?php
                        } 
                        ?>
                        </td>                        
                        <td width="10%">
                        <?php 
                        if($value->sesi_written_assesment!='') {
                        ?>
                            <input type="hidden" id="id_sesi_<?php echo $no; ?>" name="id_sesi[]" value="<?php echo $value->id_sesi_written_assesment;?>"/><input type="text" value="<?php echo $value->sesi_written_assesment; ?>" class="form-control id_sesi" disabled/>
                        <?php                        
                        } else {
                        ?>
                            <select id="id_sesi_<?php echo $no; ?>" name="id_sesi[]" class="form-control id_sesi"> 
                            <option value="" data-date-format="hh:ii"><a>00:00</a></option>                       
                            <option value="1" data-date-format="hh:ii"><a>09:00-11:00</a></option>
                            <option value="2" data-date-format="hh:ii"><a>13:00-15:00</a></option>
                            </select>  
                        <?php 
                        }
                        ?>                                                                                                          
                        </td>
                        <td width="20%">
                        <?php 
                        if ($value->room_written_assesment!='') {
                        ?>
                            <input type="hidden" name="id_room[]" value="<?php echo $value->id_room_written_assesment;?>" id="id_room_<?php echo $no;?>"/><input type="text" value="<?php echo $value->room_written_assesment; ?>" class="form-control" disabled/>
                        <?php 
                        } else {
                        ?>            
                            <select class="form-control id_room" id="id_room_<?php echo $no;?>" name="id_room[]" >
                            <option value="">--- Choose room ---</option>
                            <?php echo modules::run('assesment/assesment/get_all_room');?>
                            </select>                                                                                     
                        <?php
                        }
                        ?>                        
                        </td>                        
                    </tr>                                       
                    <?php
                    $no++;
                    endforeach;
                    ?>                                                                           
                    </tbody>                     
                    </table>
                </div>
            </div>
            <div class="box-footer col-md-12">
                <button type="button" class="btn btn-info pull-right btn-sm next-summary-assesment" name="next-summary-assesment"><strong>NEXT</strong></button>            
            </div>  
            </div> 
            <div class="box body col-md-12" id="summary-assesment">
            <div class="col-md-12"> 
            <h3>ANDA YAKIN DENGAN TANGGAL UJIAN YANG ANDA PILIH?</h3>
            <table class="table table-bordered">                 
            <thead>                                                                                                                        
                <th width="15%">Assesment</th>
                <th width="5%">Date</th>
                <th width="5%">Time</th>                                                                          
                <th width="5%">Room</th>         
            </thead>
            <tbody id="body-summary-assesment">
            </tbody>
            </table>                                            
            </div>            
            <div class="box-footer col-md-12">
                <button type="submit" class="btn btn-info pull-right btn-sm" name="submitassesmentevent"><strong>ACCEPT</strong></button>
                <button type="button" class="btn btn-warning pull-right btn-sm" name="previous"><strong>CANCEL</strong></button>
            </div>
            </div>  
            </form>                                       
    </div>
</div>
</div> 
<?php
}else{
$this->session->set_flashdata('quality_check_schedule', 'Waiting quality to check assesment schedule');
redirect('home/index'); 
};
echo bootstrap_datepicker();
echo jquery_bootstrap_timepicker();
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap-timepicker.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
$(function(){
    $('[name=previous]').click(function(){
       location.reload(); 
    });
    var seen = {};
    $('.tab-schedule-assesment .id_scope_assesment').each(function() {
        var txt = $(this).val();        
        if (seen[txt])
            $(this).closest('tr').remove();            
        else
            seen[txt] = true;
    });  
    
    $('#summary-assesment').hide();
    $('#sum-assesment-first').show();
    $('[name=submitapproved]').attr('disabled',true);
    $('[name=submitdisapproved]').attr('disabled',true);

    $('.date_written_assesment').datepicker(
        {format: 'dd-mm-yyyy'}           
    );

    $('.date_written_assesment').datepicker().on('changeDate', function(){
        $(this).datepicker('hide');
    });
    $('.tab-schedule-assesment').on('change', '.id_room', function(e){    
    var id = this.id;
    var data_id_sesi = id.split("_"); 
    var row_id_sesi = data_id_sesi[2]; 
    
    var date_written_assesment = $('#date_written_assesment_'+ row_id_sesi).val();
    var id_sesi = $('#id_sesi_'+ row_id_sesi).val();        
    var id_room = $('#id_room_'+ row_id_sesi).val(); 
    var request_number = $('[name=request_number]').val();
    var personnel_number = $('[name=personnel_number]').val();
        if(id_room!='') {    
            $.getJSON("<?php echo site_url();?>/assesment/cek_room/" + date_written_assesment + "/" + id_sesi + "/" + id_room , function(data) {    
                if(data.limit >= data.quota) {
                        $('[name=next-summary-assesment]').attr('disabled',true);
                        alert('Room for this session full.');

                    } else { 
                        $('[name=next-summary-assesment]').attr('disabled',false);
                    };
                });  
            $.getJSON("<?php echo site_url();?>/assesment/cek_blocked_room/" + date_written_assesment + "/" + id_room , function(data){
                if(data == '1'){
                    alert('This room was blocked.');
                    $('[name=next-summary-assesment]').attr('disabled',true);
                } else { 
                        $('[name=next-summary-assesment]').attr('disabled',false);
                };
            });
        }                     
       
    });
  
             
    $('[name=next-summary-assesment]').click(function(){        
    var n_sesi = $('.id_sesi').length;   
    var id_sesi = $("[name^='id_sesi']");
    var id_assesment = $("input[name^='id_assesment']");
    var id_room = $("[name^='id_room']");
    var id_date_written_assesment = $("input[name^='date_written_assesment']");
        for(i=0;i<n_sesi;i++){
            sesi = id_sesi[i].value;
            assesment = id_assesment[i].value;
            room = id_room[i].value;
            date_written_assesment = id_date_written_assesment[i].value;   
                    
            $.get("<?php echo site_url();?>/assesment/get_summary_assesment/" + sesi + "/" + assesment + "/" + room + "/" + date_written_assesment, function(data, status){                                    
                $('#body-summary-assesment').append(data);                                       
            });
        };
        $('#summary-assesment').show();
        $('#sum-assesment-first').hide();                                               
    });        
});
</script>   
            