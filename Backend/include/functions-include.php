<?php
//verify login
//Hashing
function Verifylogin($connect,$Username,$Password){
	//and BINARY password = '$hashpassword'
	$sql = "Select * from _users where BINARY username = '$Username' ";
	$result = $connect->query($sql);
    if ($result->num_rows > 0) {
		$gethash = "SELECT password FROM _users WHERE username = '$Username'";
		$fetchhash = $connect->query($gethash);
		$user_row = $fetchhash->fetch_assoc();
		$storedhash = $user_row['password'];
		
		if(password_verify($Password,$storedhash)){
			$getid = "SELECT user_id FROM _users WHERE username = '$Username'";
			$idresult = $connect->query($getid);
		
			if ($user_row = $idresult->fetch_assoc()) {
				$user_id = $user_row['user_id'];
			} else {
				die("User not found.");
			}
			$getrole = "SELECT role_id FROM users_roles WHERE user_id = '$user_id'";
			$roleidresult = $connect->query($getrole);
			
			if ($role_row = $roleidresult->fetch_assoc()) {
				$role_id = $role_row['role_id'];
				if($role_id == '1'){
					echo "Login successful as User!";
					$_SESSION['username'] = $Username;
					$_SESSION['user_id'] = $user_id;
					header('Location: ..\..\Frontend\Home\Home.php');
					return true;
					exit();
				}
				elseif($role_id == '2'){
					echo "Login successful as Admin!";
					$_SESSION['username'] = $Username;
					$_SESSION['user_id'] = $user_id;
					return true;
					exit();
				}
				// can add other roles if ever..
			}
		}
		else {
			header("Location: ..\..\Frontend\Login\LoginPage.php?error=account_not_found");
			return false;
			exit();
		}
    }
	else {
		header("Location: ..\..\Frontend\Login\LoginPage.php?error=account_not_found");
		return false;
		exit();
	}
}

//Without Hashing
/*function Verifylogin($connect,$Username,$Password){
	$sql = "Select * from _users where BINARY username = '$Username' and BINARY password = '$Password'";
	$result = $connect->query($sql);
    if ($result->num_rows > 0) {
		$getid = "SELECT user_id FROM _users WHERE username = '$Username'";
		$idresult = $connect->query($getid);
		
		if ($user_row = $idresult->fetch_assoc()) {
			$user_id = $user_row['user_id'];
		} else {
			die("User not found.");
		}
		$getrole = "SELECT role_id FROM users_roles WHERE user_id = '$user_id'";
		$roleidresult = $connect->query($getrole);
		
		if ($role_row = $roleidresult->fetch_assoc()) {
			$role_id = $role_row['role_id'];
			if($role_id == '1'){
				echo "Login successful as User!";
				$_SESSION['username'] = $Username;
				$_SESSION['user_id'] = $user_id;
				header('Location: ..\..\Frontend\Home\Home.php');
				return true;
				exit();
			}
			elseif($role_id == '2'){
				echo "Login successful as Admin!";
				$_SESSION['username'] = $Username;
				$_SESSION['user_id'] = $user_id;
				return true;
				exit();
			}
			// can add other roles if ever..
		}
    }
	else {
		header("Location: ..\..\Frontend\Login\LoginPage.php?error=account_not_found");
		return false;
		exit();
	}
}*/

//signing up users
function Inserttouser($connect,$username,$firstname,$lastname, $confirm_password, $email, $phone_number){
	$hashedpassword = password_hash($confirm_password,PASSWORD_DEFAULT);
	$stmt = $connect->prepare("INSERT INTO _users (username, fname, lname, password, email, phone_num) VALUES (? , ? , ? , ? , ? , ?)");
	$stmt->bind_param("sssssi", $username,$firstname,$lastname, $hashedpassword, $email, $phone_number);
        
        if($stmt->execute()){
            $user_id = $stmt->insert_id; // Get the ID of the newly created user
            
            // Insert card data into cards table
            $stmt = $connect->prepare("INSERT INTO users_roles (user_id) VALUES (?)");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
			
			$stmt = $connect->prepare("INSERT INTO _wallet (user_id) VALUES (?)");
            $stmt->bind_param("i", $user_id);
			$stmt->execute();
			
			header('location: ..\..\Frontend\Signup\successfulsignup.php');
        }
		else{
            header('location: SignUpPage.php');
			$stmt->error;
        }
	//close statement
	$stmt->close();
}
?>