<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="profile.css"/>
    <link rel="stylesheet" href="..\Navigation\navigation_bar.css">
    <title>Navigation Bar Test</title>
	<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');
    </style>
</head>
<body class="vh-100 overflow-hidden" style="font-family: 'Poppins', sans-serif; background-color: #161530;">
<?php 
require('..\..\Frontend\Navigation\navigation_bar.php');

require('..\..\Backend\include\dbconnect-include.php');
require('..\..\Backend\Profile\DisplayUserData.php');

$connect->close();
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
						<li class="list-group-item"><strong>Firstname:</strong> <?php echo $first_name; ?></li>
						<li class="list-group-item"><strong>Lastname:</strong> <?php echo $last_name; ?></li>
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
