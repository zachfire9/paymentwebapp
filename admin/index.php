<?php
session_start(); 
session_destroy();
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
			<?php 
			if (isset($_REQUEST["error"])) {
				echo "<p style=\"color:red\" align=\"center\">The password you submitted is incorrect.</p>";
			}
			?>
			<form name="login" action="main.php" method="post">
			<p align="center">Enter Password Below</p>
			<p align="center"><input type="password" name="password" /></p>
			<p align="center"><input type="submit" name="submit" value="Login" /></p>
			</form>
		</div>

	</div>

	<div class="MainContentClear"></div>

<?php include("../../includes/footer.php") ?>
