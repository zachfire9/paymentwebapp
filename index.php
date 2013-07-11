<?php $page = "membership";?>

<?php include("../includes/header.php") ?>

<script src="js/jquery-1.2.3.pack.js" type="text/javascript"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />

<div class="ContentHeaderLeft">

	<div class="ContentHeaderPaddingLeft">MEMBERSHIP</div>

</div>

<div class="MainPadding">

	<div id="container">
		<div class="membership_type"><a href="form.php?type=student"><img src="images/logo.jpg" width="64" height="25" border="0" /> Student</a> $45</div>
		<div class="membership_type"><a href="form.php?type=member"><img src="images/logo.jpg" width="64" height="25" border="0" /> New Member</a> $70</div>
		<div class="membership_type"><a href="form.php?type=renewal"><img src="images/ogo.jpg" width="64" height="25" border="0" /> Renewal</a> $70</div>
	</div>

</div>

<div class="MainContentClear"></div>

<?php include("../includes/footer.php") ?>
