<?php
session_start();

if(!isset($_SESSION['login'])) {
	header("Location: index.php?error=true");
}

$con = mysql_connect("localhost","username","password");

if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("dbname", $con);

$members = mysql_query("SELECT * FROM signup WHERE id = '$_REQUEST[id]'");

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
			<p class="text-input"><a href="main.php">Back to Main</a></p>
			<?php
			while($member = mysql_fetch_array($members))
			{
			$dateArray = explode("-", $member['date']);
			$dateList = mktime(0,0,0,$dateArray[1],$dateArray[2],$dateArray[0]);
			$dateFormat = date('m/d/Y', $dateList);
			echo "<label class=\"form_label\">Date:</label><div class=\"text-input\">&nbsp $dateFormat</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Type:</label><div class=\"text-input\">&nbsp $member[type]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Price:</label><div class=\"text-input\">&nbsp $$member[price]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Name:</label><div class=\"text-input\">&nbsp $member[name_first] $member[name_last]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Title:</label><div class=\"text-input\">&nbsp $member[title]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Company:</label><div class=\"text-input\">&nbsp $member[company]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Business Category:</label><div class=\"text-input\">&nbsp $member[category]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Address:</label><div class=\"text-input\">&nbsp $member[address]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">City:</label><div class=\"text-input\">&nbsp $member[city]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">State:</label><div class=\"text-input\">&nbsp $member[state]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Zip:</label><div class=\"text-input\">&nbsp $member[zip]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Mobile Phone:</label><div class=\"text-input\">&nbsp $member[phone]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Personal Email:</label><div class=\"text-input\">&nbsp $member[email]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Work Email:</label><div class=\"text-input\">&nbsp $member[email_work]</div>";
			echo "<div class=\"float_clear\"></div>";
			echo "<label class=\"form_label\">Gender:</label><div class=\"text-input\">&nbsp $member[gender]</div>";
			echo "<div class=\"float_clear\"></div>";
			}
			?>
		</div>

	</div>

	<div class="MainContentClear"></div>

<?php include("../../includes/footer.php") ?>
