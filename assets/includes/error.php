<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Access Denied</title>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <script>
      $(document).ready(function() {
        swal
          .fire({
            title: "Oops!",
            text: "You can't access this page",
            icon: "error",
            showCancelButton: false,
            confirmButtonColor: "brown",
            confirmButtonText: "Login"
          })
          .then(result => {
            if (result.value) {
              window.location.href = "../../index.php";
            }
          });
      });
    </script>
  </body>
</html>
