<div class="main">
    <div class="header1">
        <div>
            <h1>Thêm mới danh mục</h1>
        </div>
    </div>
    <div class="main-m">
        <form role="form" method="post">
            <label>Tên danh mục</label>
            <input type="text" required="" name="tendm">
            <button type="submit" name="submit">Thêm mới</button>
        </form>
    </div>
</div>

<?php 
  if (isset($_POST['submit'])){
    $tendm = $_POST['tendm'];
    $danhMuc = new Danhmuc($conn);
    $result = $danhMuc->themDanhMuc($tendm);
      if ($result) {
          header('Location: ./index.php?page_layout=danhmuc');
          exit;
      }
  }
?>