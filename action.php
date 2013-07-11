<?php
//Creating an associative array with the form values
//Check for the  billing address
if(isset($_REQUEST["card_billing_address"])) {
	$formData = array(
					"date" => date("Y-m-d"),
					"type" => $_REQUEST["type"],
					"price" => $_REQUEST["price"],
					"name_first" => $_REQUEST["name_first"],
					"name_last" => $_REQUEST["name_last"],
					"title" => $_REQUEST["title"],
					"company" => $_REQUEST["company"],
					"category" => $_REQUEST["category"],
					"address" => $_REQUEST["address"],
					"city" => $_REQUEST["city"],
					"state" => $_REQUEST["state"],
					"zip" => $_REQUEST["zip"],
					"phone" => $_REQUEST["phone"],
					"email" => $_REQUEST["email"],
					"email_work" => $_REQUEST["email_work"],
					"birthday" => $_REQUEST["birthday"],
					"gender" => $_REQUEST["gender"],
					"card_name_first" => $_REQUEST["card_name_first"],
					"card_name_last" => $_REQUEST["card_name_last"],
					"card_number" => $_REQUEST["card_number"],
					"card_date_month" => $_REQUEST["card_date_month"],
					"card_date_year" => $_REQUEST["card_date_year"],
					"card_code" => $_REQUEST["card_code"],
					"card_address" => $_REQUEST["address"],
					"card_city" => $_REQUEST["city"],
					"card_state" => $_REQUEST["state"],
					"card_zip" => $_REQUEST["zip"]
					);
} else {
	$formData = array(
					"date" => date("Y-m-d"),
					"type" => $_REQUEST["type"],
					"price" => $_REQUEST["price"],
					"name_first" => $_REQUEST["name_first"],
					"name_last" => $_REQUEST["name_last"],
					"title" => $_REQUEST["title"],
					"company" => $_REQUEST["company"],
					"category" => $_REQUEST["category"],
					"address" => $_REQUEST["address"],
					"city" => $_REQUEST["city"],
					"state" => $_REQUEST["state"],
					"zip" => $_REQUEST["zip"],
					"phone" => $_REQUEST["phone"],
					"email" => $_REQUEST["email"],
					"email_work" => $_REQUEST["email_work"],
					"birthday" => $_REQUEST["birthday"],
					"gender" => $_REQUEST["gender"],
					"card_name_first" => $_REQUEST["card_name_first"],
					"card_name_last" => $_REQUEST["card_name_last"],
					"card_number" => $_REQUEST["card_number"],
					"card_date_month" => $_REQUEST["card_date_month"],
					"card_date_year" => $_REQUEST["card_date_year"],
					"card_code" => $_REQUEST["card_code"],
					"card_address" => $_REQUEST["card_address"],
					"card_city" => $_REQUEST["card_city"],
					"card_state" => $_REQUEST["card_state"],
					"card_zip" => $_REQUEST["card_zip"]
					);
}

//Assign validation url
$errorString = "form.php?error=true";
$error = false;

//Regex validation for email, birthday, and numbers
$email_filter = "/^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/";
$birthday_filter = "/^(0[1-9]|1[012])\/(0[1-9]|[12][0-9]|3[01])\/(19|20)\d\d$/";
$number_filter = "/^\d+$/";

//Validate each POST variable
foreach ($formData as $key=>$val) {
	if ($key == 'title' || $key == 'company' || $key == 'category' || $key == 'email_work')
		$errorString .= "&$key=$val";
	elseif($key == 'email' && !preg_match($email_filter, $val) || $key == 'birthday' && !preg_match($birthday_filter, $val) || $key == 'card_number' && !preg_match($number_filter, $val) || $key == 'card_date_month' && !preg_match($number_filter, $val) || $key == 'card_date_year' && !preg_match($number_filter, $val) || $key == 'card_code' && !preg_match($number_filter, $val))
		$error = true;
	elseif(empty($val))
		$error = true;
	else
		$errorString .= "&$key=$val";
}

//Validation return url
if ($error == true)
	header("Location: $errorString");

// By default, this sample code is designed to post to our test server for
// developer accounts: https://test.authorize.net/gateway/transact.dll
// for real accounts (even in test mode), please make sure that you are
// posting to: https://secure.authorize.net/gateway/transact.dll
$post_url = "https://secure.authorize.net/gateway/transact.dll";

$post_values = array(
	
	// the API Login ID and Transaction Key must be replaced with valid values
	"x_login"			=> "login",
	"x_tran_key"		=> "key",

	"x_version"			=> "3.1",
	"x_delim_data"		=> "TRUE",
	"x_delim_char"		=> "|",
	"x_relay_response"	=> "FALSE",

	"x_type"			=> "AUTH_CAPTURE",
	"x_method"			=> "CC",
	"x_card_num"		=> "$formData[card_number]",
	"x_exp_date"		=> "$formData[card_date_month]$formData[card_date_year]",

	"x_amount"			=> "$formData[price]",
	"x_description"		=> "$formData[type]",

	"x_first_name"		=> "$formData[card_name_first]",
	"x_last_name"		=> "$formData[card_name_last]",
	"x_address"			=> "$formData[card_address]",
	"x_state"			=> "$formData[card_state]",
	"x_zip"				=> "$formData[card_zip]"
	// Additional fields can be added here as outlined in the AIM integration
	// guide at: http://developer.authorize.net
);

