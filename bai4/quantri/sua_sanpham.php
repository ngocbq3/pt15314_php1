<?php
require_once "../connection.php";

//Câu lệnh sql để lấy danh sách danh mục sản phẩm
$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetchAll(PDO::FETCH_ASSOC);

$errors = ['pro_name' => ''];
if (isset($_POST['btnLuu'])) {
    extract($_REQUEST);
    if ($pro_name == '') {
        $errors['pro_name'] = "Bạn chưa nhập tên";
    }
    if ($_FILES['pro_image']['size'] > 0) {
        $pro_image = $_FILES['pro_image']['name'];
    } else {
        $pro_image = $pro_image;
    }
    if (!array_filter($errors)) {
        //SQL UPDATE
        $sql = "UPDATE products SET pro_name='$pro_name', cate_id='$cate_id', pro_image='$pro_image', price='$price', quantity='$quantity', intro='$intro', detail='$detail' WHERE pro_id=$pro_id";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            if ($_FILES['pro_image']['size'] > 0) {
                move_uploaded_file($_FILES['pro_image']['tmp_name'], "../images/" . $pro_image);
            }
            echo "Cập nhật dữ liệu thành công";
        } else {
            echo "Cập nhật dữ liệu thất bại";
        }
    }
}

//Lấy dữ liệu sản phẩm theo id để đổ vào form sửa
$pro_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE pro_id=$pro_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
</head>

<body>
    <h3>Thêm sản phẩm</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="pro_id" value="<?= $product['pro_id'] ?>">
        <input type="text" name="pro_name" placeholder="Tên sản phẩm" value="<?= $product['pro_name'] ?>" id="">
        <?= isset($errors['pro_name']) ? $errors['pro_name'] : '' ?>
        <br>
        <!--Hiển thị danh sách danh mục để chọn-->
        <select name="cate_id" id="">
            <?php foreach ($cate as $c) : ?>
                <!--Kiểm tra danh mục sản phẩm để hiển thị danh mục của sản phẩm đang sửa-->
                <?php if ($c['cate_id'] == $product['cate_id']) : ?>
                    <option value="<?= $c['cate_id'] ?>" selected><?= $c['cate_name'] ?></option>
                <?php else : ?>
                    <option value="<?= $c['cate_id'] ?>"><?= $c['cate_name'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="number" name="price" id="" placeholder="Price" value="<?= $product['price'] ?>">
        <br>
        <input type="number" name="quantity" placeholder="số lượng sản phẩm" id="" value="<?= $product['quantity'] ?>">
        <br>
        <input type="file" name="pro_image" id="">
        <?= isset($errors['pro_image']) ? $errors['pro_image'] : '' ?>
        <?php if (!empty($product['pro_image'])) : ?>
            <input type="hidden" name="pro_image" value="<?= $product['pro_image'] ?>">
        <?php endif; ?>
        <br>
        <textarea name="intro" id="" cols="130" rows="5" placeholder="Mô tả"><?= $product['intro'] ?></textarea>
        <br>
        <textarea name="detail" id="" cols="130" rows="10" placeholder="Nội dung"><?= $product['detail'] ?></textarea>
        <br>
        <button type="submit" name="btnLuu">Lưu</button>

    </form>
</body>

</html>