<?php
// Kiểm tra xem người dùng đã nhấn nút "Lọc" hay chưa
if (isset($_POST['loc'])) {
    $id_dm = $_POST['id_dm'];
}
?>
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
                <form action="./index.php?page_layout=timkiemsp" method="POST">
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
                if ($id_dm == 'unselect') {
                    $sql = "SELECT * FROM sanpham INNER JOIN danhmuc ON sanpham.id_dm = danhmuc.id_dm";
                } else {
                    $sql = "SELECT * FROM sanpham INNER JOIN danhmuc ON sanpham.id_dm = danhmuc.id_dm WHERE sanpham.id_dm = '$id_dm'";
                }
                $query = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                        <tr>
                            <td><?php echo $row['id_sp']; ?></td>
                            <td><?php echo $row['tensp']; ?></td>
                            <td><?php echo $row['tendm']; ?></td>
                            <td><img width="auto" height="150px" src="sanpham/uploads/<?php echo $row['anhsp']; ?>"></img></td>
                            <td><?php echo number_format($row['giasp']); ?> VNĐ</td>
                            <td><a href="index.php?page_layout=suasanpham&id_sp=<?php echo $row['id_sp']; ?>" class='edit'>Sửa</a></td>
                            <td>
                                <a onclick="return xoadanhmuc();" href="sanpham/xoasanpham.php?id_sp=<?php echo $row['id_sp']; ?>" class='delete'>Xóa</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    // Hiển thị thông báo "Không có sản phẩm nào"
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


<style>
    /* CSS cho phần quản lý danh mục */
    .main {
        margin-left: 250px;
    }

    .header {
        display: none;
    }

    .container {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f1f1f1;
        font-weight: bold;
        text-align: center;
    }

    .edit,
    .delete {
        padding: 4px 8px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    .edit:hover,
    .delete:hover {
        background-color: #45a049;
    }

    th,
    td {
        border-right: 1px solid #ddd;
    }

    th:first-child,
    td:first-child {
        border-left: 1px solid #ddd;
    }

    .button-add {
        color: #fff;
        background-color: #45a049;
        padding: 8px 14px;
        border-radius: 4px;
        position: relative;
        top: 25px;
        float: right;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .btn-submit {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #45a049;
        color: #fff;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .form-horizontal {
        display: flex;
        flex-direction: row;
        align-items: center;
        float: right;
    }

    .form-group {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .control-label {
        white-space: nowrap;
        font-size: 1.2rem;
        vertical-align: top;
    }

    .controls {
        margin-left: 1rem;
    }

    .search-filter {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .search-filter form {
        display: flex;
        align-items: center;
    }

    .search-filter input[type="text"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 5px;
        font-size: 14px;
    }

    .search-filter button {
        padding: 8px 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .search-filter button:hover {
        background-color: #45a049;
    }
</style>