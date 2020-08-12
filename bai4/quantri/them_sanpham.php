<?php
require_once "../connection.php";

//Câu lệnh sql để lấy danh sách danh mục sản phẩm
$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetchAll(PDO::FETCH_ASSOC);

$errors = ['pro_name' => '', 'pro_image' => ''];
if (isset($_POST['btnLuu'])) {
    extract($_REQUEST);
    if ($pro_name == '') {
        $errors['pro_name'] = "Bạn chưa nhập tên";
    }
    if ($_FILES['pro_image']['size'] > 0) {
        $pro_image = $_FILES['pro_image']['name'];
    } else {
        $errors['pro_image'] = "Bạn chưa nhập ảnh";
    }
    if (!array_filter($errors)) {
        //SQL INSERT
        $sql = "INSERT INTO products(pro_name, cate_id, pro_image, price, quantity, intro, detail) VALUES('$pro_name', '$cate_id', '$pro_image', '$price', '$quantity', '$intro', '$detail')";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            move_uploaded_file($_FILES['pro_image']['tmp_name'], "../images/" . $pro_image);
            echo "Thêm dữ liệu thành công";
        } else {
            echo "Thêm dữ liệu thất bại";
        }
    }
}
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
        <input type="text" name="pro_name" placeholder="Tên sản phẩm" value="<?= isset($pro_name) ? $pro_name : '' ?>" id="">
        <?= isset($errors['pro_name']) ? $errors['pro_name'] : '' ?>
        <br>
        <!--Hiển thị danh sách danh mục để chọn-->
        <select name="cate_id" id="">
            <?php foreach ($cate as $c) : ?>
                <option value="<?= $c['cate_id'] ?>"><?= $c['cate_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="number" name="price" id="" placeholder="Price" value="0">
        <br>
        <input type="number" name="quantity" placeholder="số lượng sản phẩm" id="" value="0">
        <br>
        <input type="file" name="pro_image" id="">
        <?= isset($errors['pro_image']) ? $errors['pro_image'] : '' ?>
        <br>
        <textarea name="intro" id="" cols="130" rows="5" placeholder="Mô tả"></textarea>
        <br>
        <textarea name="detail" id="" cols="130" rows="10" placeholder="Nội dung"></textarea>
        <button type="submit" name="btnLuu">Lưu</button>

    </form>
</body>

</html>