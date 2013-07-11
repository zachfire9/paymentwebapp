<?php

switch(strtolower($_REQUEST["type"])) {
	case "student":
		$type = "Student";
		$price = "45";
		break;
	case "member":
		$type = "New Member";
		$price = "70";
		break;
	case "renewal":
		$type = "Renewal";
		$price = "70";
		break;
}
?>

<?php $page = "membership";?>

<?php include("../includes/header.php") ?>

	<script src="js/jquery-1.2.3.pack.js" type="text/javascript"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />

	<script>
	$(function () {
		$(".error").hide();
		$("#card_billing_address").click(function() {
			if($("#card_billing_address").is(':checked')) {
				$("#billing_address_info").hide();
			}
			else {
				$("#billing_address_info").show();
			}
		});

		$(".button").click(function() {
			$(".error").hide();
			var name_first = $("input#name_first").val();		
			var name_last = $("input#name_last").val();		
			var address = $("input#address").val();		
			var city = $("input#city").val();		
			var state = $("select#state").val();		
			var zip = $("input#zip").val();		
			var phone = $("input#phone").val();		
			var email = $("input#email").val();		
			var birthday = $("input#birthday").val();		
			var gender = $("select#gender").val();		
			var card_name_first = $("input#card_name_first").val();		
			var card_name_last = $("input#card_name_last").val();		
			var card_number = $("input#card_number").val();		
			var card_date_month = $("input#card_date_month").val();		
			var card_date_year = $("input#card_date_year").val();		
			var card_code = $("input#card_code").val();		
			var card_address = $("input#card_address").val();		
			var card_city = $("input#card_city").val();		
			var card_state = $("select#card_state").val();		
			var card_zip = $("input#card_zip").val();		

			if(name_first == "") {
				$("label#name_first_error").show();
				$("input#name_first").focus();
				return false;
			}

			if(name_last == "") {
				$("label#name_last_error").show();
				$("input#name_last").focus();
				return false;
			}

			if(address == "") {
				$("label#address_error").show();
				$("input#address").focus();
				return false;
			}

			if(city == "") {
				$("label#city_error").show();
				$("input#city").focus();
				return false;
			}

			if(state == "") {
				$("label#state_error").show();
				$("#state").focus();
				return false;
			}

			if(zip == "") {
				$("label#zip_error").show();
				$("input#zip").focus();
				return false;
			}

			if(phone == "") {
				$("label#phone_error").show();
				$("input#phone").focus();
				return false;
			}

			var email_filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
			if(!email_filter.test(email)){
				$("label#email_error").show();
				$("input#email").focus();
				return false;
			}

			var birthday_filter = /^(0[1-9]|1[012])\/(0[1-9]|[12][0-9]|3[01])\/(19|20)\d\d$/;
			if(!birthday_filter.test(birthday)) {
				$("label#birthday_error").show();
				$("input#birthday").focus();
				return false;
			}

			if(gender == "") {
				$("label#gender_error").show();
				$("#gender").focus();
				return false;
			}

			if(card_name_first == "") {
				$("label#card_name_first_error").show();
				$("input#card_name_first").focus();
				return false;
			}

			if(card_name_last == "") {
				$("label#card_name_last_error").show();
				$("input#card_name_last").focus();
				return false;
			}

			var number_filter = /^\d+$/;
			if(!number_filter.test(card_number)) {
				$("label#card_number_error").show();
				$("input#card_number").focus();
				return false;
			}

			if(!number_filter.test(card_date_month)) {
				$("label#card_date_error").show();
				$("input#card_date_month").focus();
				return false;
			}

			if(!number_filter.test(card_date_year)) {
				$("label#card_date_error").show();
				$("input#card_date_year").focus();
				return false;
			}

			if(!number_filter.test(card_code)) {
				$("label#card_code_error").show();
				$("input#card_code").focus();
				return false;
			}

			if(!$("#card_billing_address").is(":checked")) {

				if(card_address == "") {
					$("label#card_address_error").show();
					$("input#card_address").focus();
					return false;
				}

				if(card_city == "") {
					$("label#card_city_error").show();
					$("input#card_city").focus();
					return false;
				}

				if(card_state == "") {
					$("label#card_state_error").show();
					$("#card_state").focus();
					return false;
				}

				if(card_zip == "") {
					$("label#card_zip_error").show();
					$("input#card_zip").focus();
					return false;
				}

			}

		});
	});
	</script>

	<div class="ContentHeaderLeft">

		<div class="ContentHeaderPaddingLeft">MEMBERSHIP</div>

	</div>

	<div class="MainPadding">

		<div id="container">

			<h2>Personal Information</h2>

			<div class="price_info">
			<p>Type: <?php echo $type; ?></p>
			<p>Price: $<?php echo $price; ?></p>
			<p class="required" style="font-size:12px;">* Required Field</p>
			</div>
			<?php 
			if (isset($_REQUEST["error"])) {
				echo "<p style=\"color:red\">You submitted the form with some information missing.</p>";
			}
			?>

			<form name="membership" action="action.php" method="post">

				<label for="name_first" class="form_label">First Name :</label>
				<input type="text" name="name_first" value="<?php echo $_REQUEST["name_first"]; ?>" id="name_first" size="30" class="text-input" />
				<label class="required">*</label>
				<label class="error" for="name_first" id="name_first_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["name_first"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="name_last" class="form_label">Last Name :</label>
				<input type="text" name="name_last" value="<?php echo $_REQUEST["name_last"]; ?>" id="name_last" size="30" class="text-input" />
				<label class="required">*</label>
				<label class="error" for="name_last" id="name_last_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["name_last"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="title" class="form_label">Title :</label>
				<input type="text" name="title" value="<?php echo $_REQUEST["title"]; ?>" id="title" size="30" class="text-input" />
				<label class="error" for="title" id="title_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["title"])) { echo " style=\"display:inline\""; } ?>></label><br />

				<label for="company" class="form_label">Company :</label>
				<input type="text" name="company" value="<?php echo $_REQUEST["company"]; ?>" id="company" size="30" class="text-input" />
				<label class="error" for="company" id="company_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["company"])) { echo " style=\"display:inline\""; } ?>></label><br />

				<label for="category" class="form_label">Business Category :</label>
				<select name="category" id="category" class="text-input">
					<option value=""></option>
					<option value="Advertising Agencies"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Advertising Agencies") { echo " selected"; } ?>>Advertising Agencies</option>

					<option value="Art Direction / Graphic Design"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Art Direction / Graphic Design") { echo " selected"; } ?>>Art Direction / Graphic Design</option>
					<option value="Client"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Client") { echo " selected"; } ?>>Client</option>
					<option value="Computer / Interactive / Internet"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Computer / Interactive / Internet") { echo " selected"; } ?>>Computer / Interactive / Internet</option>
					<option value="Copywriting"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Copywriting") { echo " selected"; } ?>>Copywriting</option>
					<option value="Direct Mail Fulfillment"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Direct Mail Fulfillment") { echo " selected"; } ?>>Direct Mail Fulfillment</option>
					<option value="Educational Institution"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Educational Institution") { echo " selected"; } ?>>Educational Institution</option>

					<option value="Financial Services"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Financial Services") { echo " selected"; } ?>>Financial Services</option>
					<option value="Illustration"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Illustration") { echo " selected"; } ?>>Illustration</option>
					<option value="In-House Marketing Agencies"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "In-House Marketing Agencies") { echo " selected"; } ?>>In-House Marketing Agencies</option>
					<option value="Location Photography, Film / Video"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Location Photography, Film / Video") { echo " selected"; } ?>>Location Photography, Film / Video</option>
					<option value="Marketing Consulting"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Marketing Consulting") { echo " selected"; } ?>>Marketing Consulting</option>
					<option value="Media"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Media") { echo " selected"; } ?>>Media</option>

					<option value="Other Advertising"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Other Advertising") { echo " selected"; } ?>>Other Advertising</option>
					<option value="Newspapers"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Newspapers") { echo " selected"; } ?>>Newspapers</option>
					<option value="Photography"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Photography") { echo " selected"; } ?>>Photography</option>
					<option value="Pre-Production for Print"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Pre-Production for Print") { echo " selected"; } ?>>Pre-Production for Print</option>
					<option value="Printing / Duplication"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Printing / Duplication") { echo " selected"; } ?>>Printing / Duplication</option>
					<option value="Print: Magazines / Publications"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Print: Magazines / Publications") { echo " selected"; } ?>>Print: Magazines / Publications</option>

					<option value="Public Relations"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Public Relations") { echo " selected"; } ?>>Public Relations</option>
					<option value="Radio"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Radio") { echo " selected"; } ?>>Radio</option>
					<option value="Services: Courier / Delivery Service"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Services: Courier / Delivery Service") { echo " selected"; } ?>>Services: Courier / Delivery Service</option>
					<option value="Sales Displays"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Sales Displays") { echo " selected"; } ?>>Sales Displays</option>
					<option value="Signs &amp; Banners"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Signs &amp; Banners") { echo " selected"; } ?>>Signs &amp; Banners</option>

					<option value="Specialty Advertising"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Specialty Advertising") { echo " selected"; } ?>>Specialty Advertising</option>
					<option value="Student"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Student") { echo " selected"; } ?>>Student</option>
					<option value="Outdoor Advertising"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Outdoor Advertising") { echo " selected"; } ?>>Outdoor Advertising</option>
					<option value="Non-Profit"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Non-Profit") { echo " selected"; } ?>>Non-Profit</option>
					<option value="Audio/Video Production"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Audio/Video Production") { echo " selected"; } ?>>Audio/Video Production</option>
					<option value="Recording Studio"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Recording Studio") { echo " selected"; } ?>>Recording Studio</option>

					<option value="Web Site Hosting"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Web Site Hosting") { echo " selected"; } ?>>Web Site Hosting</option>
					<option value="Advertising Agencies / Spanish"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Advertising Agencies / Spanish") { echo " selected"; } ?>>Advertising Agencies / Spanish</option>
					<option value="Suppliers"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Suppliers") { echo " selected"; } ?>>Suppliers</option>
					<option value="Model Agency"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Model Agency") { echo " selected"; } ?>>Model Agency</option>
					<option value="Event Planning"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Event Planning") { echo " selected"; } ?>>Event Planning</option>
					<option value="Talent Agency"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Talent Agency") { echo " selected"; } ?>>Talent Agency</option>

					<option value="Market Research"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Market Research") { echo " selected"; } ?>>Market Research</option>
					<option value="Television"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Television") { echo " selected"; } ?>>Television</option>
					<option value="Cable Television"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Cable Television") { echo " selected"; } ?>>Cable Television</option>
					<option value="Web Design / Web Hosting"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Web Design / Web Hosting") { echo " selected"; } ?>>Web Design / Web Hosting</option>
					<option value="Experiential/Event Marketing Agency"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Experiential/Event Marketing Agency") { echo " selected"; } ?>>Experiential/Event Marketing Agency</option>
					<option value="Online Media Agency"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Online Media Agency") { echo " selected"; } ?>>Online Media Agency</option>

					<option value="Mobile Marketing Agency"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Mobile Marketing Agency") { echo " selected"; } ?>>Mobile Marketing Agency</option>
					<option value="Small Sized Business - Other"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Small Sized Business - Other") { echo " selected"; } ?>>Small Sized Business - Other</option>
					<option value="Medium Sized Business - Other"<?php if(isset($_REQUEST["error"]) && $_REQUEST["category"] == "Medium Sized Business - Other") { echo " selected"; } ?>>Medium Sized Business - Other</option>
				</select>
				<label class="error" for="category" id="category_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["category"])) { echo " style=\"display:inline\""; } ?>></label><br />

				<label for="address" class="form_label">Address :</label>
				<input type="text" name="address" value="<?php echo $_REQUEST["address"]; ?>" id="address" size="30" class="text-input" />
				<label class="required">*</label>
				<label class="error" for="address" id="address_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["address"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="city" class="form_label">City :</label>
				<input type="text" name="city" value="<?php echo $_REQUEST["city"]; ?>" id="city" size="30" class="text-input" />
				<label class="required">*</label>
				<label class="error" for="city" id="city_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["city"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="state" class="form_label">State :</label>
				<select name="state" id="state" class="text-input">
					<option value=""></option>
					<option value="AL"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "AL") { echo " selected"; } ?>>Alabama</option>
					<option value="AK"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "AK") { echo " selected"; } ?>>Alaska</option>
					<option value="AZ"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "AZ") { echo " selected"; } ?>>Arizona</option>
					<option value="AR"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "AR") { echo " selected"; } ?>>Arkansas</option>
					<option value="CA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "CA") { echo " selected"; } ?>>California</option>
					<option value="CO"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "CO") { echo " selected"; } ?>>Colorado</option>
					<option value="CT"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "CT") { echo " selected"; } ?>>Connecticut</option>
					<option value="DE"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "DE") { echo " selected"; } ?>>Delaware</option>
					<option value="DC"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "DC") { echo " selected"; } ?>>District of Columbia</option>
					<option value="FL"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "FL") { echo " selected"; } ?>>Florida</option>
					<option value="GA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "GA") { echo " selected"; } ?>>Georgia</option>
					<option value="HI"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "HI") { echo " selected"; } ?>>Hawaii</option>
					<option value="ID"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "ID") { echo " selected"; } ?>>Idaho</option>
					<option value="IL"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "IL") { echo " selected"; } ?>>Illinois</option>
					<option value="IN"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "IN") { echo " selected"; } ?>>Indiana</option>
					<option value="IA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "IA") { echo " selected"; } ?>>Iowa</option>
					<option value="KS"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "KS") { echo " selected"; } ?>>Kansas</option>
					<option value="KY"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "KY") { echo " selected"; } ?>>Kentucky</option>
					<option value="LA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "LA") { echo " selected"; } ?>>Louisiana</option>
					<option value="ME"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "ME") { echo " selected"; } ?>>Maine</option>
					<option value="MD"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "MD") { echo " selected"; } ?>>Maryland</option>
					<option value="MA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "MA") { echo " selected"; } ?>>Massachusetts</option>
					<option value="MI"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "MI") { echo " selected"; } ?>>Michigan</option>
					<option value="MN"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "MN") { echo " selected"; } ?>>Minnesota</option>
					<option value="MS"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "MS") { echo " selected"; } ?>>Mississippi</option>
					<option value="MO"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "MO") { echo " selected"; } ?>>Missouri</option>
					<option value="MT"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "MT") { echo " selected"; } ?>>Montana</option>
					<option value="NE"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "NE") { echo " selected"; } ?>>Nebraska</option>
					<option value="NV"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "NV") { echo " selected"; } ?>>Nevada</option>
					<option value="NH"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "NH") { echo " selected"; } ?>>New Hampshire</option>
					<option value="NJ"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "NJ") { echo " selected"; } ?>>New Jersey</option>
					<option value="NM"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "NM") { echo " selected"; } ?>>New Mexico</option>
					<option value="NY"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "NY") { echo " selected"; } ?>>New York</option>
					<option value="NC"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "NC") { echo " selected"; } ?>>North Carolina</option>
					<option value="ND"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "ND") { echo " selected"; } ?>>North Dakota</option>
					<option value="OH"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "OH") { echo " selected"; } ?>>Ohio</option>
					<option value="OK"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "OK") { echo " selected"; } ?>>Oklahoma</option>
					<option value="OR"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "OR") { echo " selected"; } ?>>Oregon</option>
					<option value="PA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "PA") { echo " selected"; } ?>>Pennsylvania</option>
					<option value="RI"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "RI") { echo " selected"; } ?>>Rhode Island</option>
					<option value="SC"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "SC") { echo " selected"; } ?>>South Carolina</option>
					<option value="SD"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "SD") { echo " selected"; } ?>>South Dakota</option>
					<option value="TN"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "TN") { echo " selected"; } ?>>Tennessee</option>
					<option value="TX"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "TX") { echo " selected"; } ?>>Texas</option>
					<option value="UT"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "UT") { echo " selected"; } ?>>Utah</option>
					<option value="VT"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "VT") { echo " selected"; } ?>>Vermont</option>
					<option value="VA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "VA") { echo " selected"; } ?>>Virginia</option>
					<option value="WA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "WA") { echo " selected"; } ?>>Washington</option>
					<option value="WV"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "WV") { echo " selected"; } ?>>West Virginia</option>
					<option value="WI"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "WI") { echo " selected"; } ?>>Wisconsin</option>
					<option value="WY"<?php if(isset($_REQUEST["error"]) && $_REQUEST["state"] == "WY") { echo " selected"; } ?>>Wyoming</option>
				</select>
				<label class="required">*</label>
				<label class="error" for="state" id="state_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["state"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="zip" class="form_label">Zip :</label>
				<input type="text" name="zip" value="<?php echo $_REQUEST["zip"]; ?>" id="zip" size="30" class="text-input" />
				<label class="required">*</label>
				<label class="error" for="zip" id="zip_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["zip"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="phone" class="form_label">Mobile Phone :</label>
				<input type="text" name="phone" value="<?php echo $_REQUEST["phone"]; ?>" id="phone" size="30" class="text-input" />
				<label class="required">*</label>
				<label class="error" for="phone" id="phone_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["phone"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="email" class="form_label">Personal Email :</label>
				<input type="text" name="email" value="<?php echo $_REQUEST["email"]; ?>" id="email" size="30" class="text-input" />
				<label class="required">*</label>
				<label class="error" for="email" id="email_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["email"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="email_work" class="form_label">Work Email :</label>
				<input type="text" name="email_work" value="<?php echo $_REQUEST["email_work"]; ?>" id="email_work" size="30" class="text-input" /><br />

				<label for="birthday" class="form_label">Birthday :</label>
				<input type="text" name="birthday" value="<?php echo $_REQUEST["birthday"]; ?>" id="birthday" size="30" maxlength="10" class="text-input" /> (MM/DD/YYYY)
				<label class="required">*</label>
				<label class="error" for="birthday" id="birthday_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["birthday"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="gender" class="form_label">Gender :</label>
				<select name="gender" id="gender" class="text-input">
					<option value=""></option>
					<option value="Male"<?php if(isset($_REQUEST["error"]) && $_REQUEST["gender"] == "Male") { echo " selected"; } ?>>Male</option>
					<option value="Female"<?php if(isset($_REQUEST["error"]) && $_REQUEST["gender"] == "Female") { echo " selected"; } ?>>Female</option>
				</select>
				<label class="required">*</label>
				<label class="error" for="gender" id="gender_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["gender"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<h2>Credit Card Information</h2>

				<label for="card_name_first" class="form_label">First Name :</label>
				<input type="text" name="card_name_first" value="<?php echo $_REQUEST["card_name_first"]; ?>" id="card_name_first" size="30" class="text-input" /> (As it appears on card)
				<label class="required">*</label>
				<label class="error" for="card_name_first" id="card_name_first_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_name_first"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="card_name_last" class="form_label">Last Name :</label>
				<input type="text" name="card_name_last" value="<?php echo $_REQUEST["card_name_last"]; ?>" id="card_name_last" size="30" class="text-input" />
				<label class="required">*</label>
				<label class="error" for="card_name_last" id="card_name_last_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_name_last"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="card_number" class="form_label">Number :</label>
				<input type="text" name="card_number" value="<?php echo $_REQUEST["card_number"]; ?>" id="card_number" size="30" maxlength="16" class="text-input" /> (No Dashes)
				<label class="required">*</label>
				<label class="error" for="card_number" id="card_number_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_number"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="card_date_month" class="form_label">Exp Date :</label>
				<input type="text" name="card_date_month" value="<?php echo $_REQUEST["card_date_month"]; ?>" id="card_date_month" size="2" maxlength="2" class="text-input" /> /
				<input type="text" name="card_date_year" value="<?php echo $_REQUEST["card_date_year"]; ?>" id="card_date_year" size="2" maxlength="2" class="text-input" /> (MM/YY)
				<label class="required">*</label>
				<label class="error" for="card_date" id="card_date_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_date_month"]) || isset($_REQUEST["error"]) && !isset($_REQUEST["card_date_year"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<label for="card_code" class="form_label">Security Code :</label>
				<input type="text" name="card_code" value="<?php echo $_REQUEST["card_code"]; ?>" id="card_code" size="4" maxlength="4" class="text-input" /> (On back of card)
				<label class="required">*</label>
				<label class="error" for="card_code" id="card_code_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_code"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				<h3>Billing Address</h3>

				<input type="checkbox" name="card_billing_address" id="card_billing_address" value="" />
				<label>Same as personal address</label><br />

				<div id="billing_address_info">

					<label for="card_address" class="form_label">Address :</label>
					<input type="text" name="card_address" value="<?php echo $_REQUEST["card_address"]; ?>" id="card_address" size="30" class="text-input" />
					<label class="error" for="card_address" id="card_address_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_address"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

					<label for="card_city" class="form_label">City :</label>
					<input type="text" name="card_city" value="<?php echo $_REQUEST["card_city"]; ?>" id="card_city" size="30" class="text-input" />
					<label class="error" for="card_city" id="card_city_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_city"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

					<label for="card_state" class="form_label">State :</label>
					<select name="card_state" id="card_state" class="text-input">
						<option value=""></option>
						<option value="AL"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "AL") { echo " selected"; } ?>>Alabama</option>
						<option value="AK"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "AK") { echo " selected"; } ?>>Alaska</option>
						<option value="AZ"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "AZ") { echo " selected"; } ?>>Arizona</option>
						<option value="AR"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "AR") { echo " selected"; } ?>>Arkansas</option>
						<option value="CA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "CA") { echo " selected"; } ?>>California</option>
						<option value="CO"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "CO") { echo " selected"; } ?>>Colorado</option>
						<option value="CT"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "CT") { echo " selected"; } ?>>Connecticut</option>
						<option value="DE"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "DE") { echo " selected"; } ?>>Delaware</option>
						<option value="DC"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "DC") { echo " selected"; } ?>>District of Columbia</option>
						<option value="FL"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "FL") { echo " selected"; } ?>>Florida</option>
						<option value="GA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "GA") { echo " selected"; } ?>>Georgia</option>
						<option value="HI"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "HI") { echo " selected"; } ?>>Hawaii</option>
						<option value="ID"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "ID") { echo " selected"; } ?>>Idaho</option>
						<option value="IL"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "IL") { echo " selected"; } ?>>Illinois</option>
						<option value="IN"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "IN") { echo " selected"; } ?>>Indiana</option>
						<option value="IA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "IA") { echo " selected"; } ?>>Iowa</option>
						<option value="KS"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "KS") { echo " selected"; } ?>>Kansas</option>
						<option value="KY"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "KY") { echo " selected"; } ?>>Kentucky</option>
						<option value="LA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "LA") { echo " selected"; } ?>>Louisiana</option>
						<option value="ME"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "ME") { echo " selected"; } ?>>Maine</option>
						<option value="MD"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "MD") { echo " selected"; } ?>>Maryland</option>
						<option value="MA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "MA") { echo " selected"; } ?>>Massachusetts</option>
						<option value="MI"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "MI") { echo " selected"; } ?>>Michigan</option>
						<option value="MN"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "MN") { echo " selected"; } ?>>Minnesota</option>
						<option value="MS"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "MS") { echo " selected"; } ?>>Mississippi</option>
						<option value="MO"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "MO") { echo " selected"; } ?>>Missouri</option>
						<option value="MT"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "MT") { echo " selected"; } ?>>Montana</option>
						<option value="NE"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "NE") { echo " selected"; } ?>>Nebraska</option>
						<option value="NV"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "NV") { echo " selected"; } ?>>Nevada</option>
						<option value="NH"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "NH") { echo " selected"; } ?>>New Hampshire</option>
						<option value="NJ"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "NJ") { echo " selected"; } ?>>New Jersey</option>
						<option value="NM"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "NM") { echo " selected"; } ?>>New Mexico</option>
						<option value="NY"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "NY") { echo " selected"; } ?>>New York</option>
						<option value="NC"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "NC") { echo " selected"; } ?>>North Carolina</option>
						<option value="ND"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "ND") { echo " selected"; } ?>>North Dakota</option>
						<option value="OH"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "OH") { echo " selected"; } ?>>Ohio</option>
						<option value="OK"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "OK") { echo " selected"; } ?>>Oklahoma</option>
						<option value="OR"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "OR") { echo " selected"; } ?>>Oregon</option>
						<option value="PA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "PA") { echo " selected"; } ?>>Pennsylvania</option>
						<option value="RI"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "RI") { echo " selected"; } ?>>Rhode Island</option>
						<option value="SC"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "SC") { echo " selected"; } ?>>South Carolina</option>
						<option value="SD"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "SD") { echo " selected"; } ?>>South Dakota</option>
						<option value="TN"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "TN") { echo " selected"; } ?>>Tennessee</option>
						<option value="TX"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "TX") { echo " selected"; } ?>>Texas</option>
						<option value="UT"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "UT") { echo " selected"; } ?>>Utah</option>
						<option value="VT"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "VT") { echo " selected"; } ?>>Vermont</option>
						<option value="VA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "VA") { echo " selected"; } ?>>Virginia</option>
						<option value="WA"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "WA") { echo " selected"; } ?>>Washington</option>
						<option value="WV"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "WV") { echo " selected"; } ?>>West Virginia</option>
						<option value="WI"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "WI") { echo " selected"; } ?>>Wisconsin</option>
						<option value="WY"<?php if(isset($_REQUEST["error"]) && $_REQUEST["card_state"] == "WY") { echo " selected"; } ?>>Wyoming</option>
					</select>
					<label class="error" for="card_state" id="card_state_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_state"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

					<label for="card_zip" class="form_label">Zip :</label>
					<input type="text" name="card_zip" value="<?php echo $_REQUEST["card_zip"]; ?>" id="card_zip" size="30" class="text-input" />
					<label class="error" for="card_zip" id="card_zip_error"<?php if(isset($_REQUEST["error"]) && !isset($_REQUEST["card_zip"])) { echo " style=\"display:inline\""; } ?>>This field is required.</label><br />

				</div>

				<input type="hidden" name="type" value="<?php echo $type; ?>" />
				<input type="hidden" name="price" value="<?php echo $price; ?>" />

				<input type="submit" name="submit" class="button" id="submit_btn" value="Submit Payment" />

			<form>

		</div>

	</div>

	<div class="MainContentClear"></div>

<?php include("../includes/footer.php") ?>
