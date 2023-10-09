<div class="main">
    <div class="header1">
        <div>
            <h1>Thêm danh mục</h1>
        </div>
    </div>
    <div class="main-m">
        <a href="./index.php?page_layout=danhmuc"><button type="button" class="btn btn-dark">Quay lại</button></a>
        <form role="form" method="post" class="form-group">
            <label style="margin: 5px; float: left">Tên danh mục</label>
            <input type="text" required="" name="tendm" class="form-control"
                style="width: 25vw; float: left; margin-right: 20px">
            <button type="submit" name="submit" class="btn btn-success">Thêm </button>
        </form>
    </div>
</div>

<?php 
if (isset($_POST['submit'])){
    $tendm = $_POST['tendm'];
    $danhMuc = new Danhmuc($conn);
    $result = $danhMuc->checkTonTai($tendm);
    
    if($result){
        echo "<h1>Danh mục đã tồn tại.</h1>";
    }
    else {
        $result2 = $danhMuc->themDanhMuc($tendm);
        if ($result2) {
        header('Location: ./index.php?page_layout=danhmuc');
        exit;
        }
    }
}

?>