<?php 
$z=1;
foreach($auth_sum_license as $row): 
?>
    <tr id="data-license-authorization">                                                                                                                
        <td align="center"><?php echo $z++;?></td>                                               
        <td><?php echo $row->name_t;?></td>                                                                                            
        <td><?php echo $row->name_type;?></td> 
        <td><?php echo $row->name_spect;?></td> 
        <td><?php echo $row->name_category;?></td> 
        <td><?php echo $row->name_scope;?></td>
    </tr>
<?php                     
endforeach;
?>   
