<?php
$id_dm = $_GET['id_dm'];

$danhmuc = new Danhmuc($conn);
$laydanhmuc = $danhmuc->layDanhMuc($id_dm);
if (!$laydanhmuc) {
    header('Location: error.php');
    exit;
}

if (isset($_POST['submit'])) {
    $tendm = $_POST['tendm'];
    $result = $danhmuc->suaDanhMuc($id_dm, $tendm);

    if ($result) {
        header('Location: ./index.php?page_layout=danhmuc');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục</title>
</head>



<body>
    <div class="main">
        <div class="header1">
            <div>
                <h1>Sửa danh mục</h1>
            </div>
        </div>
        <div class="main-m">
            <form role="form" method="post">
                <label>Tên danh mục</label>
                <input type="text" name="tendm" value="<?php echo $laydanhmuc['tendm']; ?>" required>
                <button type="submit" name="submit">Lưu</button>
            </form>
        </div>
    </div>
</body>

</html>