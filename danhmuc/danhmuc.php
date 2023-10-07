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
    <title>Quản lý danh mục</title>
</head>

<body>
    <div class="main">
        <h1>Quản lý danh mục</h1>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM danhmuc ORDER BY id_dm";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id_dm']; ?></td>
                        <td><?php echo $row['tendm']; ?></td>
                        <td><a href="index.php?page_layout=suadanhmuc&id_dm=<?php echo $row['id_dm']; ?>"
                                class='edit'>Sửa</a></td>
                        <td>
                            <a onclick="return xoadanhmuc();"
                                href="./danhmuc/xoadanhmuc.php?id_dm=<?php echo $row['id_dm']; ?>"
                                class='delete'>Xóa</a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    else {
                        echo "<tr>
                            <td colspan='7'>Không có sản phẩm nào</td>
                        </tr>";
                        }
                    ?>
                </tbody>
            </table>
            <a href="index.php?page_layout=themdanhmuc" class="button-add">Thêm danh mục</a>
        </div>
    </div>
</body>

</html>