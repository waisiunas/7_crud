<?php
$conn = new mysqli('localhost', 'root', '', '7_crud');

if ($conn->connect_error) {
    die('Failed to connect');
}