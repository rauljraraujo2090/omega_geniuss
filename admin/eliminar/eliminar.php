<?php
  include_once('../include/config.php');

    $id = $_REQUEST['Id'];
    $sql = "DELETE FROM users WHERE name = '$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header('location:../manage-users.php');
        echo"eliminado correctamente";
    }
?>