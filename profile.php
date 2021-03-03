<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: assets/includes/error.php");
}

// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
	// Include config file
    require_once "assets/includes/config.php";

	// Prepare a select statement
    $sql = "SELECT * FROM users WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
		// Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

		// Set parameters
        $param_id = trim($_GET["id"]);

		// Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
				/* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

				// Retrieve individual field value
                $name = $row["name"];
                $uid = $row["uid"];
                $email = $row["email"];
                $img = $row["img"];
            } else {
				// URL doesn't contain valid id parameter. Redirect to error page
                header("location: profile.php?error");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

	// Close statement
    mysqli_stmt_close($stmt);

	// Close connection
    mysqli_close($link);
} else {
	// URL doesn't contain id parameter. Redirect to error page
    header("location: profile.php?error");
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link href="assets/css/style.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="">
		<div class="container-login100">
            <div class="d-flex justify-content-between">
            <a href="dashboard.php" class="btn btn-default">
                <i class="fa fa-long-arrow-left"></i> Exit
            </a>
            </div>
			<div class="wrap-login100 box-shadow" id="dvContents">
				<div class="login100-form text-center">
					<?php 

    if ($row["img"] == true) {
        echo "<img class='rounded-circle box-shadow' src='assets/img/users/" . $row['img'] . "'  width='100px' height='100px'>";
    } else {
        echo "<img class='rounded-circle box-shadow' src='assets/img/user.png' width='100px' height='100px'>";
    }

    ?>
				<h4 class="alert alert-success m-t-20 text-uppercase"><b><?php echo $row["uid"]; ?></b></h4>
                
				<div class="panel-body mt-5">
					<div class="form-group">
						<label><b>Name:</b></label>
						<p class="form-control-static"><?php echo $row["name"]; ?></p>
					</div>
					<hr>
					<div class="form-group">
						<label><b>Email:</b></label>
						<p class="form-control-static"><?php echo $row["email"]; ?></p>
					</div>
					<hr>
				</div>
			</div>
		</div>
        <div class="d-flex justify-content-between">
        <a href="#" class="btn btn-default print-profile">
            <i class="fa fa-print"></i> Print
        </a>
        </div>
	</div>


    <!-- jQuery-2.2.4 js -->
    <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="assets/js/html2pdf.bundle.min.js"></script>
    <script src="assets/js/print.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Popper js -->
    <script src="assets/js/bootstrap/popper.min.js"></script>
</body>

</html>