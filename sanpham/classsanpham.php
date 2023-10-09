<?php
    class Sanpham {
        private $conn;
        public function __construct($conn)
        {
            $this->conn = $conn;  
        }
        public function layDanhSachSanPham() {
            $sql = "SELECT * FROM sanpham INNER JOIN danhmuc ON sanpham.id_dm=danhmuc.id_dm ORDER BY id_sp";
            $query = mysqli_query($this->conn, $sql);
            $sanPhamList = array();
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $sanPhamList[] = $row;
                }
            }
            else {
                echo "<tr>
                    <td colspan='7'>Không có sản phẩm nào</td>
                </tr>";
            }
            return $sanPhamList;
        }
        public function locSanPham($id_dm) {
            $sql = "SELECT * FROM sanpham INNER JOIN danhmuc ON sanpham.id_dm = danhmuc.id_dm WHERE sanpham.id_dm = '$id_dm'";
            $query = mysqli_query($this->conn, $sql);
            $sanPhamList = array();
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $sanPhamList[] = $row;
                }
            } else {
                echo "<tr>
                    <td colspan='7'>Không có sản phẩm nào</td>
                </tr>";
            }
            return $sanPhamList;
        }
        public function timKiemSanPham($search) {
            $sql = "SELECT * FROM sanpham INNER JOIN danhmuc ON sanpham.id_dm=danhmuc.id_dm WHERE sanpham.tensp LIKE '$search' ORDER BY sanpham.id_sp";
            $query = mysqli_query($this->conn, $sql);
            $sanPhamList = array();
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $sanPhamList[] = $row;
                }
            } else {
                echo "<tr>
                    <td colspan='7'>Không có sản phẩm nào</td>
                </tr>";
            }
            return $sanPhamList;
        }
        public function checkTonTai($tensp,$anhsp){
            $sql = "SELECT id_sp FROM sanpham WHERE tensp = '$tensp' AND anhsp = '$anhsp'";
            $query = mysqli_query($this->conn, $sql);
            if(mysqli_num_rows($query) > 0) {
                return true;
            }
        }
        public function laySanPham($id_sp){
            $sql = "SELECT * FROM sanpham WHERE id_sp='$id_sp'";
            $query = mysqli_query($this->conn, $sql);
            return mysqli_fetch_array($query);
        }
        public function themSanPham($tensp,$giasp,$anhsp,$id_dm,$des){
            $sql = "INSERT INTO sanpham(tensp, giasp, anhsp, id_dm, des) VALUES ('$tensp', '$giasp', '$anhsp', '$id_dm', '$des')";
            $query = mysqli_query($this->conn, $sql);
            return $query;
        } 
        public function suaSanPham($id_sp,$tensp,$giasp,$anhsp,$id_dm, $des) {
            $sql = "UPDATE sanpham SET tensp='$tensp', giasp='$giasp', anhsp='$anhsp', id_dm='$id_dm',des ='$des' WHERE id_sp='$id_sp'";
            $query = mysqli_query($this->conn, $sql);
            return $query;
        }
        public function xoaSanPham($id_sp){
            $sql= "DELETE FROM sanpham WHERE id_sp='$id_sp'";
		    $query = mysqli_query($this->conn, $sql);
            return $query;
        }
    }
?>