// This section takes the input fields and converts them to the proper format
// for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
$post_string = "";
foreach( $post_values as $key => $value )
	{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
$post_string = rtrim( $post_string, "& " );

// The following section provides an example of how to add line item details to
// the post string.  Because line items may consist of multiple values with the
// same key/name, they cannot be simply added into the above array.
//
// This section is commented out by default.
/*
$line_items = array(
	"item1<|>golf balls<|><|>2<|>18.95<|>Y",
	"item2<|>golf bag<|>Wilson golf carry bag, red<|>1<|>39.99<|>Y",
	"item3<|>book<|>Golf for Dummies<|>1<|>21.99<|>Y");
	
foreach( $line_items as $value )
	{ $post_string .= "&x_line_item=" . urlencode( $value ); }
*/

// This sample code uses the CURL library for php to establish a connection,
// submit the post, and record the response.
// If you receive an error, you may want to ensure that you have the curl
// library enabled in your php configuration
$request = curl_init($post_url); // initiate curl object
	curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
	curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
	$post_response = curl_exec($request); // execute curl post and store results in $post_response
	// additional options may be required depending upon your server configuration
	// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close ($request); // close curl object

// This line takes the response and breaks it into an array using the specified delimiting character
$response_array = explode($post_values["x_delim_char"],$post_response);
$response = str_replace("'", '', $response_array[0]);

// The results are output to the screen in the form of an html numbered list.

/*
echo "<OL>\n";
foreach ($response_array as $value)
{
	echo "<LI>" . $value . "&nbsp;</LI>\n";
	$i++;
}
echo "</OL>\n";
*/

// individual elements of the array could be accessed to read certain response
// fields.  For example, response_array[0] would return the Response Code,
// response_array[2] would return the Response Reason Code.
// for a list of response fields, please review the AIM Implementation Guide

//Input contact into the database
if($response == 1) {

	$con = mysql_connect("localhost","username","password");

	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db("dbname", $con);

	$sql = "INSERT INTO signup (date, type, price, name_first, name_last, title, company, category, address, city, state, zip, phone, email, email_work, birthday, gender) VALUES ('" . mysql_real_escape_string($formData[date]) . "', '" . mysql_real_escape_string($formData[type]) . "', '" . mysql_real_escape_string($formData[price]) . "', '" . mysql_real_escape_string($formData[name_first]) . "', '" . mysql_real_escape_string($formData[name_last]) . "', '" . mysql_real_escape_string($formData[title]) . "', '" . mysql_real_escape_string($formData[company]) . "', '" . mysql_real_escape_string($formData[category]) . "', '" . mysql_real_escape_string($formData[address]) . "', '" . mysql_real_escape_string($formData[city]) . "', '" . mysql_real_escape_string($formData[state]) . "', '" . mysql_real_escape_string($formData[zip]) . "', '" . mysql_real_escape_string($formData[phone]) . "', '" . mysql_real_escape_string($formData[email]) . "', '" . mysql_real_escape_string($formData[email_work]) . "', '" . mysql_real_escape_string($formData[birthday]) . "', '" . mysql_real_escape_string($formData[gender]) . "')";

	mysql_query($sql,$con);

	mysql_close($con);

	//Sending an email to the Membership Committee and the user

	$to = $formData["email"];

	$subject = 'Confirmation';

	$message = "
	<div style=\"font-family: Arial; font-size: 12px;\">

	<div><img src=\"http://www.website.org/images/email_logo.jpg\" /></div>

	<h1>Membership</h1>

	<h2>Personal Information</h2>

	<div>Type: $formData[type]</div>

	<div>Price: $$formData[price]</div>

	<div>Name : $formData[name_first] $formData[name_last]</div>

	<div>Title : $formData[title]</div>

	<div>Company : $formData[company]</div>

	<div>Category : $formData[category]</div>

	<div>Address : $formData[address]</div>

	<div>City : $formData[city]</div>

	<div>State : $formData[state]</div>

	<div>Zip : $formData[zip]</div>

	<div>Mobile Phone : $formData[phone]</div>

	<div>Personal Email : $formData[email]</div>

	<div>Work Email : $formData[email_work]</div>

	<div>Birthday : $formData[birthday]</div>

	<div>Gender : $formData[gender]</div>

	</div>
	";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'Bcc: membership@website.org,zachfire9@gmail.com' . "\r\n";
	$headers .= 'From: Website <membership@website.org>' . "\r\n";

	mail($to, $subject, $message, $headers);

}

?>

<?php $page = "membership";?>

<?php include("../includes/header.php") ?>

<script src="js/jquery-1.2.3.pack.js" type="text/javascript"></script>
<script src="js/jquery.printElement.js" type="text/javascript"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript">
$(document).ready(function() {
	$("#printButton").click(function() {
		$('#container').printElement({
            overrideElementCSS:[
			'thisWillBeTheCSSUsed.css',
			{ href:'css/style.css',media:'print'}]
		});
	});
});
</script>

	<div class="ContentHeaderLeft">

		<div class="ContentHeaderPaddingLeft">MEMBERSHIP</div>

	</div>

	<div class="MainPadding">

		<div id="container">

			<?php
			if($response != 1) {
				echo "<p align=\"center\">" . $response_array[3] . "</p>";
				echo "<p align=\"center\">Please go back and verify your information.</p>";
				echo "<p align=\"center\">If you continue to experience issues please email <a href=\"membership@website.org\">membership@website.org</a>.</p>";
			} else {
			?>

			<p id="printButton"><a href="#">Print Receipt</a></p>

			<h2>Personal Information</h2>

			<p style="padding-bottom:10px;">Get the latest news. Join our mailing list!</p>
			<div><a href="https://app.e2ma.net/app/view:Join/signupId:1416342/acctId:1407714" onclick="window.open('https://app.e2ma.net/app/view:Join/signupId:1416342/acctId:1407714', 'signup', 'menubar=no, location=no, toolbar=no, scrollbars=yes, height=500'); return false;"><img src="../images/newsletter_sign-up.png" alt="Click Here" width="330" height="57" border="0" /></a></div>

			<div class="price_info">
			<p>Type: <?php echo $formData["type"]; ?></p>
			<p>Price: $<?php echo $formData["price"]; ?></p>
			</div>

			<label for="name_first" class="form_label">Name :</label>
			<div><?php echo $formData["name_first"]; ?></div>

			<label for="name_last" class="form_label">Name :</label>
			<div><?php echo $formData["name_last"]; ?></div>

			<?php if(!empty($formData["title"])) { ?>
			<label for="title" class="form_label">Title :</label>
			<div><?php echo $formData["title"]; ?></div>
			<?php } ?>

			<?php if(!empty($formData["company"])) { ?>
			<label for="company" class="form_label">Company :</label>
			<div><?php echo $formData["company"]; ?></div>
			<?php } ?>

			<?php if(!empty($formData["category"])) { ?>
			<label for="category" class="form_label">Category :</label>
			<div><?php echo $formData["category"]; ?></div>
			<?php } ?>

			<label for="address" class="form_label">Address :</label>
			<div><?php echo $formData["address"]; ?></div>

			<label for="city" class="form_label">City :</label>
			<div><?php echo $formData["city"]; ?></div>

			<label for="state" class="form_label">State :</label>
			<div><?php echo $formData["state"]; ?></div>

			<label for="zip" class="form_label">Zip :</label>
			<div><?php echo $formData["zip"]; ?></div>

			<label for="phone" class="form_label">Mobile Phone :</label>
			<div><?php echo $formData["phone"]; ?></div>

			<label for="email" class="form_label">Personal Email :</label>
			<div><?php echo $formData["email"]; ?></div>

			<label for="email_work" class="form_label">Work Email :</label>
			<div><?php echo $formData["email_work"]; ?>&nbsp</div>

			<label for="birthday" class="form_label">Birthday :</label>
			<div><?php echo $formData["birthday"]; ?></div>

			<label for="gender" class="form_label">Gender :</label>
			<div><?php echo $formData["gender"]; ?></div>

			<h2>Credit Card Information</h2>

			<label for="card_name" class="form_label">Name :</label>
			<div><?php echo $formData["card_name_first"] . " " . $formData["card_name_last"]; ?></div>

			<label for="card_number" class="form_label">Number :</label>
			<div><?php echo $formData["card_number"]; ?></div>

			<label for="card_date" class="form_label">Date :</label>
			<div><?php echo $formData["card_date_month"]; ?>/<?php echo $formData["card_date_year"]; ?></div>

			<label for="card_code" class="form_label">Security Code :</label>
			<div><?php echo $formData["card_code"]; ?></div>

			<h3>Billing Address</h3>

			<label for="card_address" class="form_label">Address :</label>
			<div><?php echo $formData["card_address"]; ?></div>

			<label for="card_city" class="form_label">City :</label>
			<div><?php echo $formData["card_city"]; ?></div>

			<label for="card_state" class="form_label">State :</label>
			<div><?php echo $formData["card_state"]; ?></div>

			<label for="card_zip" class="form_label">Zip :</label>
			<div><?php echo $formData["card_zip"]; ?></div>

			<?php
			}
			?>

		</div>

	</div>

	<div class="MainContentClear"></div>

<?php include("../includes/footer.php") ?>
