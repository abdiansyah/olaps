<?php 
$no=1;
foreach($data_sum_assesment as $row): 
?>
    <tr>                                                                                                                 
        <td><input type="text" class="form-control" value="<?php echo $row->name_assesment_scope;?>" disabled/></td>
        <td><input type="text" class="form-control" value="<?php echo $row->date_written_assesment?>" disabled/></td>
        <td><input type="text" class="form-control" value="<?php echo $row->sesi;?>" disabled/></td>                                             
        <td><input type="text" class="form-control" value="<?php echo $row->name_room;?>" disabled/></td>         
    </tr>
<?php                     
endforeach;
?>   
