<?php
session_start();
include 'assets/includes/config.php';

// Define variables and initialize with empty values
$name = $password = "";
$name_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Name
  $input_name = trim($_POST["name"]);
  if (empty($input_name)) {
    $name_err = "<p style='color:brown'>Please enter your name.</p>";
  } else {
    $sql = "SELECT * FROM admins WHERE name='$input_name'";
    $result = mysqli_query($link, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck < 1) {
      $name_err = "<p style='color:brown'>Admin does not exist</p>";
    } else {
      $name = $input_name;
    }
  }

    // Validate Password
  $input_password = trim($_POST["password"]);
  if (empty($input_password)) {
    $password_err = "<p style='color:brown'>Please enter password.</p>";
  } else {
    $password = $input_password;
  }

    // Check input errors before inserting in database
  if (empty($name_err) && empty($password_err)) {

        // Prepare an update statement

    if (mysqli_num_rows($result) == 1) {
            /* Fetch result row as an associative array. Since the result set
            contains only one row, we don't need to use while loop */
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

      $hashedPwdCheck = password_verify($password, $row['password']);
      if ($hashedPwdCheck == false) {
        $password_err = "<p style='color:brown'>Wrong password.</p>";
      } elseif ($hashedPwdCheck == true) {
                //Login the admin here
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['expire'] = time() + (45 * 60);
                //Setting the last login of the admin
        $lastlog = date('Y-m-d H:i:s');
        $adminId = $row['id'];
        $sql = "UPDATE admins SET lastlogin='$lastlog' WHERE id = '$adminId'";

        $result = mysqli_query($link, $sql);
        //$resultCheck = mysqli_num_rows($result);
        header("Location: dashboard.php?login=success");
        exit();
      }
    } else {
      // URL doesn't contain valid id. Redirect to error page
      header("Location: index.php?login=failed");
      exit();
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
    <meta
      name="keywords"
      content="master tech, master tech company, Best web development company, web development, how to create a website, graphic design"
    />
    <title>Admin Login</title>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/core-img/logo.png" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/responsive/responsive.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/others/util.css"
    />
  </head>
  <body>

    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100 box-shadow">
          <form class="login100-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <span class="login100-form-title">
            <img src="assets/img/user.png" class="p-b-10" alt="icon"><br>
              Login
            </span>

            <div class="wrap-input100 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
              <input class="input100" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>"/>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
            </div>
            <span class="help-block"><?php echo $name_err; ?></span>

            <div class="wrap-input100 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <input class="input100" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>"/>
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>
            <span class="help-block"><?php echo $password_err; ?></span>

            <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit">
                Login
              </button>
            </div>

            <div class="text-center p-t-12">
              <span class="txt1">
                Forgot |
              </span>
              <a class="txt2" href="#">
                Password?
              </a>
            </div>

            <div class="text-center p-t-60"></div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery-2.2.4 js -->
    <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Popper js -->
    <script src="assets/js/bootstrap/popper.min.js"></script>
  </body>
</html>
