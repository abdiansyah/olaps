<?php if($p_sub_status =='1') : ?>
<optgroup label="Date Submited">
<option value="">Date Submited</option>
<?php endif; 
if($p_sub_status =='2') : ?>            
<optgroup label="Superior Approval">
<option value="1" <?php if($validaty_status->current_status != 'Data Submited') { echo "disabled";}?>>Approved by Superior</option>
<option value="2" <?php if($validaty_status->current_status != 'Data Submited') { echo "disabled";}?>>Rejected by Superior</option>
<?php endif; 
if($p_sub_status =='3') : ?> 
<optgroup label="Data Validation">
<option value="3" <?php if($validaty_status->current_status != 'Approved Superior') { echo "disabled";}?>>Data Valid</option>
<option value="4" <?php if($validaty_status->current_status != 'Approved Superior') { echo "disabled";}?>>Data Not Valid</option>
<?php endif; 
if($p_sub_status =='4') : ?>             
<optgroup label="Assessment Process">
<option value="5" <?php if($validaty_status->current_status != 'Data Validated') { echo "disabled";}?>>Written Assesment Schedule</option>
<option value="17" <?php if($validaty_status->current_status != 'Data Validated') { echo "disabled";}?>>Oral Assessment Schedule</option>
<option value="18" <?php if($validaty_status->current_status != 'Data Validated') { echo "disabled";}?>>Practical Assessment Schedule</option>
<option value="6" <?php if($validaty_status->current_status != 'Data Validated') { echo "disabled";}?>>Issue Assessment Verification</option>                  
<option value="7" <?php if($validaty_status->current_status != 'Data Validated') { echo "disabled";}?>>Assessment Process Closed</option>
<?php endif; 
if($p_sub_status =='5') : ?>             
<optgroup label="Issue Authorization">
<option value="8" <?php if($validaty_status->current_status != 'Assesment Process Closed') { echo "disabled";}?>>GMF Authorization Issued</option>
<option value="9" <?php if($validaty_status->current_status != 'Assesment Process Closed') { echo "disabled";}?>>C of C and/or Stamp Issued</option>
<option value="10" <?php if($validaty_status->current_status != 'Assesment Process Closed') { echo "disabled";}?>>EASA Authorization Issued</option>
<option value="11" <?php if($validaty_status->current_status != 'Assesment Process Closed') { echo "disabled";}?>>GA Authorization Issued</option>
<option value="12" <?php if($validaty_status->current_status != 'Assesment Process Closed') { echo "disabled";}?>>Citilink Authorization Issued</option>
<option value="13" <?php if($validaty_status->current_status != 'Assesment Process Closed') { echo "disabled";}?>>Sriwijaya Authorization Issued</option>
<option value="14" <?php if($validaty_status->current_status != 'Assesment Process Closed') { echo "disabled";}?>>Issue Authorization Finished</option>
<?php endif; 
if($p_sub_status =='6') : ?>            
<optgroup label="Take Authorization">
<option value="18" <?php if($validaty_status->current_status != 'Issue Authorization Finished') { echo "disabled";}?>>Referral of authorization </option>
<option value="15" <?php if($validaty_status->current_status != 'Referral Authorization') { echo "disabled";}?>>Personnel Record Completed</option>
<?php endif; ?>