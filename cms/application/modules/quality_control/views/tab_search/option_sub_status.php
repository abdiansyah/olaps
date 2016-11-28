<?php if($p_sub_status =='1') : ?>
<optgroup label="Date Submited">
<option value="">Date Submited</option>
<?php endif; 
if($p_sub_status =='2') : ?>            
<optgroup label="Superior Approval">
<option value="1">Approved by Superior</option>
<option value="2">Rejected by Superior</option>
<?php endif; 
if($p_sub_status =='3') : ?> 
<optgroup label="Data Validation">
<option value="3">Data Valid</option>
<option value="4">Data Not Valid</option>
<?php endif; 
if($p_sub_status =='4') : ?>             
<optgroup label="Assessment Process">
<option value="5">Written Assesment Schedule</option>
<option value="17">Oral Assessment Schedule</option>
<option value="19">Practical Assessment Schedule</option>
<option value="6">Issue Assessment Verification</option>                  
<option value="7">Assessment Process Closed</option>
<?php endif; 
if($p_sub_status =='5') : ?>             
<optgroup label="Issue Authorization">
<option value="8">GMF Authorization Issued</option>
<option value="9">C of C and/or Stamp Issued</option>
<option value="10">EASA Authorization Issued</option>
<option value="11">GA Authorization Issued</option>
<option value="12">Citilink Authorization Issued</option>
<option value="13">Sriwijaya Authorization Issued</option>
<option value="14">Issue Authorization Finished</option>
<?php endif; 
if($p_sub_status =='6') : ?>            
<optgroup label="Take Authorization">
<option value="18">Referral of authorization </option>
<option value="15">Personnel Record Completed</option>
<?php endif; ?>