<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("You must be logged in to update your wallet.");
}

// Database connection details
$host = "localhost";
$user = "root";
$pass = "alanrussel0503";
$db = "BCDatabase";

// Connect to the MySQL database
$conn = mysqli_connect($host, $user, $pass, $db);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the username from the session
$username = $_SESSION['username'];

// Retrieve the user's ID from the _user table
$user_query = "SELECT user_id FROM _user WHERE username = '$username'";
$user_result = mysqli_query($conn, $user_query);

if ($user_row = mysqli_fetch_assoc($user_result)) {
    $user_id = $user_row['user_id'];
} else {
    die("User not found.");
}

// Check if the form is submitted
if(!isset($_POST['submits'])) {
    // Get the new wallet amount from the form
    $new_amount = $_POST['currency'];

    // Retrieve the wallet associated with the user
    $wallet_query = "SELECT wallet_id FROM _wallet WHERE user_id = '$user_id'";
    $wallet_result = mysqli_query($conn, $wallet_query);

    if ($wallet_row = mysqli_fetch_assoc($wallet_result)) {
        $wallet_id = $wallet_row['wallet_id'];

        // Update the amount in the _wallet table
        $update_query = "UPDATE _wallet SET amount = amount + $new_amount WHERE wallet_id = '$wallet_id'";

        if (mysqli_query($conn, $update_query)) {
            echo "Wallet amount updated successfully!";
        } else {
            echo "Error updating wallet: " . mysqli_error($conn);
        }
    } else {
        echo "Wallet not found for the user.";
    }
}

// Close the database connection
mysqli_close($conn);
?>