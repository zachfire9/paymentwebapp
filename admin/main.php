<?php

session_start();

if(md5($_REQUEST[password]) != 'passwordkey' && !isset($_SESSION['login'])) {
	header("Location: index.php?error=true");
}
else {
	$_SESSION['login'] = true;
}

$con = mysql_connect("localhost","username","password");

if (!$con) {
die('Could not connect: ' . mysql_error());
}

mysql_select_db("dbname", $con);

$members = mysql_query("SELECT * FROM signup ORDER BY id DESC");

?>

<?php $page = "membership";?>

<?php include("../../includes/header.php") ?>

	<script src="../js/jquery-1.2.3.pack.js" type="text/javascript"></script>
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen" />

	<div class="ContentHeaderLeft">

		<div class="ContentHeaderPaddingLeft">MEMBERSHIP</div>

	</div>

	<div class="MainPadding">

		<div id="container">
			<p><a href="index.php">Logout</a></p>
			<?php
			echo "<div class=\"db_value\" id=\"db_date\"><strong>Date</strong></div>";
			echo "<div class=\"db_value\" id=\"db_type\"><strong>Type</strong></div>";
			echo "<div class=\"db_value\" id=\"db_price\"><strong>Price</strong></div>";
			echo "<div class=\"db_value\" id=\"db_name_first\"><strong>First Name</strong></div>";
			echo "<div class=\"db_value\" id=\"db_name_last\"><strong>Last Name</strong></div>";
			echo "<div class=\"db_value\" id=\"db_date\">&nbsp</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<hr />";
			while($member = mysql_fetch_array($members))
			{
			$dateArray = explode("-", $member['date']);
			$dateList = mktime(0,0,0,$dateArray[1],$dateArray[2],$dateArray[0]);
			$dateFormat = date('m/d/Y', $dateList);
			echo "<div class=\"db_value\" id=\"db_date\">$dateFormat</div>";
			echo "<div class=\"db_value\" id=\"db_type\">$member[type]</div>";
			echo "<div class=\"db_value\" id=\"db_price\">$$member[price]</div>";
			echo "<div class=\"db_value\" id=\"db_name_first\">$member[name_first]</div>";
			echo "<div class=\"db_value\" id=\"db_name_last\">$member[name_last]</div>";
			echo "<div class=\"db_value\" id=\"db_date\">[ <a href=\"detail.php?id=$member[id]\">Details</a> ]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<hr />";
			}
			?>
		</div>

	</div>

	<div class="MainContentClear"></div>

<?php include("../../includes/footer.php") ?>
