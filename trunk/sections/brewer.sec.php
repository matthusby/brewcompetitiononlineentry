
<?php
if ($section != "step7") {
mysql_select_db($database, $brewing);
$query_brewerID = sprintf("SELECT * FROM brewer WHERE id = '%s'", $filter); 
$brewerID = mysql_query($query_brewerID, $brewing) or die(mysql_error());
$row_brewerID = mysql_fetch_assoc($brewerID);
$totalRows_brewerID = mysql_num_rows($brewerID);
} 
if ($section == "step7")  {
$query_brewerID = sprintf("SELECT * FROM users WHERE user_name = '%s'", $go); 
$brewerID = mysql_query($query_brewerID, $brewing) or die(mysql_error());
$row_brewerID = mysql_fetch_assoc($brewerID);
$totalRows_brewerID = mysql_num_rows($brewerID);
}
if ($msg != "default") echo $msg_output; 
if (($section == "step7") || ($action == "add") || (($action == "edit") && (($_SESSION["loginUsername"] == $row_brewer['brewerEmail'])) || ($row_user['userLevel'] == "1")))  { ?>
<?php if ($section == "step7") { ?>
<form action="includes/process.inc.php?section=setup&amp;action=add&amp;dbTable=brewer" method="POST" name="form1" id="form1" onSubmit="return CheckRequiredFields()">
<input name="brewerSteward" type="hidden" value="N" />
<input name="brewerJudge" type="hidden" value="N" />
<input name="brewerEmail" type="hidden" value="<?php echo $go; ?>" />
<input name="uid" type="hidden" value="<?php echo $row_brewerID['id']; ?>" />
<?php } else { ?>
<form action="includes/process.inc.php?section=<?php if ($go == "entrant") echo "list"; elseif ($go == "judge") echo "judge"; else echo "admin&amp;go=".$go."&amp;filter=".$filter; ?>&amp;action=<?php echo $action; ?>&amp;dbTable=brewer&amp;go=<?php echo $go; if ($action == "edit") echo "&amp;id=".$row_brewer['id']; ?>" method="POST" name="form1" id="form1" onSubmit="return CheckRequiredFields()">
<?php } ?>
<div class="info">The information here beyond your first name, last name, and club is strictly for record-keeping and contact purposes. A condition of entry into the competition is providing this information. Your name and club may be displayed should one of your entries place, but no other information will be made public.</div>
<table class="dataTable">
<tr>
      <td class="dataLabel" width="5%">First Name:</td>
      <td class="data" width="20%"><input type="text" id="brewerFirstName" name="brewerFirstName" value="<?php if ($action == "edit") echo $row_brewer['brewerFirstName']; ?>" size="32" maxlength="20"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Last Name:</td>
      <td class="data"><input type="text" name="brewerLastName" value="<?php if ($action == "edit") echo $row_brewer['brewerLastName']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Street Address:</td>
      <td class="data"><input type="text" name="brewerAddress" value="<?php if ($action == "edit") echo $row_brewer['brewerAddress']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">City:</td>
      <td class="data"><input type="text" name="brewerCity" value="<?php if ($action == "edit") echo $row_brewer['brewerCity']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">State/Country:</td>
      <td class="data"><input type="text" name="brewerState" value="<?php if ($action == "edit") echo $row_brewer['brewerState']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Zip/Postal Code:</td>
      <td class="data"><input type="text" name="brewerZip" value="<?php if ($action == "edit") echo $row_brewer['brewerZip']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Phone 1:</td>
      <td class="data"><input type="text" name="brewerPhone1" value="<?php if ($action == "edit") echo $row_brewer['brewerPhone1']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Phone 2:</td>
      <td class="data"><input type="text" name="brewerPhone2" value="<?php if ($action == "edit") echo $row_brewer['brewerPhone2']; ?>" size="32"></td>
      <td class="data">&nbsp;</td>
</tr>
<tr>
      <td class="dataLabel">Club Name:</td>
      <td class="data"><input type="text" name="brewerClubs" value="<?php if ($action == "edit") echo $row_brewer['brewerClubs']; ?>" size="32" maxlength="200"></td>
      <td class="data">&nbsp;</td>
</tr>


<?php if (($go != "entrant") && ($section != "step7")) { ?>
<tr>
      <td class="dataLabel">Stewarding:</td>
      <td class="data">Are you willing be a steward in this competition?</td>
      <td class="data"><input type="radio" name="brewerSteward" value="Y" id="brewerSteward_0"  <?php if (($action == "add") && ($go == "judge")) echo "CHECKED"; if (($action == "edit") && ($row_brewer['brewerSteward'] == "Y")) echo "CHECKED"; ?> /> Yes<br /><input type="radio" name="brewerSteward" value="N" id="brewerSteward_1" <?php if (($action == "add") && ($go == "default")) echo "CHECKED"; if (($action == "edit") && ($row_brewer['brewerSteward'] == "N")) echo "CHECKED"; ?>/> No</td>
</tr>
<?php if ($totalRows_judging > 1) { ?>
<tr>
<td class="dataLabel">Rank Your Stewarding<br />Location Preferences:</td>
<td colspan="2" class="data">
<?php do { ?>
	<table class="dataTableCompact">
    	<tr>
        	<td width="1%" nowrap="nowrap">
                <select name="brewerStewardLocation[]">
				<option value="0-0" <?php if (($action == "edit") && ($row_brewer['brewerStewardLocation'] == "0-0")) echo "SELECTED"; ?>>No Preference</option>
				<?php for ($i = 1; $i <= $totalRows_stewarding; $i++) { ?>
				<option value="<?php echo $i."-".$row_stewarding['id']; ?>" <?php $a = explode(",", $row_brewer['brewerStewardLocation']); $b = $i."-".$row_stewarding['id']; foreach ($a as $value) { if ($value == $b) { echo "SELECTED"; } } ?>><?php echo $i; ?></option>
				<?php } ?>
				</select>
            </td>
            <td class="data"><?php echo $row_stewarding['judgingLocName']." ("; echo dateconvert($row_stewarding['judgingDate'], 3).")"; ?></td>
        </tr>
    </table>
<?php }  while ($row_stewarding = mysql_fetch_assoc($stewarding)); ?>
</td>
</tr>
<?php } ?>
<tr>
      <td class="dataLabel">Judging:</td>
      <td class="data">Are you willing and qualified to judge in this competition?</td>
      <td class="data"><input type="radio" name="brewerJudge" value="Y" id="brewerJudge_0"  <?php if (($action == "add") && ($go == "judge")) echo "CHECKED"; if (($action == "edit") && ($row_brewer['brewerJudge'] == "Y")) echo "CHECKED"; ?> /> Yes<br /><input type="radio" name="brewerJudge" value="N" id="brewerJudge_1" <?php if (($action == "add") && ($go == "default")) echo "CHECKED"; if (($action == "edit") && ($row_brewer['brewerJudge'] == "N")) echo "CHECKED"; ?>/> No</td>
</tr>
<?php if ($totalRows_judging > 1) { ?>
<tr>
<td class="dataLabel">Rank Your Judging<br />Location Preferences:</td>
<td class="data" colspan="2">
<?php do { ?>
	<table class="dataTableCompact">
    	<tr>
        	<td width="1%" nowrap="nowrap">
            <select name="brewerJudgeLocation[]">
				<option value="0-0" <?php if (($action == "edit") && ($row_brewer['brewerJudgeLocation'] == "0-0")) echo "SELECTED"; ?>>No Preference</option>
				<?php for ($i = 1; $i <= $totalRows_judging3; $i++) { ?>
				<option value="<?php echo $i."-".$row_judging3['id']; ?>"   <?php $a = explode(",", $row_brewer['brewerJudgeLocation']); $b = $i."-".$row_judging3['id']; foreach ($a as $value) { if ($value == $b) { echo "SELECTED"; } } ?>><?php echo $i; ?></option>
				<?php } ?>
				</select>
            </td>
            <td class="data"><?php echo $row_judging3['judgingLocName']." ("; echo dateconvert($row_judging3['judgingDate'], 3).")"; ?></td>
        </tr>
    </table>
<?php }  while ($row_judging3 = mysql_fetch_assoc($judging3)); ?>
</td>
</tr>
<?php } ?>
<?php } ?>
<?php if ($action == "edit") include ('judge_info.sec.php'); ?>
<tr>
	  <td>&nbsp;</td>
      <td colspan="2" class="data"><input name="submit" type="submit" class="button" value="Submit Brewer Information" /></td>
    </tr>

</table>
<?php if ($section != "step7") { ?>
	<input name="brewerEmail" type="hidden" value="<?php if ($filter != "default") echo $row_brewerID['brewerEmail']; else echo $row_user['user_name']; ?>" />
	<input name="uid" type="hidden" value="<?php if (($action == "edit") && ($row_brewerID['uid'] != "")) echo  $row_brewerID['uid']; elseif (($action == "edit") && ($row_user['userLevel'] == "1") && (($_SESSION["loginUsername"]) != $row_brewerID['brewerEmail'])) echo $row_user_level['id']; else echo $row_user['id']; ?>" />
    <input name="brewerJudgeAssignedLocation" type="hidden" value="<?php echo $row_brewer['brewerJudgeAssignedLocation'];?>" />
    <input name="brewerStewardAssignedLocation" type="hidden" value="<?php echo $row_brewer['brewerStewardAssignedLocation'];?>" />
    <input name="brewerAssignment" type="hidden" value="<?php echo $row_brewer['brewerAssignment'];?>" />
	<?php if ($go == "entrant") { ?>
	<input name="brewerJudge" type="hidden" value="N" />
	<input name="brewerSteward" type="hidden" value="N" /> 
	<?php } ?>
<?php } ?>
</form>
<?php }
else echo "<div class=\"error\">You can only edit your own profile.</div>";
?>