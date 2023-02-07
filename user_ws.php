<?php

function getUserList() {

	/*The following data will actually be fetched from database or any external service*/
	/*$user1 = new StdClass();
	$user1->LastName = 'Tester';
	$user1->FirstName = 'Jane';
	$user1->Email = 'jtester@testco.com';
	
	$user2 = new StdClass();
	$user2->LastName = 'Tester 2';
	$user2->FirstName = 'Jhon';
	$user2->Email = 'jtester2@testco.com';
	
	$users = array();
	$users[0] = $user1;
	$users[1] = $user2;
	
	$Users = new StdClass();
	$Users->User = $users;
	
	return $Users;*/

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "soap_database";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	  }
	  echo "Connected successfully";
	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn,$sql);
	$users = array();
	$Users = new StdClass();
	echo var_dump($result);
	$inc = 0;
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			$user1 = new stdClass();
			$user1->LastName = $row["lastname"];
			$user1->FirstName = $row["firstname"];
			$user1->Email = $row["email"];
			$users[$inc] = $user1;
			$Users->User=$users;
			$inc=$inc+1;
		}
		return $Users;
	}
	//return $Users;
}

// Disable WSDL cache during development.
//ini_set("soap.wsdl_cache_enabled", "0"); 

// Create SOAP server object to serve the web service.
$server = new SoapServer("user.wsdl");

// Add the web service methods to the server to handle them.
$server->addFunction("getUserList");

$server->handle();
