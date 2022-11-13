<?php
require_once("../connection-study.php");
?>
<!doctype html>
<html lang="en">

<head>
  <title>Add Discount</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Merriweather&family=Noto+Serif+TC&family=Playfair+Display&family=Roboto+Mono&display=swap" rel="stylesheet">
    <style>
         body {
            font-family: 'Noto Serif TC', serif;
            font-size: 20px;
        }
        .container {
            width: 30%;
            line-height: 50px;
        }
        h1 {
            font-weight: bold;
            padding-bottom: 30px;
        }
        .btn {
            font-size: 20px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <form action="discountInsert.php" method="post">
        <div class="mb-2">
            <?php
            $sqlId = "SELECT discount.id FROM discount ORDER BY discount.id DESC LIMIT 1";
            $resultId = $conn -> query($sqlId);
            $rowId = $resultId -> fetch_assoc();
            $output = implode($rowId);
            $outputFinal = $output + 1;
            echo "<h1>折扣碼編號 ". $outputFinal. "</h1>";
            ?>
        </div>
        <div class="mb-2">
            <label for="date">時效日期</label>
            <input type="date" class="form-control" id="endDate" name="endDate">
        </div>
        <div class="mb-2">
            <label for="number">折扣碼號</label>
            <input type="" class="form-control" id="price" name="number">
        </div>
        <div class="mb-2">
            <label for="name">折扣碼標題</label>
            <input type="" class="form-control" id="price" name="name">
        </div>
        <button class="btn btn-dark" type="submit">
            新增折扣碼
        </button>
    </form>
  </div>
</body>

</html>