<?php
$conn = new mysqli('localhost', 'fernando', '123456', 'gdlwebcam');
$conn->set_charset('utf8');
if ($conn->connect_errno) {
    echo $conn->connect_error;
    exit();
}
