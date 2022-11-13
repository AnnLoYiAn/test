<?php
require_once("../connection-study.php");

$sql = "SELECT d.id AS discountId, d.created_at, d.discount_number, d.discount_name, d.discount_status, d.last_updated_at, ds.*
FROM discount d
JOIN discount_status ds ON d.discount_status = ds.id";

$result = $conn -> query($sql);
$row = $result -> fetch_assoc();


?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
    <form action="discountUpdate.php" method="post">
        <table class="table table-bordered">
            <div class="mb-2 d-flex">
                <label for="name">
                    <h1>折扣碼編號&nbsp</h1>
                    <input type="hidden" name="id" value="<?=$row["discountId"]?>">
                </label>
                <div>
                    <?php
                    $sqlId = "SELECT discount.id FROM discount ORDER BY discount.id DESC LIMIT 1";
                    $resultId = $conn -> query($sqlId);
                    $rowId = $resultId -> fetch_assoc();
                    $output = implode($rowId);
                    $outputFinal = $output + 1;
                    echo "<h1>". $outputFinal. "</h1>";
                    ?>
                </div>
            </div>
            <div class="mb-2">
                <label for="date">時效日期</label>
                <input type="date" class="form-control" id="endDate" name="endDate">
            </div>
            <div class="mb-2">
                <label for="number">折扣碼號</label>
                <input type="" class="form-control" id="number" name="number" placeholder="<?=$row["discount_number"]?>">
            </div>
            <div class="mb-2">
                <label for="name">折扣碼標題</label>
                <input type="" class="form-control" id="name" name="name" placeholder="<?=$row["discount_name"]?>">
            </div>
            <div class="mb-2">
                <label for="name">上下架</label>
                <select id="status" name="status">
                        <?php 
                        $sqlStatus = "SELECT id, status FROM discount_status";
                        $resultStatus = $conn -> query($sqlStatus); 
                        $rows = $resultStatus -> fetch_all(MYSQLI_ASSOC);
                        ?>
                        <?php        
                        for($i = 0; $i < count($rows); $i++): ?>
                        <?=$status_name = $rows[$i]["status"];?>
                            <option value="<?=$rows [$i]["id"]?>">
                                <?=$status_name ?>
                            </option>
                        <?php endfor; ?>
                </select>
            </div>
            <button class="btn btn-dark" type="submit">
                修改完成
            </button>
        </table>
    </form>
  </div>
</body>

</html>