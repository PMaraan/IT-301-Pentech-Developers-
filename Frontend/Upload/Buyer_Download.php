<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="Buyer_Download.css" />
    <link rel="stylesheet" href="Details.css" />
    <link rel="stylesheet" href="BoxContainer.css" />
    <link rel="stylesheet" href="../Navigation/navigation_bar.css" />
    
    <title>Trade Success | Download</title>
</head>

<body class="vh-100 overflow-hidden" style="font-family: 'Poppins', sans-serif; background-color: #161530;">
    
    <?php include '../../Frontend/Navigation/navigation_bar.php'; ?>

    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-2 mt-3 mb-3 ms-3 Details">
                <div class="Details-Header">
                    <h2>Trading With</h2>
                </div>
                
                <div class="Profile-Pic-Wrapper">
                    <img src="../Assets/Test_IMG_1.JPG" id="Profile-Pic" alt="Buyer Profile" class="Buyer-IMG">
                </div>
                
                <?php
                    $Details = ["Username", "User ID", "Email", "Phone"];
                    foreach ($Details as $Detail) {
                        echo "<h6>$Detail:</h6>";
                    }
                ?>
                
                <div class="Details-2">
                    <div class="mb-3">
                        <label for="paidbox">Paid:</label>
                    </div>
                    <div class="mb-3">
                        <input type="number" id="paidbox" name="paidbox" placeholder="$00.00" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="durationbox">Duration:</label>
                    </div>
                    <div class="mb-3">
                        <input type="date" id="durationbox" name="durationbox" placeholder="MM/DD/YYYY" readonly>
                    </div>
                    <button type="button" id="btn-contract" class="btn btn-secondary">View Contract</button>
                </div>
            </div>

            <div class="col-lg-9 mt-3 ms-4 BoxContainer">
                <h1>Download</h1>
                <div class="mx-2 UploadBox">
                    <h6>File to Download Displays Here.</h6>
                </div>
                <div class="mt-2">
                    <label for="file-title">Title</label>
                    <input type="text" id="file-title" class="form-control" readonly placeholder="No file selected" />
                </div>

                <div class="mt-2">
                    <label for="file-size">Size</label>
                    <input type="text" id="file-size" class="form-control" readonly placeholder="No file selected" />
                </div>

                <div class="mt-2">
                    <label for="file-type">Type</label>
                    <input type="text" id="file-type" class="form-control" readonly placeholder="No file selected" />
                </div>

                <div class="mb-3">
                    <label for="user-paragraph" class="form-label">Notes:</label>
                    <textarea id="user-paragraph" class="form-control" rows="6" placeholder="Type your paragraph(s) here..." readonly></textarea>
               </div>

                <div class="mb-3">
                    <button type="button" id="btn-download" class="btn btn-success">Download</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
