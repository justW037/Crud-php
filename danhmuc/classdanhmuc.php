<?php
class Danhmuc
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function layDanhSachDanhMuc(){
        $sql = "SELECT * FROM danhmuc ORDER BY id_dm";
        $query = mysqli_query($this->conn, $sql);
        $danhMucList = array();

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
                $danhMucList[] = $row;
            }
        } else {
            echo "<tr>
                    <td colspan='7'>Không có danh mục nào</td>
                </tr>";
        }
        return $danhMucList;
    }
    public function themDanhMuc($tendm){
        $sql = "INSERT INTO danhmuc(tendm) VALUES ('$tendm')";
        $query = mysqli_query($this->conn, $sql);
        return $query;
    }
    public function layDanhMuc($id_dm) {
        $sql = "SELECT * FROM danhmuc WHERE id_dm = '$id_dm'";
        $query = mysqli_query($this->conn, $sql);
        return mysqli_fetch_array($query);
    }
    public function suaDanhMuc($id_dm, $tendm) {
        $sql = "UPDATE danhmuc SET tendm = '$tendm' WHERE id_dm = '$id_dm'";
        $query = mysqli_query($this->conn, $sql);
        return $query;
    }
    public function xoaDanhMuc($id_dm){
        $sql= "DELETE FROM danhmuc WHERE id_dm='$id_dm'";
		$query= mysqli_query($this->conn, $sql);
        return $query;
    }
}
    
?>