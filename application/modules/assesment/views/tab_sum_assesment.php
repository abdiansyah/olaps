<?php 
$no=1;
foreach($data_sum_assesment as $row): 
?>
    <tr>                                                                                                                 
        <td><?php echo $row->name_assesment_scope;?></td>
        <td><?php echo $row->date_written_assesment?></td>
        <td><?php echo $row->sesi;?></td>                                             
        <td><?php echo $row->name_room;?></td>         
    </tr>
<?php                     
endforeach;
?>   
