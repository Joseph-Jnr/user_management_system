<?php
session_start();
include 'assets/includes/config.php';

$name = $_SESSION['name'];
$greeting = strstr($name, ' ', true);

if (!isset($_SESSION['name'])) {
    header("Location: assets/includes/error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admins</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive/responsive.css">
</head>
<body>
    <section class="container-fliud main-dashboard">
        <header>
            <div class="brand">
                <a href="dashboard.php">
                    <i class="brand-img fa fa-user-secret fa-2x"></i> 
                </a>
                <a href="assets/includes/logout.php" class="pull-right text-white"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </header>
        <div class="container">
            <div class="d-flex justify-content-between">
                <div></div>

                <div class="pull-right">
                <?php 
                if (isset($_GET['created'])) {
                    echo "<p class='msg-alert animated swing' id='confirmation'><i class='fa fa-check'></i> Created</p>";
                }
                if (isset($_GET['updated'])) {
                    echo "<p class='msg-alert animated swing' id='confirmation'><i class='fa fa-check'></i> Updated</p>";
                }
                ?>
                </div>
            </div>


        <div class="d-flex justify-content-between p-t-100">
            <h4>Admins</h4>
            <a href="assets/includes/create-admin.php" class="text-custom">
                <img src="assets/img/add-user.png" width="30" height="30" alt=""> Create Admin
            </a>
        </div><hr>
        <div id="filter-search">
            <input
                type="text1"
                id="myInput"
                placeholder="Search for admin"
            />
        </div>
        <?php

            // Attempt select query execution
        $sql = "SELECT * FROM admins";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='offset-shadow table-responsive'>";
                echo "<table class='table table-bordered table-striped table-light text-center' id='myTable'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th class='text-center'>#</th>";
                echo "<th class='text-center' style='min-width:200px;'><i class='fa fa-user'></i> Name</th>";
                echo "<th class='text-center' style='min-width:200px;'><i class='fa fa-envelope'></i> Email</th>";
                echo "<th class='text-center' style='min-width:200px;'><i class='fa fa-key'></i> Last Login</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    $log = $row['lastlogin'];
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . date('jS F Y', strtotime($log)) . " | <small class='text-c-primary'><i class='elegant icon_clock_alt'></i> " . date('h:ia', strtotime($log)) . "</small></td>";

                    echo "<div class='col-md-12'>";
                    echo "<td style='min-width:70px; cursor:pointer;'>";
                    echo "<a href='admin-profile.php?id=" . $row['id'] . "' class='action-link-1 action-links'><span class='fa fa-eye'></span></a>";
                    echo "</td>";
                    echo "<td style='min-width:70px; cursor:pointer;'>";
                    echo "<a href='assets/includes/update-admin.php?id=" . $row['id'] . "' class='action-link-1 action-links'><span class='fa fa-edit'></span></a>";
                    echo "</td>";
                    echo "<td style='min-width:70px; cursor:pointer;'>";
                    echo "<span class='action-link-3 action-links delete-admin' data-id='" . $row['id'] . "'><span class='fa fa-trash'></span></span>";
                    echo "</td>";
                    echo "<div id='delete_admin_conf'></div>";
                    echo "</div>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                // Free result set
                mysqli_free_result($result);
            } else {
                echo "<p class='alert alert-success'><em>No records</em></p>";
            }
        } else {
            echo "<p class='alert alert-warning'>Database not available.</p>";
        }

            // Close connection
        mysqli_close($link);
        ?>



        <div class="d-flex justify-content-center align-items-center p-t-40">
            <p>
                <a href="dashboard.php" class="text-custom"><i class="fa fa-dashboard"></i> Return to Dashboard</a>
            </p>
        </div>
        

        <footer class="p-t-150">
            <hr class="bg-custom">
            <div class="copywrite d-flex justify-content-center align-items-center">
                <p>
                    &copy; Copywrite <script>document.write(new Date().getFullYear());</script> | Users Association
                </p>
            </div>
        </footer>
        </div>
    </section>


    <!-- jQuery-2.2.4 js -->
    <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Popper js -->
    <script src="assets/js/bootstrap/popper.min.js"></script>
  </body>
</body>
</html>