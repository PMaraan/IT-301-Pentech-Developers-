<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="wallet.css"/>
    <link rel="stylesheet" href="navigation_bar.css">
    <title>Digital Currency</title>
<?php include 'navigation_bar.php'; ?>
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
</head>
<body class="vh-100 overflow-hidden">


    <div class="container d-flex justify-content-center align-items-center h-100">
        <div class="card text-center p-4 shadow-lg wallet-card">
            <h3 class="mb-4">Enter Digital Currency Amount</h3>
            <form  method="POST" action="wallet.php">
                <div class="mb-3">
                    <!-- Add min="0" to prevent negative values in the input -->
                    <input type="number" class="form-control" name="currency" id="currencyInput" placeholder="Enter amount" min="0" required>
                </div>
                <button type="submit" name="submits" class="btn btn-primary">Submit</button>
            </form>

            <div id="displayAmount" class="mt-4 alert alert-info d-none">
                You have entered <span id="amountDisplay"></span> digital currency.
            </div>
        </div>
    </div>

    <script>
        document.getElementById('currencyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const amount = document.getElementById('currencyInput').value;

            if (amount >= 0) {
                // If amount is valid, display it
                document.getElementById('amountDisplay').innerText = amount;
                document.getElementById('displayAmount').classList.remove('d-none');
            } else {
                // If the input is negative, alert the user
                alert("Please enter a positive amount.");
            }
        });
    </script>
</body>
</html>