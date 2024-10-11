<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="profile.css"/>
    <link rel="stylesheet" href="navigation_bar.css">
    <title>Navigation Bar Test</title>
</head>
<body class="vh-100 overflow-hidden">
<?php include 'navigation_bar.php'; ?>
<?php
session_start(); // Start the session to access session variables

if (!isset($_SESSION['username'])) {  // Check if the user is logged in by checking the session variable
    die("You must be logged in to view your details.");
}

//Connect to Database
$host = "localhost";
$user = "root";
$pass = "alanrussel0503";
$db = "BCDatabase";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Get the username from the session
$username = $_SESSION['username'];

//SQL query to retrieve the user detail
$query = "SELECT user_id,username, email, phone_num FROM _user WHERE username = '$username'";

//Execute the query
$result = mysqli_query($conn, $query);

// Check if the query returned a result
if ($row = mysqli_fetch_assoc($result)) {
    // Display the user's details
	$user_id = $row['user_id'];
    $user_name = $row['username'];
    $email = $row['email'];
    $phone_num = $row['phone_num'];
} else {
    echo "User details not found.";
}
// Close the connection
mysqli_close($conn);
?>
    <div class="container mt-5">
        <div class="row">
            <!-- Left Side: User Information -->
            <div class="col-md-4">
                <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                    <!-- Profile Picture -->
                    <form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data">
                        <div class="text-center mb-3">
                            <img src="profile_pics/<?php echo $user_id; ?>.jpg" alt="Profile Picture" class="img-fluid rounded-circle" width="150">
                            <input type="file" name="profile_pic" class="form-control mt-2">
                            <button type="submit" class="btn btn-primary mt-2">Upload New Picture</button>
                        </div>
                    </form>
                    <!-- User Details -->
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>User ID:</strong> <?php echo $user_id; ?></li>
						<li class="list-group-item"><strong>Username:</strong> <?php echo $user_name; ?></li>
                        <li class="list-group-item"><strong>Email:</strong> <?php echo $email; ?></li>
                        <li class="list-group-item"><strong>Phone Number:</strong> <?php echo $phone_num; ?></li>
                    </ul>
                </div>
            </div>

            <!-- Right Side: Placeholder for more content -->
            <div class="col-md-8">
                <!-- Future content can go here -->
            </div>
        </div>
    </div>
</body>
</html>
</body>
</html>