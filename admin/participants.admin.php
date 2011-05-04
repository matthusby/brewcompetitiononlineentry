<?php 

/**
 * Module:      participants.admin.php
 * Description: This module houses all participant (brewer) related functionality
 *              including viewing a participant list, add/edit/delete, 
 *              Also provids judging location related functions - add, edit, delete.
 *
 */

include(DB.'brewer.db.php');
include(DB.'judging_locations.db.php'); 

$query_participant_count = "SELECT COUNT(*) as 'count' FROM brewer";
$result = mysql_query($query_participant_count, $brewing) or die(mysql_error());
$row = mysql_fetch_assoc($result);
$totalRows_participant_count = $row["count"];
mysql_free_result($result);
?>

<h2><?php 
if ($filter == "judges") echo "Available Judges"; 
elseif ($filter == "stewards") echo "Available Stewards";
elseif ($filter == "assignJudges") echo "Assigned Judges"; 
elseif ($filter == "assignStewards") echo "Assigned Stewards"; 
elseif ($action == "add") echo "Add Participant"; 
else echo "Participants"; 
if ($dbTable != "default") echo ": ".ltrim($dbTable, "brewer_"); ?></h2>
<?php if ($action != "print") { ?>
<div class="adminSubNavContainer">
  	<span class="adminSubNav">
		<span class="icon"><img src="images/arrow_left.png" alt="Back"></span><a href="index.php?section=admin">Back to Admin</a>
    </span>
  	<?php if ($action != "add") { ?>
  	<?php if ($dbTable != "default") { ?>
 	<span class="adminSubNav">
		<span class="icon"><img src="images/arrow_left.png" alt="Back"></span><a href="index.php?section=admin&amp;go=archive">Back to Archives</a>
  	</span>
	<?php } ?>
    <?php if ($dbTable == "default") { ?>
  	<span class="adminSubNav">
		<span class="icon"><img src="images/user_add.png"  /></span><a href="index.php?section=admin&amp;go=participants&amp;action=add">Add a Participant</a>
    </span>
    <span class="adminSubNav">
		<span class="icon"><img src="images/page.png" /></span>
  			<div class="menuBar"><a class="menuButton" href="#" onclick="#" onmouseover="buttonMouseover(event, 'views');">View...</a></div>
  			<div id="views" class="menu" onmouseover="menuMouseover(event)">
  				<a class="menuItem" href="index.php?section=admin&amp;go=participants">All Participants</a>
  				<a class="menuItem" href="index.php?section=admin&amp;go=participants&amp;filter=judges">Available Judges</a>
  				<a class="menuItem" href="index.php?section=admin&amp;go=participants&amp;filter=stewards">Available Stewards</a>
        		<a class="menuItem" href="index.php?section=admin&amp;go=participants&amp;filter=assignJudges">Assigned Judges</a>
        		<a class="menuItem" href="index.php?section=admin&amp;go=participants&amp;filter=assignStewards">Assigned Stewards</a>
  			</div>
  	</span>
    <span class="adminSubNav">
		<span class="icon"><img src="images/printer.png" /></span>
  			<div class="menuBar"><a class="menuButton" href="#" onclick="#" onmouseover="buttonMouseover(event, 'printMenu_participants');">Print <em>This</em> List</a></div>
  			<div id="printMenu_participants" class="menu" onmouseover="menuMouseover(event)">
  				<a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=default&amp;psort=brewer_name&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Last Name</a>
  				<a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=default&amp;psort=club&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Club</a>
  				<?php if ($filter == "judges") { ?>
                <a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=default&amp;psort=judge_id&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Judge ID</a>
				<a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=default&amp;psort=judge_rank&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Judge Rank</a>
				<?php } ?>
            </div>
  	</span>
  	<span class="adminSubNav">
		<?php if ((totalRows_participant_count > $row_prefs['prefsRecordLimit']) && ($filter == "default")) { ?>
  		<span class="icon"><img src="images/printer.png" /></span>
  			<div class="menuBar"><a class="menuButton" href="#" onclick="#" onmouseover="buttonMouseover(event, 'printMenu_participants_all');">Print <em>All</em></a></div>
  			<div id="printMenu_participants_all" class="menu" onmouseover="menuMouseover(event)">
  				<a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=brewer_name&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Last Name</a>
  				<a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=club&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Club</a>
            </div>
    </span>
    <span class="adminSubNav">
        <?php } if ($filter != "default") { ?>
        <span class="icon"><img src="images/printer.png" /></span>
  			<div class="menuBar"><a class="menuButton" href="#" onclick="#" onmouseover="buttonMouseover(event, 'printMenu_participants_all');">Print <em>All</em></a></div>
  			<div id="printMenu_participants_all" class="menu" onmouseover="menuMouseover(event)">
  				<a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=brewer_name&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Last Name</a>
  				<a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=club&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Club</a>
  				<?php if ($filter == "judges") { ?>
                <a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=judge_id&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Judge ID</a>
				<a class="menuItem thickbox" href="output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=judge_rank&amp;TB_iframe=true&amp;height=450&amp;width=750&amp;KeepThis=true">By Judge Rank</a>
				<?php } ?>
            </div>
  			<?php } else echo "&nbsp;"; ?>
  	</span>
	<?php } // end 1.2 ?>
</div>
<div class="adminSubNavContainer">
	<?php if (($action != "add") && ($dbTable == "default")) { // 2  ?>
 	<span class="adminSubNav">
		<span class="icon"><img src="images/user_edit.png"  /></span><a href="index.php?section=admin&amp;action=assign&amp;go=judging&amp;filter=judges">Assign Judges</a>
 	</span>
    <span class="adminSubNav">
		<span class="icon"><img src="images/user_edit.png"  /></span><a href="index.php?section=admin&amp;action=assign&amp;go=judging&amp;filter=stewards">Assign Stewards</a>
 	</span>
    <span class="adminSubNav">
    	<span class="icon"><img src="images/user_edit.png"  /></span><a href="index.php?section=admin&amp;action=assign&amp;go=judging&amp;filter=staff">Assign Staff</a>
 	</span>
	<?php if (($totalRows_judging > 1) && ($row_prefs['prefsCompOrg'] == "N")) { ?>
    <span class="adminSubNav">
		<span class="icon"><img src="images/user_edit.png"  /></span><a href="index.php?section=admin&amp;action=update&amp;go=judging&amp;filter=judges">Assign Judges to a Location</a>
	</span>
 	<span class="adminSubNav">
		<span class="icon"><img src="images/user_edit.png"  /></span><a href="index.php?section=admin&amp;action=update&amp;go=judging&amp;filter=stewards">Assign Stewards to a Location</a>
	</span>
	<?php }  ?>
    <?php if (($totalRows_tables > 1) && ($row_prefs['prefsCompOrg'] == "Y")) { ?>
    <span class="adminSubNav">
		<span class="icon"><img src="images/user_edit.png"  /></span><a href="index.php?section=admin&amp;action=assign&amp;go=judging_tables">Assign Judges/Stewards to Tables</a>
	</span>
	<?php }  ?>
 <?php } // end 2 ?>
</div>
<?php } 
}
if (($action == "default") || ($action == "print")) { 
if ($totalRows_participant_count > 0) { 
	if ($action != "print") { ?>
	<?php 
		if ($totalRows_participant_count > $row_prefs['prefsRecordLimit']) {
		$of = $start + $totalRows_brewer;
		echo "<div id=\"sortable_info\" class=\"dataTables_info\">Showing ".$start_display." to ".$of." of ".$totalRows_participant_count." entries</div>";
		}
	?>
	<link href="css/sorting.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" language="javascript">
	 $(document).ready(function() {
		$('#sortable').dataTable( {
		<?php if ($totalRows_participant_count <= $row_prefs['prefsRecordLimit']) { ?>
		"bPaginate" : true,
		"sPaginationType" : "full_numbers",
		"bLengthChange" : true,
		"iDisplayLength" : <?php echo round($row_prefs['prefsRecordPaging']); ?>,
		"sDom": 'ifrtip',
		"bStateSave" : false,
		<?php } else { ?>
		"bPaginate" : false,
		"sDom": 'rt',
		"bStateSave" : false,
		"bLengthChange" : false,
		<?php } ?>
		"aaSorting": [[0,'asc']],
		"bProcessing" : true,
		"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				<?php if ($filter == "default") { ?>
				{ "asSorting": [  ] },
				{ "asSorting": [  ] },
				null
				<?php } 
				if (($totalRows_judging > 1) && ($row_prefs['prefsCompOrg'] == "N")) { ?>,
    			{ "asSorting": [  ] },
  				<?php } if ($filter != "default") { ?>
    			<?php if ($filter == "judges") { ?>
    			null,
    			null
    			<?php } ?>
				<?php } ?>
				<?php if ($dbTable == "default") { ?>,
				{ "asSorting": [  ] }
				<?php } ?>
			]
		} );
	} );
	</script>
   <?php } ?>
   <?php if ($action == "print") { ?>
   <script type="text/javascript" language="javascript">
	 $(document).ready(function() {
		$('#sortable').dataTable( {
			"bPaginate" : false,
			"sDom": 'rt',
			"bStateSave" : false,
			"bLengthChange" : false,
			<?php if (($filter == "judges") && ($psort == "judge_rank")) { ?>"aaSorting": [[6,'asc']],<?php } ?>
			<?php if (($filter == "judges") && ($psort == "judge_id")) { ?>"aaSorting": [[5,'asc']],<?php } ?>
			<?php if (($filter == "judges") && ($psort == "club")) { ?>"aaSorting": [[3,'asc']],<?php } ?>
			<?php if ($psort == "entry_name") { ?>"aaSorting": [[1,'asc']],<?php } ?>
			<?php if ($psort == "default") { ?>"aaSorting": [[0,'asc']],<?php } ?>
			"bProcessing" : false,
			"aoColumns": [
				{ "asSorting": [  ] },
				{ "asSorting": [  ] },
				{ "asSorting": [  ] },
				{ "asSorting": [  ] },
				{ "asSorting": [  ] }
				<?php if ($filter == "judges"){ ?>
				,{ "asSorting": [  ] },
				{ "asSorting": [  ] }
				<?php } ?>
				]
			} );
		} );
	</script>
   <?php } ?>
