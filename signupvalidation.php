<?php

$username = null;
$username_error = null;
$password = null;
$password_error = null;
$confirm_password = null;
$confirm_password_error = null;
$passworderror = "Password Mismatch";;
$email = null;
$email_error = null;
$card_holder = null;
$card_holder_error = null;
$card_number = null;
$card_number_error = null;
$expiry_date = null;
$expiry_date_error = null;
$cvv = null;
$cvv_error = null;
$success = null;

if(!empty(isset($_POST['confirm']))){
	
// Database connection
    $conn = new mysqli("localhost", "root", "alanrussel0503", "bcdatabase");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	//username
    if (empty(trim($_POST["username"]))) {
        $username_error = "Field Username is empty";
    } else {
        $username = htmlspecialchars(trim($_POST["username"]));
    }
	//password
    if (empty(trim($_POST["password"]))) {
        $password_error = "Field Password is empty";
    } else {
        $password = htmlspecialchars(trim($_POST["password"]));
    }
	//confirm password
	if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_error = "Confirm your password";
    }
	else if ($_POST["password"] != $_POST["confirm_password"]) {
        $confirm_password_error = "Password Mismatch";
    }
	else {
        $confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));
    }
	//email
	if (empty(trim($_POST["email"]))) {
        $email_error = "Field Email is empty";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }
	//phone
	$phone_number = htmlspecialchars(trim($_POST['phone_number']));
	//cardholder
	if (empty(trim($_POST["card_holder"]))) {
        $card_holder_error = "Field Card Holder is empty";
    } else {
        $card_holder = htmlspecialchars(trim($_POST["card_holder"]));
    }
	//cardnumber
	if (empty(trim($_POST["card_number"]))) {
        $card_number_error = "Field Card Number is empty";
    } else {
        $card_number = htmlspecialchars(trim($_POST["card_number"]));
    }
	//exp date
	if (empty(trim($_POST["expiry_date"]))) {
        $expiry_date_error = "Field Expiration Date is empty";
    } else {
        $expiry_date = htmlspecialchars(trim($_POST["expiry_date"]));
    }
	//cvv
	if (empty(trim($_POST["cvv"]))) {
        $cvv_error = "Field CVV is empty";
    } else {
        $cvv = htmlspecialchars(trim($_POST["cvv"]));
    }
	if (empty($username_error) && empty($password_error) && empty($confirm_password_error) && empty($email_error) && (empty($phone_number)|| !empty($phone_number))&& empty($card_holder_error)&& empty($card_number_error)&& empty($expiry_date_error)&& empty($cvv_error)) {
	
		$stmt = $conn->prepare("INSERT INTO _user (username, password, email, phone_num) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $confirm_password, $email, $phone_number);
        
        if($stmt->execute()){
            $user_id = $stmt->insert_id; // Get the ID of the newly created user
            
            // Insert card data into cards table
            $stmt = $conn->prepare("INSERT INTO card_details (user_id, cardholder, card_number, exp_date, cvv) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $user_id, $card_holder, $card_number, $expiry_date, $cvv);
            if ($stmt->execute()) {

                //echo "<p style='color:green;'>User and Card details submitted successfully!</p>";
				header('location: successfulsignup.html');
            } else {
                header('location: signupfinal.php');
				$stmt->error;
            }
			$stmt = $conn->prepare("INSERT INTO _wallet (user_id) VALUES (?)");
            $stmt->bind_param("i", $user_id);
			$stmt->execute();
        }
		else{
            header('location: signupfinal.php');
			$stmt->error;
        }
        
        $stmt->close();
	
	}
// Close connection
$conn->close();
}

?>