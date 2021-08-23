<?php
session_start();
require_once "../Database/Database.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.')</script>";
    header("Refresh:0 , url = ../index.html");
    exit();
}

if ($_POST['name'] != null && $_POST['amount'] != null) {
    $sql = "INSERT INTO product (proname,amount, price) VALUES ('" . trim($_POST['name']) . "','" . trim($_POST['amount']) . "','" . trim($_POST['price']) . "')";
    if ($conn->query($sql)) {
        echo "<script>alert('Successully added')</script>";
        header("Refresh:0 , url = ../list.php");
        exit();
    } else {
        echo "<script>alert('Failed to Add')</script>";
        header("Refresh:0 , url = ../list.php");
        exit();
    }
} else {
    echo "<script>alert('Please fill in information.')</script>";
    header("Refresh:0 , url = ../list.php");
    exit();
}
mysqli_close($conn);
