<?php 
$y=1;
foreach($auth_sum_easa as $row): 
?>
    <tr id="data-easa-authorization">                                                          
        <td align="center"><?php echo $y++;?></td>                                               
        <td><?php echo $row->name_t;?></td>                                                                                            
        <td><?php echo $row->name_type;?></td> 
        <td><?php echo $row->name_spect;?></td> 
        <td><?php echo $row->name_category;?></td>         
        <td><?php echo $row->name_scope;?></td>
    </tr>
<?php                     
endforeach;
?>   
