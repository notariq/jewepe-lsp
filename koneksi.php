<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_lsp_emading";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn) {
    echo "Database connected";
} else {
    echo "Connection failed: " . mysqli_connect_error();
}
?>
