<?php
require_once "connection.php";
$cate_id = $_GET['id'];
//Lấy ra sản phẩm để hiển thị lên trang danh mục (category) theo cate_id
$sql = "SELECT * FROM products WHERE cate_id=$cate_id ORDER By pro_id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include_once "layout/header.php" ?>

<!--Phần nội dung của website-->
<main>
    <!--List products-->
    <article>
        <?php foreach ($products as $p) : ?>
            <div class="col">
                <div class="product">
                    <a href="#">
                        <img src="images/<?= $p['pro_image'] ?>">
                        <h3><?= $p['pro_name'] ?></h3>
                        <div class="price"><?= $p['price'] ?></div>
                        <div class="desc">
                            <p><?= $p['intro'] ?></p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </article>
    <!--End list products-->
</main>
<!--Kết thúc phần nội dung của website-->

<?php include_once "layout/footer.php" ?>