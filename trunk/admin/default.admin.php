<div id="header">	
	<div id="header-inner"><h1><?php if ($action != "print") echo "Competition Site Administration"; else echo $row_contest_info['contestName']; ?></h1></div>
</div>
<?php 
if ($msg == "1") echo "<div class=\"error\">Information added successfully.</div>"; 
if ($msg == "2") echo "<div class=\"error\">Information edited successfully.</div>"; 
if ($msg == "5") echo "<div class=\"error\">Information deleted successfully.</div>";
if ($msg == "6") echo "<div class=\"error\">The suffix you entered is already in use, please enter a different one.</div>"; 
if ($msg == "7") echo "<div class=\"error\">Archives created successfully. Click the archive name to view.</div>";
if ($msg == "8") echo "<div class=\"error\">Archive \"".$filter."\" deleted.</div>"; 
if ($msg == "9") echo "<div class=\"error\">The entries have been updated.</div>";
?>
<?php 
if ($row_user['userLevel'] == "1") {
	if ($go == "default") { ?>
<table>
  <tr bgcolor="<?php echo $color;?>">
    <td width="5%" class="dataLabel bdr1T"><span class="icon"><img src="images/pencil.png" align="absmiddle"></span>Edit:</td>
    <td width="15%" nowrap="nowrap" class="data bdr1T"><a href="index.php?section=admin&go=contest_info">Contest Info</a></td>
    <td colspan="4" nowrap="nowrap" class="data bdr1T"><a href="index.php?section=admin&go=preferences">Preferences</a></td>
  </tr>
  <tr bgcolor="<?php echo $color1;?>">
    <td width="5%" class="dataLabel"><span class="icon"><img src="images/book.png" align="absmiddle"></span>Manage/View:</td>
    <td width="15%" nowrap="nowrap" class="data"><a href="index.php?section=admin&go=participants">Participants</a></td>
    <td width="15%" nowrap="nowrap" class="data"><a href="index.php?section=admin&go=entries">Entries</a></td>
    <td width="15%" nowrap="nowrap" class="data"><a href="index.php?section=admin&go=sponsors">Sponsors</a></td>
    <td width="15%" nowrap="nowrap" class="data"><a href="index.php?section=admin&go=participants&filter=judges">Available Judges</a></td>
    <td nowrap="nowrap" class="data"><a href="index.php?section=admin&go=participants&filter=stewards">Available Stewards</a></td>
  </tr>
  <tr bgcolor="<?php echo $color;?>">
    <td class="dataLabel"><span class="icon"><img src="images/picture_add.png" align="absmiddle"></span>Upload:</td>
    <td width="15%" nowrap="nowrap" class="data"><a href="admin/upload.admin.php?KeepThis=true&TB_iframe=true&height=350&width=800" title="Upload Competition Logo Image" class="thickbox">Competition Logo</a></td>
    <td nowrap="nowrap" colspan="4" class="data"><a href="admin/upload.admin.php?KeepThis=true&TB_iframe=true&height=350&width=800" title="Upload Sponsor Logo Image" class="thickbox">Sponsor Logos</a></td>
  </tr>
  <tr bgcolor="<?php echo $color1;?>">
    <td width="5%" class="dataLabel"><span class="icon"><img src="images/page_world.png" align="absmiddle"></span>Export Promo Materials:</td>
    <td width="15%" nowrap="nowrap" class="data"><a href="admin/promo_export.admin.php?action=html">HTML</a></td>
    <td colspan="4" width="15%" nowrap="nowrap" class="data"><a href="admin/promo_export.admin.php?action=word">Word</a></td>
  </tr>
  <tr bgcolor="<?php echo $color;?>">
    <td width="5%" class="dataLabel"><span class="icon"><img src="images/cog.png" align="absmiddle"></span>Maintenance:</td>
    <td nowrap="nowrap" class="data" colspan="3"><a href="index.php?section=admin&go=archive">Archives</a></td>
    <td colspan="2" class="data">View and create archived information from previous competitions.</td>
  </tr>
  <tr bgcolor="<?php echo $color1;?>">
    <td class="dataLabel"><span class="icon"><img src="images/email_go.png" align="absmiddle"></span>Export Email Addresses (CSV):</td>
    <td width="15%" nowrap="nowrap" class="data"><a href="admin/email_export.php">All Participants</a></td>
    <td width="15%" nowrap="nowrap" class="data"><a href="admin/email_export.php?filter=judges">Judges</a></td>
    <td width="15%" nowrap="nowrap" class="data"><a href="admin/email_export.php?filter=stewards">Stewards</a></td>
    <td colspan="2" class="data">For importing into an email or contact management program.</td>
  </tr>
  <tr bgcolor="<?php echo $color;?>">
    <td width="5%" class="dataLabel"><span class="icon"><img src="images/page_go.png" align="absmiddle"></span>Export Tab Delimited File:</td>
    <td width="15%" nowrap="nowrap" class="data"><a href="admin/participants_export.php?go=tab">Participants</a></td>
    <td width="15%" class="data"><a href="admin/entries_export.php?go=tab&amp;filter=paid">Paid &amp; Received Entries</a></td>
    <td width="15%" nowrap="nowrap" class="data"><a href="admin/entries_export.php?go=tab">All Entries</a></td>
    <td colspan="2" class="data">For importing into the Homebrew Competition Coordination Program (HCCP).</td>
  </tr>
  <tr bgcolor="<?php echo $color1;?>">
    <td width="5%" class="dataLabel bdr1B"><span class="icon"><img src="images/page_excel_go.png" align="absmiddle"></span>Export CSV File:</td>
    <td width="15%" nowrap="nowrap" class="data bdr1B"><a href="admin/participants_export.php?go=csv">Participants</a></td>
    <td width="15%" class="data bdr1B"><a href="admin/entries_export.php?go=csv&amp;filter=paid">Paid &amp; Received Entries</a></td>
    <td width="15%" nowrap="nowrap" class="data bdr1B"><a href="admin/entries_export.php?go=csv">All Entries</a></td>
    <td colspan="2" class="data bdr1B">For importing into a spreadsheet program such as Microsoft Excel.</td>
  </tr>
</table>
<?php 	} 
if ($go == "contest_info") 	include ('admin/contest_info.admin.php');
if ($go == "preferences") 	include ('admin/preferences.admin.php');
if ($go == "participants") 	include ('admin/participants.admin.php');
if ($go == "entries") 		include ('admin/entries.admin.php');
if ($go == "make_admin") 	include ('admin/make_admin.admin.php');
if ($go == "archive") 	    include ('admin/archive.admin.php');
if ($go == "sponsors") 	    include ('admin/sponsors.admin.php');
}
else echo "<div class=\"error\">You do not have sufficient privileges to access this area.</div>";
?>