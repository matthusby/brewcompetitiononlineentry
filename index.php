<?php 
/**
 * Module:      index.php 
 * Description: This module is the delivery vehicle for all functions.
 * 
 */
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');
require('paths.php');
require(INCLUDES.'functions.inc.php');
$php_version = phpversion();
$today = date('Y-m-d');
$current_page = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?".$_SERVER['QUERY_STRING'];
$images_dir = dirname( __FILE__ );

// Check to see if initial setup has taken place 
if (check_setup()) header ("Location: setup.php?section=step1"); 
if (!check_update()) header ("Location: update.php?go=db_update_required"); 
// If all setup has taken place, run normally
else 
{
// check to see if all judging numbers have been generated. If not, generate
if (!check_judging_numbers()) header("Location: includes/process.inc.php?action=generate_judging_numbers&go=hidden");
require(INCLUDES.'authentication_nav.inc.php');  session_start(); 
require(INCLUDES.'url_variables.inc.php');
require(DB.'common.db.php');
require(DB.'brewer.db.php');
require(INCLUDES.'version.inc.php');
require(INCLUDES.'headers.inc.php');
$version = $row_system['version'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_contest_info['contestName']; ?> Organized By <?php echo $row_contest_info['contestHost']." &gt; ".$header_output; ?></title>
<link href="css/<?php echo $row_prefs['prefsTheme']; ?>.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js_includes/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="js_includes/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<link rel="stylesheet" href="js_includes/fancybox/jquery.fancybox.css?v=2.0.2" type="text/css" media="screen" />
<script type="text/javascript" src="js_includes/fancybox/jquery.fancybox.pack.js?v=2.0.2"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$("#modal_window_link").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'fitToView'			: false,
				'scrolling'         : 'auto',
				'openEffect'		: 'elastic',
				'closeEffect'		: 'elastic',
				//'openEasing'     	: 'easeOutBack',
				//'closeEasing'   	: 'easeInBack',
				'openSpeed'         : 'normal',
				'closeSpeed'        : 'normal',
				'type'				: 'iframe',
				'helpers' 			: {	title : { type : 'inside' } },
				<?php if ($modal_window == "false") { ?>
				'afterClose': 		function() { parent.location.reload(true); }
				<?php } ?>
			});

		});
	</script>
<script type="text/javascript" src="js_includes/jquery.dataTables.js"></script>
<script type="text/javascript" src="js_includes/delete.js"></script>
<script type="text/javascript" src="js_includes/calendar_control.js" ></script>
<script type="text/javascript" src="js_includes/jump_menu.js" ></script>
<script type="text/javascript" src="js_includes/smoothscroll.js" ></script>
<?php if ((isset($_SESSION["loginUsername"])) && ($row_user['userLevel'] == "1")) { ?>
<script type="text/javascript" src="js_includes/menu.js"></script>
<?php } 
if ($section == "admin") { ?>
<script type="text/javascript" src="js_includes/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js_includes/tinymce.init.js"></script>
<?php } 
if (($section == "admin") || ($section == "brew") || ($section == "brewer") || ($section == "user")  || ($section == "register") || ($section == "contact")) include(INCLUDES.'form_check.inc.php'); ?>
</head>
<body>
<a name="top"></a>
<div id="container">
<div id="navigation">
	<div id="navigation-inner"><?php include (SECTIONS.'nav.sec.php'); ?></div>
