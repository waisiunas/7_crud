<?php
require_once('./database/connection.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('location: ./');
}

$sql = "DELETE FROM `countries` WHERE `id` = $id";
if ($conn->query($sql)) {
    header('location: ./');
} else {
    die("Failed to delete!");
}
