<form role="form" action="<?php echo site_url('apply_license/cekdataemail');?>">
    <table class="table table-bordered" id="tb-summary">
    <thead>
        <tr>
            <td align="center"><label>No</label></td>
            <td align="center"><label>Authorization Type</label></td>                                
            <td align="center"><label>Type</label></td> 
            <td align="center"><label>Ratting</label></td> 
            <td align="center"><label>Category</label></td> 
            <td align="center"><label>Scope of Authorization</label></td>                                                                                                                                                                                     
        </tr>
    </thead>                                    
    <tbody id="apply_license_information">   
    <?php 
    $i=1;
    foreach($cekdataemail as $row): 
    ?>
    <tr>                                                          
        <td align="center"><?php echo $i++;?></td>                                               
        <td><?php echo $row->name_license;?></td>                                           
        <td><?php echo $row->name_type;?></td>                                           
        <td><?php echo $row->name_spec;?></td>                                           
        <td><?php echo $row->name_category;?></td>                                           
        <td><?php echo $row->name_scope;?></td>                                           
        <td><input type="file" name="file_additional_specification[]"/></td>
    </tr>
    <?php                     
    endforeach;
    ?>       
    </tbody>                                            
    </table>  
</form>
         