<table class="dataTable" id="sortable">
<thead>
  <tr>
    <th class="dataHeading bdr1B">Last</th>
    <th class="dataHeading bdr1B">First</th>
    <th class="dataHeading bdr1B">Info</th>
    <th class="dataHeading bdr1B">Club</th>
  <?php if ($filter == "default") { ?>
    <th class="dataHeading bdr1B">Steward?</th>
    <th class="dataHeading bdr1B">Judge?</th>
    <th class="dataHeading bdr1B">Assigned As</th>
  <?php } 
	if (($totalRows_judging > 1) && ($row_prefs['prefsCompOrg'] == "N")) { ?>
    <th class="dataHeading bdr1B">Assigned To</th>
  <?php } if ($filter != "default") { ?>
    <?php if ($filter == "judges") { ?>
    <th class="dataHeading bdr1B">ID</th>
    <th class="dataHeading bdr1B">Rank</th>
    <?php } ?>
  <?php } if (($action != "print") && ($dbTable == "default")) { ?>
    <th class="dataHeading bdr1B">Actions</th>
  <?php } ?>
  </tr>
</thead>
<tbody>
<?php do { 
    if ($row_brewer['brewerAssignment'] == "J") $query_judging2 = sprintf("SELECT * FROM judging_locations WHERE id='%s'", $row_brewer['brewerJudgeAssignedLocation']);
	if ($row_brewer['brewerAssignment'] == "S") $query_judging2 = sprintf("SELECT * FROM judging_locations WHERE id='%s'", $row_brewer['brewerStewardAssignedLocation']);
	$judging2 = mysql_query($query_judging2, $brewing) or die(mysql_error());
	$row_judging2 = mysql_fetch_assoc($judging2);
	
	$query_user1 = sprintf("SELECT id FROM users WHERE user_name = '%s'", $row_brewer['brewerEmail']);
	$user1 = mysql_query($query_user1, $brewing) or die(mysql_error());
	$row_user1 = mysql_fetch_assoc($user1);
?>
  <tr>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo $row_brewer['brewerLastName']; ?></td>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo $row_brewer['brewerFirstName']; ?></td>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><a href="mailto:<?php echo $row_brewer['brewerEmail']; ?>?Subject=<?php if ($filter == "judges") echo "Judging at ".$row_contest_info['contestName']; elseif ($filter == "stewards") echo "Stewarding at ".$row_contest_info['contestName']; else echo $row_contest_info['contestName'];  ?>"><?php echo $row_brewer['brewerEmail']; ?></a><br /><?php if ($row_brewer['brewerPhone1'] != "") echo $row_brewer['brewerPhone1']." (1)<br>";  if ($row_brewer['brewerPhone2'] != "") echo $row_brewer['brewerPhone2']." (2)"; ?></td>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo $row_brewer['brewerClubs']; ?></td>
  	<?php if ($filter == "default") { ?>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php if ($row_brewer['brewerSteward'] == "Y") echo "<img src='images/tick.png'>"; else echo "<img src='images/cross.png'>"; ?></td>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php if ($row_brewer['brewerJudge'] == "Y") echo "<img src='images/tick.png'>"; else echo "<img src='images/cross.png'>"; ?></td>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"<?php if ($row_brewer['brewerAssignment'] == "J") echo "Judge"; elseif ($row_brewer['brewerAssignment'] == "S") echo "Steward"; else echo "Not Set";?></td>
  	<?php } if (($totalRows_judging > 1) && ($row_prefs['prefsCompOrg'] == "N")){ ?>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>">
		<?php if ((($row_brewer['brewerAssignment'] == "J") && (($row_brewer['brewerJudgeAssignedLocation'] != "") || ($row_brewer['brewerJudgeAssignedLocation'] != "0"))) || (($row_brewer['brewerAssignment'] == "S") && (($row_brewer['brewerStewardAssignedLocation'] != "") || ($row_brewer['brewerStewardAssignedLocation'] != "")))) { ?>
		<table class="dataTableCompact">
		<?php 
		if ($row_brewer['brewerAssignment'] == "J") $a = explode(",",$row_brewer['brewerJudgeAssignedLocation']);
		if ($row_brewer['brewerAssignment'] == "S") $a = explode(",",$row_brewer['brewerStewardAssignedLocation']);
		sort($a);
		foreach ($a as $value) {
			if (($value != "") || ($value != 0)) {
				$query_judging_loc3 = sprintf("SELECT judgingLocName,judgingDate,judgingLocation FROM judging_locations WHERE id='%s'", $value);
				$judging_loc3 = mysql_query($query_judging_loc3, $brewing) or die(mysql_error());
				$row_judging_loc3 = mysql_fetch_assoc($judging_loc3);
				echo "<tr>\n<td>".$value.":</td>\n<td>".$row_judging_loc3['judgingLocName']." ("; 
				echo date_convert($row_judging_loc3['judgingDate'], 3, $row_prefs['prefsDateFormat']).")</td>\n";
				echo "</td>\n</tr>";
				}
			}
		?>
    	</table>
		<?php } else echo "Not Set"; ?>
		
		</td>
	<?php } if ($filter != "default") { ?>
    	<?php if ($filter == "judges") { ?>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo $row_brewer['brewerJudgeID']; ?></td>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo bjcp_rank($row_brewer['brewerJudgeRank'],1); ?></td>
	  	<?php } ?>
 <?php } if (($action != "print") && ($dbTable == "default")) { ?>
    <td class="dataList" nowrap="nowrap"><span class="icon"><a href="index.php?section=brew&amp;go=entries&amp;filter=<?php echo $row_user1['id']; ?>&amp;action=add"><img src="images/book_add.png"  border="0" alt="Add an entry for <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>" title="Add an entry for <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>"></a></span><span class="icon"><a href="index.php?section=brewer&amp;go=<?php echo $go; ?>&amp;filter=<?php echo $row_brewer['id']; ?>&amp;action=edit&amp;id=<?php echo $row_brewer['id']; ?>"><img src="images/pencil.png"  border="0" alt="Edit <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>" title="Edit <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>"></a></span><span class="icon"><a href="index.php?section=admin&amp;go=make_admin&amp;username=<?php echo $row_brewer['brewerEmail'];?>"><img src="images/lock_edit.png"  border="0" alt="Change <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>'s User Level" title="Change <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>'s User Level"></a></span><?php if (($row_brewer['brewerAssignment'] == "J") && (strstr($agent, "Firefox/3"))) /* only works in Firefox as of now */ { ?><span class="icon"><a href="output/labels.php?section=admin&amp;go=participants&amp;action=judging_labels&amp;id=<?php echo $row_brewer['id']; ?>"><img src="images/page_white_acrobat.png"  border="0" alt="Download judging labels for <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>" title="Download judging labels for <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>"></a></span><?php } ?><span class="icon"><?php if ($row_brewer['brewerEmail'] == $_SESSION['loginUsername']) echo "&nbsp;"; else { ?><a href="javascript:DelWithCon('includes/process.inc.php?section=<?php echo $section; ?>&amp;go=<?php echo $go; ?>&amp;dbTable=brewer&amp;action=delete&amp;username=<?php echo $row_brewer['brewerEmail'];?>','id',<?php echo $row_brewer['id']; ?>,'Are you sure you want to delete the participant <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>?\nALL entries for this participant WILL BE DELETED as well.\nThis cannot be undone.');"><img src="images/bin_closed.png"  border="0" alt="Delete <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>" title="Delete <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>"></a><?php } ?></span>
    </td> 
  <?php } ?> 
  </tr>
<?php } while ($row_brewer = mysql_fetch_assoc($brewer)); ?>
</tbody>
</table>
<?php if ($action != "print") {  
	if ($totalRows_participant_count >= $row_prefs['prefsRecordLimit']) { 
	if (($filter == "default") && ($bid == "default")) $total_paginate = $totalRows_participant_count;
	else $total_paginate = $totalRows_brewer;
	paginate($display, $pg, $total_paginate);
	}
}
?>
<?php } if ($totalRows_brewer == 0) { ?>

<?php 
if ($filter == "default") echo "<div class='error'>There are no participants yet.</div>"; 
if (($filter == "judges") || ($filter == "assignJudges")) echo "<div class='error'>There are no judges available yet.</div>"; 
if (($filter == "stewards") || ($filter == "assignStewards"))  echo "<div class='error'>There are no stewards available yet.</div>"; 
}
} // end if ($action == "default")

