<?php
$id_dm = $_GET['id_dm'];

$danhMuc = new Danhmuc($conn);
$laydanhmuc = $danhMuc->layDanhMuc($id_dm);
if (!$laydanhmuc) {
    header('Location: error.php');
    exit;
}

if (isset($_POST['submit'])) {
    $tendm = $_POST['tendm'];
    $result = $danhMuc->checkTonTai($tendm);
    if($result){
        echo "<h1>Danh mục đã tồn tại.</h1>";
    }
    else {
        $result2 = $danhMuc->suaDanhMuc($id_dm, $tendm);
        if ($result2) {
            header('Location: ./index.php?page_layout=danhmuc');
            exit;
        }
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
            <a href="./index.php?page_layout=danhmuc"><button type="button" class="btn btn-dark">Quay
                    lại</button></a>
            <form role="form" method="post">
                <label style="margin: 5px; float: left">Tên danh mục</label>
                <input type="text" name="tendm" value="<?php echo $laydanhmuc['tendm']; ?>" class="form-control"
                    style="width: 25vw; float: left; margin-right: 20px" required>
                <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
</body>

</html>