</div>
<div id="content">
 	 <div id="content-inner">
 	<?php 
	//echo "<p>Registration Open: ".$row_contest_info['contestRegistrationOpen']."</p>";
	//echo "<p>Registration Deadline: ".$row_contest_info['contestRegistrationDeadline']."</p>";
	//if (greaterDate($today,$row_contest_info['contestRegistrationDeadline'])) echo "<p>Yes.</p>"; else echo "<p>No.</p>"
	?>
  
  <?php if ($section != "admin") { ?>
 	<div id="header">	
		<div id="header-inner"><h1><?php echo $header_output; ?></h1></div>
  	</div>
  <?php }
  
  // Check if registration open date has not passed. If so, display "registration not open yet" message.
  if (!greaterDate($today,$row_contest_info['contestRegistrationOpen'])) { 
  	if ($section != "admin") {
  	?>
    <div class="closed">Registration will open <?php echo date_convert($row_contest_info['contestRegistrationOpen'], 2, $row_prefs['prefsDateFormat']); ?>.</div>
	<?php }
	if ($section == "default") 		include (SECTIONS.'default.sec.php');
	if ($section == "login")		include (SECTIONS.'login.sec.php');
	if ($section == "rules") 		include (SECTIONS.'rules.sec.php');
	if ($section == "entry") 		include (SECTIONS.'entry_info.sec.php');
	if ($section == "sponsors") 	include (SECTIONS.'sponsors.sec.php');
	if ($section == "past_winners") include (SECTIONS.'past_winners.sec.php');
	if ($section == "contact") 		include (SECTIONS.'contact.sec.php');
	if (isset($_SESSION['loginUsername'])) {
		if ($row_user['userLevel'] == "1") {
			if ($section == "list") 	include (SECTIONS.'list.sec.php');
			if ($section == "pay") 		include (SECTIONS.'pay.sec.php');
			if ($section == "admin")	include (ADMIN.'default.admin.php');
			if ($section == "brewer") 	include (SECTIONS.'brewer.sec.php');
			if ($section == "brew") 	include (SECTIONS.'brew.sec.php');
			if ($section == "judge") 	include (SECTIONS.'judge.sec.php');
			if ($section == "user") 	include (SECTIONS.'user.sec.php');
			if ($section == "beerxml")	include (SECTIONS.'beerxml.sec.php');
			}
		}
  }
  // Check if registration close date has passed. If so, display "registration end" message.
  elseif (greaterDate($today,$row_contest_info['contestRegistrationDeadline'])) {
	if ((($section != "admin") || ($row_user['userLevel'] != "1")) && (judging_date_return() > 0)) { ?>
    <div class="closed">Entry registration has closed.</div>
    <?php if ((!isset($_SESSION['loginUsername'])) && ($section != "register")) { ?><div class="error">If you are willing to be a judge or steward, please <a href="index.php?section=register&amp;go=judge">register here</a>.</div><?php } ?>
	<?php }  
	if ($section == "default") 		include (SECTIONS.'default.sec.php');
	if ($section == "register") 	include (SECTIONS.'register.sec.php');
	if ($section == "login")		include (SECTIONS.'login.sec.php');
	if ($section == "rules") 		include (SECTIONS.'rules.sec.php');
	if ($section == "entry") 		include (SECTIONS.'entry_info.sec.php');
	if ($section == "sponsors") 	include (SECTIONS.'sponsors.sec.php');
	if ($section == "past_winners") include (SECTIONS.'past_winners.sec.php');
	if ($section == "contact") 		include (SECTIONS.'contact.sec.php');
	if (isset($_SESSION['loginUsername'])) {
		if ($section == "list") 	include (SECTIONS.'list.sec.php');
		if ($section == "pay") 		include (SECTIONS.'pay.sec.php');
		if ($section == "brewer") 	include (SECTIONS.'brewer.sec.php');
			
		if ($row_user['userLevel'] == "1") {
			if ($section == "admin")	include (ADMIN.'default.admin.php');
			if ($section == "brew") 	include (SECTIONS.'brew.sec.php');
			if ($section == "judge") 	include (SECTIONS.'judge.sec.php');
			if ($section == "user") 	include (SECTIONS.'user.sec.php');
			if ($section == "beerxml")	include (SECTIONS.'beerxml.sec.php');
			}
		}
  } else { // If registration is not closed
	if ($section == "register") 	include (SECTIONS.'register.sec.php');
	if ($section == "login")		include (SECTIONS.'login.sec.php');
	if ($section == "rules") 		include (SECTIONS.'rules.sec.php');
	if ($section == "entry") 		include (SECTIONS.'entry_info.sec.php');
	if ($section == "default") 		include (SECTIONS.'default.sec.php');
	if ($section == "sponsors") 	include (SECTIONS.'sponsors.sec.php');
	if ($section == "past_winners") include (SECTIONS.'past_winners.sec.php');
	if ($section == "contact") 		include (SECTIONS.'contact.sec.php');
	// if ($section == "brewer") 		include (SECTIONS.'brewer.sec.php');
	if (isset($_SESSION['loginUsername'])) {
		if ($row_user['userLevel'] == "1") { if ($section == "admin")	include (ADMIN.'default.admin.php'); }
		if ($section == "brewer") 	include (SECTIONS.'brewer.sec.php');
		if ($section == "brew") 	include (SECTIONS.'brew.sec.php');
		if ($section == "pay") 		include (SECTIONS.'pay.sec.php');
		if ($section == "list") 	include (SECTIONS.'list.sec.php');
		if ($section == "judge") 	include (SECTIONS.'judge.sec.php');
		if ($section == "user") 	include (SECTIONS.'user.sec.php');
		if ($section == "beerxml")	include (SECTIONS.'beerxml.sec.php');
	}
  } // End registration date check.
  ?>
<?php if (($row_prefs['prefsShare'] == "Y") && (($section == "default") || ($section == "rules") || ($section == "entry") || ($section == "sponsors"))) { ?>
<h2>Share <?php echo $row_contest_info['contestName']; ?>
<!-- Start Shareaholic Sexybookmark HTML-->
<div class="shr_class shareaholic-show-on-load"></div>
<!-- End Shareaholic Sexybookmark HTML -->
<!-- Start Shareaholic Sexybookmark script -->
<script type="text/javascript">
var SHRSB_Settings = {"shr_class":{"src":"/css","link":"","service":"5,7,2,52,38,201,88,43,74,53,78,39,40,46,219","apikey":"6ffe2cbf142c45bd4cd03b01ec46b8658","localize":true,"shortener":"google","shortener_key":"","designer_toolTips":true,"twitter_template":"${title} - ${short_link}"}};
</script>

<script type="text/javascript">
(function() {
var sb = document.createElement("script"); sb.type = "text/javascript";sb.async = true;
sb.src = ("https:" == document.location.protocol ? "https://dtym7iokkjlif.cloudfront.net" : "http://cdn.shareaholic.com") + "/media/js/jquery.shareaholic-publishers-sb.min.js";
var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(sb, s);
})();
</script>
<!-- End Shareaholic Sexybookmark script -->
<?php } ?>
<?php 
  if ((!isset($_SESSION['loginUsername'])) && (($section == "admin") || ($section == "brew") || ($section == "user") || ($section == "judge") || ($section == "list") || ($section == "pay") || ($section == "beerXML"))) { ?>  
  <?php if ($section == "admin") { ?>
  <div id="header">	
	<div id="header-inner"><h1><?php echo $header_output; ?></h1></div>
  </div>
  <?php } ?>
  <div class="error">Please register or log in to access this area.</div>
  <?php } ?>
  </div>
</div>
</div>
<a name="bottom"></a>
<div id="footer">
	<div id="footer-inner"><?php include (SECTIONS.'footer.sec.php'); ?></div>
</div>
</body>
</html>
<?php } ?>