<?php

require "config.php";

use App\User;

// Save the user information, and automatically login the user

try {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$birthdate= $_POST['birthdate'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$contact_number = $_POST['contact_number'];
	
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	$result = User::register($first_name, $last_name, $email, $hashed_password, $birthdate, $gender, $address, $contact_number);

	if ($result) {

		// Set the logged in session variable and redirect user to index page

		$_SESSION['is_logged_in'] = true;
		$_SESSION['user'] = [
			'id' => $result,
			'fullname' => $first_name . ' ' . $last_name,
			'email' => $email,
			'birthdate' => $birthdate,
			'gender' => $gender,
			'address' => $address,
			'contact_number' => $contact_number,
		];
		header('Location: index.php');
	}

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}
