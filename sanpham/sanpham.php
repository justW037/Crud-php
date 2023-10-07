<script>
function xoadanhmuc() {
    var conf = confirm("Bạn có chắc chắn muốn xóa mục này hay không?");
    return conf;
}
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
</head>

<body>
    <div class="main">
        <h1>Quản lý sản phẩm</h1>
        <div class="container">
            <form method="post" action="index.php?page_layout=locsanpham" class="form-horizontal">
                <div class="form-group">
                    <label for="id_dm" class="control-label">Lọc sản phẩm:</label>
                    <div class="controls">
                        <select id="id_dm" name="id_dm" class="form-control" required>
                            <option value="unselect" selected>Tất cả</option>
                            <?php
                            $sqldm = "SELECT * FROM danhmuc";
                            $querydm = mysqli_query($conn, $sqldm);
                            while ($rowdm = mysqli_fetch_array($querydm)) {
                            ?>
                            <option value="<?php echo $rowdm['id_dm']; ?>"><?php echo $rowdm['tendm']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="controls">
                        <input type="submit" name="loc" value="Lọc" class="btn-submit">
                    </div>
                </div>
            </form>

            <div class="search-filter">
                <form action="index.php?page_layout=timkiemsp" method="POST">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm">
                    <button type="submit" name="search-submit">Tìm kiếm</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Giá</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM sanpham INNER JOIN danhmuc ON sanpham.id_dm=danhmuc.id_dm ORDER BY id_sp";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id_sp']; ?></td>
                        <td><?php echo $row['tensp']; ?></td>
                        <td><?php echo $row['tendm']; ?></td>
                        <td><img width="auto" height="150px" src="sanpham/uploads/<?php echo $row['anhsp']; ?>"></img>
                        </td>
                        <td><?php echo number_format($row['giasp']); ?> VNĐ</td>
                        <td><a href="index.php?page_layout=suasanpham&id_sp=<?php echo $row['id_sp']; ?>"
                                class='edit'>Sửa</a></td>
                        <td>
                            <a onclick="return xoadanhmuc();"
                                href="sanpham/xoasanpham.php?id_sp=<?php echo $row['id_sp']; ?>" class='delete'>Xóa</a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr>
                            <td colspan='7'>Không có sản phẩm nào</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="index.php?page_layout=themsanpham" class="button-add">Thêm sản phẩm</a>
        </div>
    </div>
</body>

</html>