<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    exit;
}

$conn = new mysqli("localhost", "root", "", "calendar");

$id = (int)$_GET['id'];

$conn->query("DELETE FROM availability WHERE id = $id");

header('Location: dashboard.php');