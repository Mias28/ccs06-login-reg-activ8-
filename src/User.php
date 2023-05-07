<?php

namespace App;

use PDO;

class User
{
	protected $id;
	protected $first_name;
	protected $last_name;
	protected $email;
	protected $password;
	protected $birthdate;
	protected $gender;
	protected $address;
	protected $contact_number;
	protected $created_at;

	public function getId()
	{
		return $this->id;
	}

	public function getFullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	public function getEmail()
	{
		return $this->email;
	}
	public function getpassword()
	{
		return $this->password;
	}
	public function getconfirm_password()
	{
		return $this->password;
	}
	public function getbirthdate()
	{
		return $this->birthdate;
	}
	public function getgender()
	{
		return $this->gender;
	}
	public function getaddress()
	{
		return $this->address;
	}
	public function getcontact_number()
	{
		return $this->contact_number;
	}

	public static function getById($id)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM users
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\User');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function hashPassword($password)
{
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Return the hashed password
    return $hashed_password;
}


	public static function attemptLogin($email, $password)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM users
				WHERE email=:email
					AND pass=:pass
				LIMIT 1
			";
			$statement = $conn->prepare($sql);

			// Perform password hash verification (if necessary)
		

			$statement->execute([
				'email' => $email,
				'password' => $password,
			]);
			$result = $statement->fetchObject('App\User');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($first_name, $last_name, $email, $password,$birthdate,$gender,$address,$contact_number)
	{
		global $conn;

		try {
			// Hash the password before inserting it to DB
			// ..

			$sql = "
				INSERT INTO users (first_name, last_name, email, password, birthdate, gender, address, contact_number)
				VALUES ('$first_name', '$last_name', '$email', '$password', '$birthdate', '$gender', '$address', '$contact_number')
			";
			$conn->exec($sql);
			// echo "<li>Executed SQL query " . $sql;
			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($users)
	{
		global $conn;

		try {
			foreach ($users as $user) {
				// Hash the password before inserting it to DB
				$hashed_password = self::hashPassword($user['password']);

				$sql = "
					INSERT INTO users
					SET
						first_name=\"{$user['first_name']}\",
						last_name=\"{$user['last_name']}\",
						email=\"{$user['email']}\",
						password=\"{$user['password']}\",
						birthdate=\"{$user['birthdate']}\",
						gender=\"{$user['gender']}\",
						adddress=\"{$user['address']}\",
						contact_number=\"{$user['contact_number']}\"
				";
				$conn->exec($sql);
				// echo "<li>Executed SQL query " . $sql;
			}
			return true;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}