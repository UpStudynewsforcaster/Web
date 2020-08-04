<?php

$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$password=$_POST['password'];
$gender=$_POST['gender'];
$DateOfBirth=$_POST['birthday'];
$email=$_POST['email'];
$PhoneCode=$_POST['phoneCode'];
$phone=$_POST['phone'];
$interest=$_POST['interest'];

if (!empty($firstName)||!empty($lastName)||!empty($Password)||!empty($gender)||
	!empty($birthday)||!empty($email)||!empty($phoneCode)||!empty($phone)|| 
	!empty($interest)) {
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "youtube";
//create connection
	$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

	if(mysqli_connect_error()){
		die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
	}else{
		$SELECT = "SELECT email from register Where email = ? Limit 1";
		$INSERT = "INSERT Into register (firstName,lastName,password,gender,birthday,email,phoneCode,phone,interest)values(?,?,?,?,?,?,?,?)";
		//prepare statement
		$stmt=$conn->prepare($SELECT);
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum =$stmt->num_rows;
		if ($rnum==0) {
			$stmt->close();
			$stmt=$conn->prepare($INSERT);
			$stmt->bind_param("ssssii",$firstName,$lastName,$password,$gender,$birthday,$email,$phoneCode,$phone,$interest);
			$stmt->execute();
			echo"New  Record inserted successfully!";
}else{
	echo"someone already using this email";}
	$stmt->close();
	$conn->close();
	}

}else{
	echo "All fields are required";
	die();
}

?>