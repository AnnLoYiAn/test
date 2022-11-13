<?php
require_once("../connection-study.php");

$id = $_POST["id"];
$endDate = $_POST["endDate"];
$number = $_POST["number"]; 
$name = $_POST["name"];
$status = $_POST["status"];
$now = date('Y-m-d H:i:s');

if($now >= $endDate) {
    echo "時效已過 請重新設定時效日期 即將載回主頁面";
    header('Refresh: 3, url=discount.php');
    exit;
} else {
    $sqlUpdate = "UPDATE discount SET created_at = '$endDate', discount_number = '$number', discount_name = '$name', discount_status = '$status', last_updated_at = '$now' WHERE id = $id";
}





if ($conn->query($sqlUpdate) === TRUE) {
    echo "更新成功";
    header("location: discount.php");
} else {
    echo "更新資料錯誤: " . $conn -> error;
}