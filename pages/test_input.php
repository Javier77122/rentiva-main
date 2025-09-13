<?php
// test_input.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "php://input content: '" . file_get_contents('php://input') . "'<br>";
echo "Content length: " . strlen(file_get_contents('php://input')) . "<br>";
echo "Request method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
?>