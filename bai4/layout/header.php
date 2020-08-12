<?php
//Lấy ra toàn bộ danh mục sản phẩm
$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate  = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>
    <div class="container">
        <header><img src="images/xbanner-trang-lien-he-moi.jpg.pagespeed.ic.FQvWHe7Pcx.jpg"></header>
        <!--Menu-->
        <nav>
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <?php foreach ($cate as $c) : ?>
                    <li><a href="category.php?id=<?= $c['cate_id'] ?>"><?= $c['cate_name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <!--End menu-->