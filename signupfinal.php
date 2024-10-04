<?php 
require('signupvalidation.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | 404 NOT FOUND</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style_register.css">
    <style>
        .fade-in {
            opacity: 0; 
            animation: fadeIn 0.5s forwards; 
        }
        @keyframes fadeIn {
            from {
                opacity: 0; 
            }
            to {
                opacity: 1; 
            }
        }
    </style>
	<?php 
		if($username_error != null){
			?><style>.username-error{display: block; color:red}</style> <?php
		}
		if($password_error != null){
			?><style>.password-error{display: block; color:red}</style> <?php
		}
		if($confirm_password_error != null){
			?><style>.confirm-password-error{display: block; color:red}</style> <?php
		}
	
		if($email_error != null){
			?><style>.email-error{display: block; color:red}</style> <?php
		}
		if($card_holder_error != null){
			?><style>.cardholder-error{display: block; color:red}</style> <?php
		}
		if($card_number_error != null){
			?><style>.cardnum-error{display: block; color:red}</style> <?php
		}
		if($expiry_date_error != null){
			?><style>.expdate-error{display: block; color:red}</style> <?php
		}
		if($cvv_error != null){
			?><style>.cvv-error{display: block; color:red}</style> <?php
		}
		if($cvv_error != null){
			?><style>.success{display: block; color:green}</style> <?php
		}
	?>
</head>
<body>
    <div class="container mt-5">
        <!-- Account Details Form -->
        <div class="col-md-12">
            <div class="header-container">
                <h3 class="text-left mb-0">Account Details</h3>
                <div class="horizontal-line"></div>
            </div>
            <form method="post" action="signupfinal.php" >
                <div class="mb-3 fade-in-top">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $username ?>" >
				<p class="error username-error">
					<?php echo $username_error ?>
				</p>
				</div>


                <div class="mb-3 fade-in-top">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="<?php echo $password ?>">
                <p class="error password-error">
					<?php echo $password_error ?>
				</p>
				</div>
				
                <div class="mb-3 fade-in-top">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password"  value="<?php echo $confirm_password ?>">
                <p class="error confirm-password-error">
					<?php echo $confirm_password_error?>
				</p>
				</div>
				
                <div class="mb-3 fade-in-top">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"  value="<?php echo $email ?>">
				<p class="error email-error">
				<?php echo $email_error ?>
				</p>
                </div>
                <div class="mb-3 fade-in-top">
				<label for="phone" class="form-label">Phone Number (Optional)</label>
				<input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number" >
				</div>
	</div>

        <!-- Card Details Form -->
        <div class="col-md-12 mt-4">
            <div class="header-container">
                <h3 class="text-left mb-0">Connect Card to Wallet</h3>
                <div class="horizontal-line"></div>
            </div>
            <div class="mb-3 fade-in-top">
                  <label for="cardholder-name" class="form-label">Cardholder Name</label>
                 <input type="text" class="form-control" id="card_holder" name="card_holder" placeholder="Enter cardholder name"  
                pattern="^[A-Za-z\s]+$" title="Please enter a valid cardholder name (letters and spaces only, no numbers or symbols)" value="<?php echo $card_holder ?>">
			<p class="error cardholder-error">
			<?php echo $card_holder_error ?>
			</p>
			</div>

                <div class="mb-3 fade-in-top">
                    <label for="card-number" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter card number" pattern="^\d{13,19}$"  value="<?php echo $card_number ?>">
				<p class="error cardnum-error">
				<?php echo $card_number_error ?>
				</p>
                </div>
                <div class="card-details-row d-flex justify-content-between mb-3">
                <div class="w-50 me-2 fade-in-top">
                        <label for="expiration-date" class="form-label">Expiration Date</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\/([0-9]{2})$"  value="<?php echo $expiry_date ?>">
				<p class="error expdate-error">
				<?php echo $expiry_date_error ?>
				</p>
                </div>
                <div class="w-50 fade-in-top">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" pattern="^\d{3,4}$"  value="<?php echo $cvv ?>">
                <p class="error cvv-error">
				<?php echo $cvv_error ?>
				</p>
				</div>
                </div>
        </div>
        <div class="d-flex justify-content-end mt-4">
		
            <button class="btn btn-primary w-auto" type="submit" name="confirm">Confirm</button>
			<p class="error success">
			<?php echo $success ?>
			</p>
        </div>
		</form>
    </div>
</body>
</html>