if ($action == "add")  { 
	if ($filter == "default") { ?>
<script type="text/javascript" src="js_includes/email_check.js"></script>
<form action="includes/process.inc.php?action=add&amp;dbTable=users&amp;section=<?php echo $section; ?>&amp;go=<?php echo $go; ?>" method="POST" name="form1" id="form1" onSubmit="return CheckRequiredFields()">
<table>
	<tr>
    	<td class="dataLabel">Email Address:</td>
    	<td class="data"><input name="user_name" id="user_name" type="text" class="submit" size="40" onchange="AjaxFunction(this.value);"><div id="msg">Email Format:</div></td>
        <td class="data" id="inf_email"><span class="required">Required</span></td>
  	</tr>
  	<tr>
    	<td class="dataLabel">Password:</td>
    	<td class="data"><input name="password" id="password" type="password" class="submit" size="25"></td>
        <td class="data"><span class="required">Required</span></td>
  	</tr>

  	<tr>
    	<td class="dataLabel">&nbsp;</td>
    	<td class="data"><input type="submit" class="button" value="Register"></td> 
        <td class="data">&nbsp;</td>
  	</tr>
</table>
<input type="hidden" name="userLevel" value="2" />
<input type="hidden" name="relocate" value="<?php echo relocate($_SERVER['HTTP_REFERER'],$pg); ?>">
</form>
</div>
<?php } 
if ($filter == "info") { 
if (($action == "add") || (($action == "edit") && (($_SESSION["loginUsername"] == $row_brewer['brewerEmail'])) || ($row_user['userLevel'] == "1")))  { ?>
<form action="includes/process.inc.php?section=<?php echo "admin&amp;go=".$go."&amp;filter=".$filter; ?>&amp;action=<?php echo $action; ?>&amp;dbTable=brewer" method="POST" name="form1" id="form1" onSubmit="return CheckRequiredFields()">
<table class="dataTable">
<tr>
      <td class="dataLabel" width="5%">Email:</td>
      <td class="data" width="20%"><?php echo $username; ?></td>
      <td class="data">&nbsp;</td>
</tr>
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
      <td class="dataLabel">Club Name (if appropriate):</td>
      <td class="data"><input type="text" name="brewerClubs" value="<?php if ($action == "edit") echo $row_brewer['brewerClubs']; ?>" size="32" maxlength="200"></td>
      <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td>&nbsp;</td>
      <td colspan="2" class="data"><input name="submit" type="submit" class="button" value="Submit Brewer Information" /></td>
    </tr>
</table>
<input name="brewerEmail" type="hidden" value="<?php echo $username; ?>" />
<input name="uid" type="hidden" value="<?php echo $row_user_level['id']; ?>" />
<input name="brewerJudge" type="hidden" value="N" />
<input name="brewerSteward" type="hidden" value="N" />
</form>
<?php 
	  }  
   }
} 
?>