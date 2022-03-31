<?php
session_start();
require_once "../Database/Database.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.')</script>";
    header("Refresh:0 , url = ../index.html");
    exit();
}
$delete_num = $_GET['id'];
$sql =  "DELETE FROM product WHERE id = '$delete_num'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Successfully Deleted')</script>";
    header("Refresh: 0 , url = ../list.php");
    exit();
} else {
    echo "<script>alert('Failed to Delete')</script>";
    header("Refresh: 0 , url = ../list.php");
    exit();
}
mysqli_close($conn);
