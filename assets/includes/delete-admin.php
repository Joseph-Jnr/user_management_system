<?php
    //connection
include 'config.php';

$action = 'fetch';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'delete') {
    $id = $_POST['id'];
    $output = array();
    $sql = "DELETE FROM admins WHERE id = '$id'";

    if ($result = mysqli_query($link, $sql)) {
        $output['status'] = 'success';
        $output['message'] = 'Admin deleted successfully';
    } else {
        $output['status'] = 'error';
        $output['message'] = 'Something went wrong in deleting the admin';
    }

    echo json_encode($output);
}

 