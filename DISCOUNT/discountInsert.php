<?php
require_once("../connection-study.php"); 

if(!isset($_POST["name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$number = $_POST["number"];
$name = $_POST["name"];
$endDate = $_POST["endDate"];
$now = date('Y-m-d H:i:s');


if($now >= $endDate) {
    echo "時效已過";
    exit;
} else {
    $sql = "INSERT INTO discount(created_at, discount_number, discount_name, discount_status, last_updated_at)
    VALUES ('$endDate', '$number', '$name', 1, '$now')";
}


if ($conn -> query($sql) === TRUE) { //確定成功
    $last_id = $conn -> insert_id; //取得最新一筆資料(insert_id:當執行 INSERT 語句時，這個成員函數傳回新插入行的ID。)
    echo "新增資料完成, id: $last_id";
    header("location: discount.php");
} else {
    echo "新增資料錯誤: " . $conn -> error;
}
$conn -> close(); 

?>