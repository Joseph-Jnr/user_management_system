<?php
session_start();
if (!isset($_SESSION['name'])) {
  header("Location: error.php");
}
include 'config.php';

// Define variables and initialize with empty values
$name = $email = $password = $img = "";
$name_err = $email_err = $password_err = $img_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $target = "../img/admins/" . basename($_FILES['img']['name']);

  $img = $_FILES['img']['name'];


    // Validate name
  $input_name = trim($_POST["name"]);
  if (empty($input_name)) {
    $name_err = "<p style='color:brown'>Please enter a name.</p>";
  } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
    $name_err = "<p style='color:brown'>Please enter a valid name.</p>";
  } else {
    $sql = "SELECT * FROM admins WHERE name='$input_name'";
    $result = mysqli_query($link, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
      $name_err = "<p style='color:brown'>User already exists.</p>";
    } else {
      $name = $input_name;
    }
  }

    // Validate email
  $input_email = trim($_POST["email"]);
  if (empty($input_email)) {
    $email_err = "<p style='color:brown'>Enter email.</p>";
  } else {
    $sql = "SELECT * FROM admins WHERE email='$input_email'";
    $result = mysqli_query($link, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
      $email_err = "<p style='color:brown'>Email is taken</p>";
    } else {
      $email = $input_email;
    }
  }

    // Validate year of admission
  $input_password = trim($_POST["password"]);
  if (empty($input_password)) {
    $password_err = "<p style='color:brown'>Choose password</p>";
  } else {
    $hashedpwd = password_hash($input_password, PASSWORD_DEFAULT);
    $password = $hashedpwd;
  }

    // Check input errors before inserting in database
  if (empty($name_err) && empty($email_err) && empty($password_err) && empty($img_err)) {
        // Prepare an insert statement
    $sql = "INSERT INTO admins (name, email, password, img) VALUES (?, ?, ?, '$img')";

    if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_password);

            // Set parameters
      $param_name = $name;
      $param_email = $email;
      $param_password = $password;

            // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
        move_uploaded_file($_FILES['img']['tmp_name'], $target);

        header("location: ../../dashboard.php?created=success");
        exit();

      } else {
        echo "
				<div class='col-md-12 text-center'>
				<p style='background:red; padding:20px; border:4px solid red; border-radius:4px; color:#fff; font-weight:bold;margin-bottom:0px;'>
				<i class='fa fa-warning'></i> Something went wrong! Please try again later.
				</p>
				</div>";
      }
    }

        // Close statement
    mysqli_stmt_close($stmt);
  }

    // Close connection
  mysqli_close($link);
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Create Admin</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive/responsive.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="../css/others/util.css"
    />
  </head>
  <body>

    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100 box-shadow">
          <form class="login100-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <span class="login100-form-title">
            <img src="../img/add-user.png" class="p-b-10" alt="icon"><br>
              Create Admin
            </span>

            <div class="wrap-input100 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
              <input class="input100" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>"/>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
            </div>
            <span class="help-block"><?php echo $name_err; ?></span>
            
            <div class="wrap-input100 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
              <input class="input100" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>"/>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>
            <span class="help-block"><?php echo $email_err; ?></span>

            <div class="wrap-input100 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <input class="input100" type="password" name="password" placeholder="Choose Password" value="<?php echo $password; ?>"/>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>
            <span class="help-block"><?php echo $password_err; ?></span>
            
            <input type="hidden" name="size" value="1000000">
            <div class="wrap-input100 <?php echo (!empty($img_err)) ? 'has-error' : ''; ?>">
              <input class="input100" type="file" name="img" placeholder="image" value="<?php echo $img; ?>"/>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-camera" aria-hidden="true"></i>
              </span>
            </div>
            <span class="help-block"><?php echo $img_err; ?></span>

            <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit">
                Submit
              </button>
            </div>

            <div class="text-center p-t-12">
              <a class="txt2" href="../../dashboard.php">
                <i class="fa fa-long-arrow-left"></i> Exit
              </a>
            </div>

            <div class="text-center p-t-60"></div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery-2.2.4 js -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <!-- Popper js -->
    <script src="../js/bootstrap/popper.min.js"></script>
  </body>
</html>
