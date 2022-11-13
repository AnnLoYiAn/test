<?php
require_once("../connection-study.php");

$per_page = 5;

if(isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$page_start = ($page - 1) * $per_page;

$sql = "SELECT d.id AS discountId, d.created_at, d.discount_number, d.discount_name, d.discount_status, d.last_updated_at, ds.*
FROM discount d
JOIN discount_status ds ON d.discount_status = ds.id
ORDER BY last_updated_at DESC 
LIMIT $page_start, $per_page";

$sql_all = "SELECT d.id AS discountId, d.created_at, d.discount_number, d.discount_name, d.discount_status, d.last_updated_at, ds.*
FROM discount d
JOIN discount_status ds ON d.discount_status = ds.id
ORDER BY last_updated_at DESC";

$result_all = $conn -> query($sql_all);
$discountTotalCount = $result_all -> num_rows;
$totalPage = ceil($discountTotalCount / $per_page); 

$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);


foreach ($rows as $timer) {
    $now = date('Y-m-d H:i:s');
    $late = $timer["created_at"];
    $id = $timer["discountId"];
    if($now >= $late) {
        $sqlUpdate = "UPDATE discount SET discount_status = 2 WHERE id = $id";
        $result = $conn -> query($sqlUpdate);
    }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>折扣碼管理</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="/fontawesome-free-6.2.0-web/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Merriweather&family=Noto+Serif+TC&family=Playfair+Display&family=Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Noto Serif TC', serif;
        }
        .input-group {
            width: 30%;
        }
        .search-button {
            width: 160px;
        }
    </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="navbar-brand fw-bold">折扣碼管理</div>
    </div>
  </nav>
  <div class="container">
    <a class="mt-3 btn btn-outline-dark" href="add-discount.php">
        <i class="fa-solid fa-plus"></i> 新增折扣碼
    </a>
    <div class="py-2 text-end">

        共 <?=$discountTotalCount?> 項
    </div>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>折扣碼編號</th>
                <th>時效日期</th>
                <th>折扣碼號</th>
                <th>折扣碼標題</th>
                <th>上下架</th>
                <th>最後更新日期</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $discount): ?>
            <tr>
                <td>
                    <?= $discount["discountId"]?>
                </td>
                <td>
                    <?= $discount["created_at"]?>
                </td>
                <td>
                    <?= $discount["discount_number"]?>
                </td>
                <td>
                    <?= $discount["discount_name"]?>
                </td>
                <td>
                    <?= $discount["status"]?>
                </td>
                <td>
                    <?= $discount["last_updated_at"]?>
                </td>
                <td class="d-flex justify-content-evenly">
                    <a class="btn btn-success" href="edit-discount.php">
                        修改
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="py-2 d-flex justify-content-center">
        <?php if(!isset($_GET["search"])): ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for($i = 1; $i <= $totalPage; $i ++):?>
                    <li class="page-item <?php if($i == $page) echo "active";?>">
                        <a class="page-link" href="discount.php?page=<?= $i ?>">
                            <?=$i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
  </div>
</body>

</html>