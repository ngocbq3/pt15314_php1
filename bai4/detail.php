<?php
require_once "connection.php";
$pro_id = $_GET['id'];
//Lấy ra sản phẩm có id là $pro_id
$sql = "SELECT * FROM products WHERE pro_id=$pro_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php include_once "layout/header.php" ?>

<!--Phần nội dung của website-->
<main>
    <h3><?= $product['pro_name'] ?></h3>
    <img src="images/<?= $product['pro_image'] ?>" alt="">
    <div>Price: <?= $product['price'] ?></div>
    <div><?= $product['detail'] ?></div>
</main>
<!--Kết thúc phần nội dung của website-->

<?php include_once "layout/footer.php" ?>