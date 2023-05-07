<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
</head>
<body>
<h1>Register a User</h1>

<script>
function validateForm() {
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    if (firstName == "" || lastName == "") {
        alert("First and last name are required.");
        return false;
    }

    if (email == "" || password == "") {
        alert("Email address and password are required.");
        return false;
    }

    if (password.length < 8) {
        alert("Password must be at least 8 characters.");
        return false;
    }

    if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}
</script>

<form action="save-registration.php" method="POST" onsubmit="return validateForm()">
	<div>
		<label>First Name</label>
		<input type="text" name="first_name" id="first_name" placeholder="First Name" />	
	</div>
	<div>
		<label>Last Name</label>
		<input type="text" name="last_name" id="last_name" placeholder="Last Name" />	
	</div>
	<div>
		<label>Email Address</label>
		<input type="email" name="email" id="email" placeholder="email@address.com" />	
	</div>
	<div>
		<label>Password</label>
		<input type="password" name="password" id="password" />	
	</div>
	<div>
		<label>Confirm Password</label>
		<input type="password" name="confirm_password" id="confirm_password" />	
	</div>
	<div>
		<label>Birthdate</label>
		<input type="date" name="birthdate" />	
	</div>
	<div>
		<label>Gender</label><br/>
		<input type="radio" name="gender" value="Male" />Male<br/>
		<input type="radio" name="gender" value="Female" />Female<br/>	
	</div>
	<div>
		<label>Address</label>
		<input type="text" name="address" placeholder="Address" required/>	
	</div>
	<div>
		<label>Contact Number</label>
		<input type="number" name="contact_number" placeholder="Contact Number" required/>	
	</div>
	<div>
		<button type="submit">
			Register User
		</button>	
	</div>
</form>
</body>
</html>
